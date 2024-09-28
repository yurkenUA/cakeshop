<?php $__env->startSection('content'); ?>
    <div class="level">
        <!-- Left side -->
        <div class="level-left">
            <h1><?php echo e(isset($product) ? 'Update Product' : 'Create Product'); ?></h1>
        </div>

        <div class="level-right">
            <a href="<?php echo e(route('admin.products.index')); ?>" class="button is-info">Products List</a>
        </div>
    </div>

    <form id="manageProduct" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php if(isset($product)): ?>
            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>" v-model="product_id" />
        <?php endif; ?>
        <article v-if="showSuccessMessage" id="notification" class="message is-success">
            <div class="message-header">
                <p>Success</p>
                <button class="delete" aria-label="delete" @click="showSuccessMessage = false"></button>
            </div>
            <div class="message-body">
                Product saved successfully!
            </div>
        </article>
        <div class="file is-info has-name">
            <label class="file-label">
                <input class="file-input" type="file" name="resume" multiple @change="showImagesPreviews" />
                <span class="file-cta">
                    <span class="file-icon">
                        <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label"> Upload images </span>
                </span>
                <span class="file-name">{{ fileNames }}</span>
            </label>
        </div>

        <div v-if="previews.length !== 0" class="container is-fluid mb-6">
            <Sortable class="productPreviewsImageUploader" :list="previews" item-key="url" @end="(e) => onImagesSorted(e, previews)" class="columns is-multiline mt-3">
                <template #item="{ element, index }">
                    <div class="draggable productImage" :key="element.image_id">
                        <span class="deleteImage" @click="removePreview(index)">&times;</span>
                        <figure class="image">
                            <img class="is-1" :src="element.url" :alt="element.altname" />
                        </figure>
                        <input class="input is-warning is-small mt-1" type="text" placeholder="Alt name" v-model="imageAltnames[index]" @input="showImagesPreviews" />
                    </div>
                </template>
            </Sortable>
            <button type="button" class="button is-info is-dark mt-6" @click="uploadImages">Save Images</button>
        </div>

        <div class="container is-fluid mb-6" v-if="imagesArr.length !== 0">
            <h2 class="column is-full is-size-5 has-text-warning">Uploaded images</h2>
            <div>
                <Sortable class="productImageUploader" :list="imagesArr" item-key="id" @end="(e) => onImagesSorted(e, imagesArr)" class="columns is-multiline mt-3">
                    <template #item="{ element, index }">
                        <div class="draggable productImage" :key="element.id">
                            <span class="deleteImage" @click="removeImage(element, index)">&times;</span>
                            <figure class="image">
                                <img :src="element.path" :alt="element.altname === 'undefined' ? `${title} by Natalie's cakeshop` : element.altname" />
                            </figure>
                        </div>
                    </template>
                </Sortable>
            </div>
        </div>

        <div class="field">
            <label class="label">Title</label>
            <div class="control">
                <input class="input mb-3" :class="{ 'is-danger': errors.title }" @input="clearError('title')" type="text" placeholder="Title" name="title" v-model="title">
                <p class="help is-danger" v-if="errors.title">{{ errors.title[0] }}</p>
            </div>
        </div>
        <div class="field">
            <label class="label">Altname</label>
            <div class="control">
                <input class="input mb-3" :class="{ 'is-danger': errors.altname }" @input="clearError('altname')" type="text" placeholder="Altname" name="altname" v-model="altname">
                <p class="help is-danger" v-if="errors.altname">{{ errors.altname[0] }}</p>
            </div>
        </div>
        <div class="field">
            <label class="label">Description</label>
            <div class="control">
                <textarea class="textarea" :class="{ 'is-danger': errors.description }" @input="clearError('description')" type="text" placeholder="Description" name="description"
                    v-model="description"></textarea>
                <p class="help is-danger" v-if="errors.description">{{ errors.description[0] }}</p>
            </div>
        </div>
        <div class="field">
            <label class="label">Meta Description</label>
            <div class="control">
                <input class="input" :class="{ 'is-danger': errors.meta_description }" @input="clearError('meta_description')" type="text" placeholder="Meta Description"
                    name="meta_description" v-model="meta_description">
                <p class="help is-danger" v-if="errors.meta_description">{{ errors.meta_description[0] }}</p>
            </div>
        </div>
        <div class="field">
            <label class="label">Tags</label>
            <div class="control">
                <input id="tags-with-source" class="input" type="text" data-item-text="name" data-case-sensitive="false" data-type="tags" placeholder="Choose Tags"
                    name="tags" v-model="tags_list" @change="updateTags">
            </div>
        </div>
        <h3 class="mt-6">Add Prices:</h3>
        <div class="columns">
            <div class="column">
                <div class="field">
                    <label class="label">Select Size</label>
                    <div class="control">
                        <div class="select">
                            <select v-model="size_id">
                                <option :value="id" v-for="(size, id) in sizes">{{ size }} inches</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <label class="label">Price</label>
                <div class="control">
                    <input class="input" :class="{ 'is-danger': errors.prices }" @input="clearError('prices')" type="number" placeholder="Set Price" v-model="price">
                    <p class="help is-danger" v-if="errors.prices">{{ errors.prices[0] }}</p>
                </div>
            </div>
            <div class="column">
                <label class="label">&nbsp;</label>
                <div class="control">
                    <button class="button is-primary" type="button" @click="addPrice">Add Price</button>
                </div>
            </div>
        </div>
        <h3>Prices:</h3>
        <Sortable :list="prices" :item-key="'id'">
            <template #item="{ element, index }">
                <div class="columns" :key="element.id">
                    <div class="column">
                        <div class="field">
                            <label class="label">Select Size</label>
                            <div class="control">
                                <div class="select">
                                    <select v-model="prices[index].size_id">
                                        <option :value="id" v-for="(size, id) in sizes">{{ size }} inches</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <label class="label">Price</label>
                        <div class="control">
                            <input class="input" type="number" placeholder="Set Price" v-model="prices[index].price">
                        </div>
                    </div>
                    <div class="column">
                        <label class="label">&nbsp;</label>
                        <div class="control">
                            <button class="button is-danger" type="button" @click="deletePrice(index)">Delete Price</button>
                        </div>
                    </div>
                </div>
            </template>
        </Sortable>

        <button class="button has-background-primary m-5" type="button" @click="save">Save</button>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="button has-background-warning m-5">Go Back</a>

    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        window.Laravel.redirect = '<?php echo e(route('admin.products.index')); ?>';
        window.Laravel.sizes = <?php echo json_encode($sizes); ?>;
        window.Laravel.prices = <?php echo json_encode($product->prices ?? []); ?>;
        window.Laravel.tags = <?php echo json_encode($tags); ?>;
        window.Laravel.current_tags = <?php echo json_encode($product->tags ?? []); ?>;
        window.Laravel.product = <?php echo json_encode($product ?? null); ?>;
        window.Laravel.route = '<?php echo e(route('admin.products.save')); ?>';
        window.Laravel.imageRoute = '<?php echo e(route('admin.products.image')); ?>';
        window.Laravel.images = <?php echo json_encode($images ?? []); ?>;
    </script>
    <script src="<?php echo e(asset('js/admin/pages/products.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/zatokafamily/Documents/Code/projects/cakeshop/resources/views/admin/products/manage.blade.php ENDPATH**/ ?>