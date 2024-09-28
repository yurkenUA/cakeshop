import { createApp } from "vue";
import { Sortable } from "sortablejs-vue3";
import axios from "axios";
import BulmaTagsInput from "@creativebulma/bulma-tagsinput";

const manageProduct = createApp({
    data() {
        return {
            price: 0,
            size_id: 0,
            sizes: window.Laravel.sizes,
            prices: window.Laravel.prices,
            tags: window.Laravel.tags,
            current_tags: window.Laravel.current_tags,
            tags_list: window.Laravel.current_tags
                .map((tag) => tag.title)
                .join(","),
            title: window.Laravel.product?.title || "",
            altname: window.Laravel.product?.altname || "",
            description: window.Laravel.product?.description || "",
            meta_description: window.Laravel.product?.meta_description || "",
            product_id: window.Laravel.product?.id || "",
            route: window.Laravel.route,
            imageRout: window.Laravel.imageRoute,
            errors: {},
            showSuccessMessage: false,
            previews: [],
            imageAltnames: [],
            priorityCounter: 0,
            imagesArr: window.Laravel.images || [],
            imagesToRemove: [],
            fileNames: "Select images...",
        };
    },
    watch: {
        tags_list(newVal) {
            this.updateTags();
        },
    },
    methods: {
        addPrice() {
            let v = this;
            v.prices.push({
                price: v.price,
                size_id: v.size_id,
            });

            v.price = 0;
            v.size_id = Object.keys(v.sizes)[0];
        },
        deletePrice(index) {
            this.prices.splice(index, 1);
        },
        showImagesPreviews(e = null) {
            const files = e?.target.files;
            if (files && files.length != 0) {
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    this.previews.push({
                        file,
                        priority:
                            this.imagesArr.length === 0
                                ? this.priorityCounter++
                                : this.imagesArr.length + i,
                        url: URL.createObjectURL(file),
                    });
                }
            }

            this.fileNames = this.previews
                .map((item) => item.file.name)
                .join(", ");
            if (this.previews.length === 0) {
                this.fileNames = "Select images...";
            }
        },
        async uploadImages() {
            if (!this.previews.length) {
                return;
            }

            this.previews.map(
                (item, i) => (item.altname = this.imageAltnames[i])
            );

            const formData = new FormData();
            this.previews.forEach((preview, index) => {
                formData.append("images[]", preview.file);
                formData.append(`priorities[${index}]`, preview.priority);
                formData.append(`altnames[${index}]`, preview.altname);
            });
            try {
                const response = await axios.post(this.imageRout, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });

                this.previews = [];
                this.fileNames = "Select images...";
                this.imagesArr = [...this.imagesArr, ...response.data.images];
            } catch (error) {
                console.error("Error uploading images:", error);
            }
        },
        // updatePurchaseTags(purchaseTags) {
        //     this.purchase_tags = purchaseTags
        // },
        // bindPurchaseTags() {
        //     let v = this
        //     setTimeout(() => {
        //         BulmaTagsInput.attach('input[data-type="purchaseTags"]', {
        //             selectable: false,
        //             source: window.Laravel.purchase.tags,
        //         })

        //         setTimeout(() => {
        //             v.$refs.purchaseTagsInput.BulmaTagsInput().on('after.add', data => {
        //                 v.updatePurchaseTags(v.$refs.purchaseTagsInput.BulmaTagsInput().value)
        //             })
        //             v.$refs.purchaseTagsInput.BulmaTagsInput().on('after.remove', item => {
        //                 v.updatePurchaseTags(v.$refs.purchaseTagsInput.BulmaTagsInput().value)
        //             })
        //         }, 500)
        //     }, 500)
        // },
        updateTags(e) {
            const newTags = e?.target.value
                .split(",")
                .map((tag) => tag.trim())
                .filter((tag) => tag);

            if (Array.isArray(newTags)) {
                const updatedTags = [];

                newTags.forEach((newTag) => {
                    const tagExists = this.current_tags.some(
                        (tag) => tag.title === newTag
                    );
                    if (!tagExists) {
                        updatedTags.push({ title: newTag });
                    } else {
                        updatedTags.push(
                            this.current_tags.find(
                                (tag) => tag.title === newTag
                            )
                        );
                    }
                });

                this.current_tags = updatedTags;

                this.tags_list = this.current_tags
                    .map((tag) => tag.title)
                    .join(",");
            } else {
                console.error("newTags is not an array:", newTags);
            }
        },
        clearError(field) {
            if (this.errors[field]) {
                delete this.errors[field];
            }
        },
        removePreview(index) {
            this.previews.splice(index, 1);
            this.showImagesPreviews();
        },
        removeImage(element, index) {
            this.imagesArr.splice(index, 1);
            this.imagesToRemove.push(element.id);
        },
        onImagesSorted(event, arr) {
            this.showImagesPreviews(event);
            arr = arr.map((item, i) => ({
                ...item,
                priority: i,
                altname: this.imageAltnames[i],
            }));

            const sortedImages = arr.slice();
            const movedItem = sortedImages.splice(event.oldIndex, 1)[0];
            sortedImages.splice(event.newIndex, 0, movedItem);

            arr = sortedImages.map((item, i) => ({
                ...item,
                priority: i,
            }));

            if (event?.from.className === "productPreviewsImageUploader") {
                this.previews = arr;
            } else {
                this.imagesArr = arr;
            }
        },
        async save() {
            await this.uploadImages();

            try {
                let data = {
                    title: this.title,
                    altname: this.altname,
                    description: this.description,
                    meta_description: this.meta_description,
                    prices: this.prices,
                    product_id: this.product_id || "",
                    current_tags: this.current_tags,
                    images: this.imagesArr,
                    images_to_remove: this.imagesToRemove,
                };
                const res = await axios.post(this.route, data);
                this.showSuccessMessage = true;
                this.imagesToRemove = [];
                this.priorityCounter = 0;

                // setTimeout(() => {
                //     this.showSuccessMessage = false;
                //     window.location.href = this.route.slice(0, -5);
                // }, 3000);
            } catch (error) {
                console.error("Error saving product:", error);
                this.errors = error.response.data.errors;
            }
        },
    },
    mounted() {
        let v = this;

        const tagsInputs = BulmaTagsInput.attach('[data-type="tags"]', {
            allowDuplicates: false,
            source: Object.values(v.tags),
        });

        let sizesKeys = Object.keys(v.sizes);
        if (sizesKeys.length > 0) v.size_id = sizesKeys[0];
    },
    components: {
        Sortable,
    },
});
manageProduct.mount("#manageProduct");
