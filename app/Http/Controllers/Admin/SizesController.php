<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductsSizes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;


class SizesController extends Controller
{
    public function index(Request $request): View
    {
        $sizes = ProductsSizes::all();
        return view('admin.sizes.index', compact('sizes'));
    }

    public function create(Request $request): View
    {
        return view('admin.sizes.manage');
    }

    public function save(Request $request): RedirectResponse
    {
        $sizeData = $request->validate([
            'size' => 'required|integer',
        ]);

        $sizeId = request()->get('size_id');
        if ($sizeId) {
            $size = ProductsSizes::find($sizeId);
            $size->update($sizeData);
        } else {
            $size = new ProductsSizes();
            $size->create($sizeData);
        }
        
        return redirect(route('admin.sizes.index'));
    }

    public function update(Request $request, ProductsSizes $size): View
    {   
        return view('admin.sizes.manage', compact('size'));
    }

    public function delete(Request $request, ProductsSizes $size): RedirectResponse
    {
        $size->delete();
        return redirect(route('admin.sizes.index'));
        // return view('admin.sizes.delete', compact('size'));
    }

    // public function confirmDelete(Request $request, ProductsSizes $size): RedirectResponse
    // {
    //     return redirect(route('admin.sizes.index'));
    // }
    
}
