<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\SaveRequest;
use App\Models\Images;
use App\Models\Products;
use App\Models\ProductsImages;
use App\Models\ProductsPrices;
use App\Models\ProductsSizes;
use App\Models\ProductsTags;
use App\Models\Tags;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;


class ProductsController extends Controller
{
    /**
     * Show products list
     */
    public function index(Request $request): View
    {
        $products = Products::paginate(5);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Create product
     */
    public function create(Request $request): View
    {

        $sizes = ProductsSizes::pluck('size', 'id')->toArray();
        $tags = Tags::pluck('title', 'id')->toArray();

        return view('admin.products.manage', compact('sizes', 'tags'));
    }

    /**
     * Update product
     */
    public function update(Request $request, Products $product): View
    {
        $sizes = ProductsSizes::pluck('size', 'id')->toArray();
        $tags = Tags::pluck('title', 'id')->toArray();
        $currentTags = $product->tags_plucked;
        $images = $product->images_with_priority;

        return view('admin.products.manage', [
            'product' => $product,
            'sizes' => $sizes,
            'tags' => $tags,
            'currentTags' => $currentTags,
            'images' => $images,
        ]);
    }

    /**
     * Save product
     */
    public function save(SaveRequest $request, Products $product): JsonResponse
    {
        $productData = $request->validated();

        $productId = request()->get('product_id');
        if ($productId) {
            $product = Products::find($productId);

            if ($product->altname != $productData['altname']) {
                $request->validate([
                    'altname' => 'unique:products',
                ]);
            }

            $product->update($productData);
        } else {
            $product = Products::create($productData);
        }

        $pricesEdited = [];
        foreach ($productData['prices'] as $priceData) {
            $createNewPrice = true;

            if ($productId) {
                $price = $product->prices()->where('size_id', $priceData['size_id'])->first();

                if ($price) {
                    $price->price = $priceData['price'];
                    $price->save();

                    $createNewPrice = false;
                }
            }

            if ($createNewPrice) {
                $price = ProductsPrices::create([
                    'product_id' => $product->id,
                    'size_id' => $priceData['size_id'],
                    'price' => $priceData['price'],
                ]);
            }

            $pricesEdited[] = $price->id;
        }

        foreach ($product->prices as $price) {
            if (!in_array($price->id, $pricesEdited)) {
                $price->delete();
            }
        }

        $tagIds = [];
        foreach ($productData['current_tags'] as $tagData) {
            $tag = Tags::firstOrCreate([
                'title' => $tagData['title']
            ]);
            $tagIds[] = $tag->id;
        }

        $product->tags()->sync($tagIds);

        // we get all images currently attached to the product
        // then we check which ones we no longer have in $productData['images']
        // remove relations from ProductsImages for these images (and delete image from images database and from storage)
        // checkout model Observers (to remove images from storage)
        // create observer for Images model
        // bind observer to model in AppServiceProvider
        // on delete entry from Images database we need to delete images from storage (path and x1600)
        // $image->delete();
        // public function deleted(Image $image): void
        // {
        //     Storage::delete($image->path);
        //     Storage::delete($image->x1600);
        // }
        if (isset($productData['images'])) {
            foreach ($productData['images'] as $imageData) {
                $imageExists = ProductsImages::where('product_id', $product->id)
                    ->where('image_id', $imageData['id'])
                    ->first();

                if ($imageExists) {
                    ProductsImages::where('product_id', $product->id)
                        ->where('image_id', $imageData['id'])
                        ->update([
                            'priority' => $imageData['priority'],
                        ]);
                } else {
                    ProductsImages::create([
                        'product_id' => $product->id,
                        'image_id' => $imageData['id'],
                        'priority' => $imageData['priority'],
                    ]);
                }
            }
        }

        $beforeSaveImageIdsToRemove = $request->get('images_to_remove', []);

        if (!empty($beforeSaveImageIdsToRemove)) {
            ProductsImages::where('product_id', $product->id)
                ->whereIn('image_id', $beforeSaveImageIdsToRemove)
                ->delete();

            $imagesToDelete = Images::whereIn('id', $beforeSaveImageIdsToRemove)->get();
            foreach ($imagesToDelete as $image) {
                $image->delete();
            }
        } else {
            $relatedImageIds = ProductsImages::pluck('image_id');
            $imagesToDelete = Images::whereNotIn('id', $relatedImageIds)->get();

            foreach ($imagesToDelete as $image) {
                $image->delete();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Product successfully updated',
        ]);
    }

    public function delete(Request $request, Products $product): RedirectResponse
    {
        $product->delete();
        return redirect(route('admin.products.index'));
    }

    private function resizeAndSaveImage($image, $filename)
    {
        $image = ImageManager::imagick()->read($image);
        $image->scaleDown(width: 1600);
        $resizedPath = 'public/products/images/resized_1600/resized_1600_' . $filename;
        $image->save(storage_path('app/' . $resizedPath));
        $savePath = '/products/images/resized_1600/resized_1600_' . $filename;

        return $savePath;
    }

    public function uploadImage(Request $request): JsonResponse
    {
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $altnames = $request->input('altnames');
            $priorities = $request->input('priorities');
            $uploadedImages = [];

            Storage::makeDirectory('public/products/images/path');
            Storage::makeDirectory('public/products/images/resized_1600');

            foreach ($images as $index => $image) {
                $filename = Str::uuid() . '_' . Carbon::now()->timestamp . '_' . $image->getClientOriginalName();
                $path = Storage::putFileAs('public/products/images/path', $image, $filename);
                $savePath = '/products/images/path/' . $filename;

                $uploadedImage = Images::create([
                    'altname' =>  $altnames[$index],
                    'path' => $savePath,
                    'x1600' => $this->resizeAndSaveImage($image, $filename),
                ]);

                $uploadedImages[] = [
                    'id' => $uploadedImage->id,
                    'altname' => $uploadedImage->altname,
                    'path' => $uploadedImage->path,
                    'x1600' => $uploadedImage->x1600,
                    'url' => $savePath,
                    'priority' => $priorities[$index],
                ];
            }

            return response()->json([
                'success' => true,
                'message' => 'Images uploaded',
                'images' => $uploadedImages,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No images uploaded',
        ]);
    }
}
