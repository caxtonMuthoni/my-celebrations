<template>
    <loader-component v-if="loading" />
    <div v-else class="containe row justify-content-center">
        <div class="col-md-9 book-content__nav">
            <div class="book-content__nav-item-container" :class="{ 'hidden-mobile': selectedTab != 1 }">
                <div class="book-content__nav--item">
                    <input v-model="selectedTab" value="1" id="bookContnet" type="radio" class="book-content__nav--input" />
                    <label class="book-content__nav--label" for="bookContnet">
                        <h3 class="heading heading_4 book-content__nav--label-header mb-0 pb-0">Step 1</h3>
                        <p class="book-content__nav--label-description">Add your book content</p>
                    </label>
                </div>
            </div>

            <div class="book-content__nav-item-container" :class="{ 'hidden-mobile': selectedTab != 2 }">
                <div class="book-content__nav--item">
                    <input v-model="selectedTab" value="2" id="bookGallary" type="radio" class="book-content__nav--input" />
                    <label class="book-content__nav--label" for="bookGallary">
                        <h3 class="heading heading_4 book-content__nav--label-header mb-0 pb-0">Step 2</h3>
                        <p class="book-content__nav--label-description">Upload book gallery images</p>
                    </label>
                </div>
            </div>

            <div class="book-content__nav-item-container" :class="{ 'hidden-mobile': selectedTab != 3 }">
                <div class="book-content__nav--item">
                    <input v-model="selectedTab" value="3" id="bookMessages" type="radio"
                        class="book-content__nav--input" />
                    <label class="book-content__nav--label" for="bookMessages">
                        <h3 class="heading heading_4 book-content__nav--label-header mb-0 pb-0">Step 3</h3>
                        <p class="book-content__nav--label-description">Preview your book gallery</p>
                    </label>
                </div>
            </div>

            <div class="book-content__nav-item-container" :class="{ 'hidden-mobile': selectedTab != 4 }">
                <div class="book-content__nav--item">
                    <input v-model="selectedTab" value="4" id="confrim_and_continue" type="radio"
                        class="book-content__nav--input" />
                    <label class="book-content__nav--label" for="confrim_and_continue">
                        <h3 class="heading heading_4 book-content__nav--label-header mb-0 pb-0">Step 4</h3>
                        <p class="book-content__nav--label-description">Save and preview your book</p>
                    </label>
                </div>
            </div>

        </div>
        <div v-if="selectedTab == 1" class="col-md-9">
            Add book content
            <div>
                <Editor v-model="form.content" api-key="eijrcgbuvmrbgp4rdrixsyd2w5v68kmqwfr8odi3zdg2mpxv" :init="{
                    plugins: 'lists link wordcount'
                }" />
                <HasError :form="form" field="book_id" />
                <HasError :form="form" field="page" />
            </div>
            <div class="text-end mt-3">
                <button class="btn btn__primary" @click="createBookContent">
                    Save Content
                </button>
            </div>
        </div>
        <div v-if="selectedTab == 2" class="col-md-9">
            <h4 class="heading text-dark">Upload book images</h4>
            <div>
                <UploadImages uploadMsg="upload book images" :max="10" @changed="handleImages" />
            </div>
            <div class="text-end mt-3">
                <h4 class="heading" disabled v-if="compressingImages">
                    Compressing image[{{ compressingImageNumber }}]: {{ uploadPercentage }} %</h4>
                <button v-else class="btn btn__primary" :disabled="uploadDisabled" @click="uploadImages">
                    Upload images
                </button>
            </div>
        </div>

        <div v-if="selectedTab == 3" class="col-md-9">
            <div class="">
                <gallery :images="images" :index="index" @close="index = null"></gallery>
                <div class="book-content__image" v-for="(image, imageIndex) in bookImages" :key="imageIndex"
                    @click="index = imageIndex" :style="{
                        backgroundImage: 'url(' + image.image + ')',
                        width: '300px',
                        height: '200px',
                    }">
                    <button @click="deleteImage(image.id)" v-tooltip.top="'Delete this image'"
                        class="btn btn-outline-danger btn-sm book-content__image--btn">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="text-center mt-3">
                <button class="btn btn__primary" @click="selectedTab++">
                    Continue
                </button>
            </div>
        </div>

        <div v-if="selectedTab == 4" class="row col-md-9 justify-content-center">
            <div class="col-md-6 mt-5">
                <h4>Confrim you have added all your book content.</h4>
                <p>
                    We appreciate you taking the time to create your book. To continue, please click the
                    button below to preview your book. Thank you for your cooperation.
                </p>
                <div class="text-center">
                    <a :href="`/book/books/read/${book.id}`" class="btn btn-primary btn-lg">
                        Continue to preview the book.
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'
import Form from "vform";
import LoaderComponent from "./LoaderComponent.vue";
import Toast from "../utils/toast";
import UploadImages from "vue-upload-drop-images";
import Gallery from "vue-gallery";
import axios from "axios";
import imageCompression from 'browser-image-compression';

export default {
    components: {
        Editor,
        LoaderComponent,
        UploadImages,
        Gallery,
    },

    props: {
        book: {
            type: Object,
            required: true,
        },
        bookid: {
            type: Number,
            required: true,
        },
    },

    data: () => ({
        form: new Form({
            content: "",
            book_id: null,
            page: null,
        }),
        imageUploadForm: new Form({
            images: null,
            book_id: null,
        }),
        selectedTab: 1,
        index: null,
        loading: false,
        compressingImages: false,
        uploadPercentage: 0,
        compressingImageNumber: 1,
        uploadDisabled: true,
    }),

    computed: {
        images() {
            return this.book?.book_images?.map((image) => image.image) || [];
        },

        bookImages() {
            return this.book?.book_images || [];
        },
    },

    mounted() {
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });

        if (params.tab) {
            this.changeQueryParams(params.tab);
        } else {
            this.changeQueryParams(1);
        }
    },

    methods: {
        async handleImages(files) {
            this.compressingImages = true;
            let images = [];
            const options = {
                maxSizeMB: 1,
                maxWidthOrHeight: 1920,
                useWebWorker: true,
                onProgress: this.fileUploadOnProgress
            }
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileSizeMB = file.size / 1024 / 1024;
                if (fileSizeMB > 1) {
                    try {
                        this.compressingImageNumber = i + 1;
                        let compressedFile = new Blob()
                        compressedFile = await imageCompression(file, options);
                        const storeFile = new File([compressedFile], file.name);
                        images.push(storeFile)
                    } catch (error) {
                        console.log(error);
                    }
                } else {
                    images.push(file)
                }
            }

            if (images.length > 0) {
                this.uploadDisabled = false;
                this.imageUploadForm.images = images;
            }
            this.compressingImages = false
        },

        fileUploadOnProgress(percentage) {
            this.uploadPercentage = percentage;
        },

        changeQueryParams(tab) {
            if (history.pushState) {
                var newurl =
                    window.location.protocol +
                    "//" +
                    window.location.host +
                    window.location.pathname +
                    "?tab=" +
                    tab;
                window.history.pushState({ path: newurl }, "", newurl);

                const params = new Proxy(
                    new URLSearchParams(window.location.search),
                    {
                        get: (searchParams, prop) => searchParams.get(prop),
                    }
                );

                this.selectedTab = params.tab;
            }
        },

        async uploadImages() {
            try {
                this.loading = true;
                this.imageUploadForm.book_id = this.bookid;
                const response = await this.imageUploadForm.post(
                    "/api/celebrations/bookimages"
                );
                const responseData = response.data;
                if (responseData.status) {
                    Toast.fire({
                        icon: "success",
                        text: "Your images were uploaded successfully",
                    });
                    this.changeQueryParams(3);
                    location.reload();
                } else {
                    this.$swal.fire({
                        icon: "error",
                        title: "Upload failed",
                        text: responseData.message,
                    });
                }
            } catch (error) {
                console.log(error);
                this.$swal.fire({
                    icon: "error",
                    title: "An error occurred",
                    text: "Oops! There was an error when uploading data, Please try again.",
                });
            } finally {
                this.loading = false;
            }
        },

        async deleteImage(id) {
            try {
                this.loading = true;
                const response = await axios.delete(
                    `/api/celebrations/bookimage/${id}`
                );
                const responseData = response.data;
                if (responseData.status) {
                    Toast.fire({
                        icon: "success",
                        text: "Your image was deleted successfully",
                    });
                    changeQueryParams(2);
                    location.reload();
                } else {
                    throw "error occured";
                }
            } catch (error) {
                console.log(error);
                this.$swal.fire({
                    icon: "error",
                    title: "An error occurred",
                    text: "Oops! There was an error when deleting data, Please try again.",
                });
            } finally {
                this.loading = false;
            }
        },

        async createBookContent() {
            try {
                this.loading = true;
                this.form.book_id = this.bookid;
                const response = await this.form.post(
                    "/api/celebrations/bookcontent"
                );
                const responseData = response.data;
                if (responseData.status) {
                    Toast.fire({
                        icon: "success",
                        text: "Your book was created successfully",
                    });
                    this.changeQueryParams(2);
                    location.reload();
                } else {
                    throw "error occured";
                }
            } catch (error) {
                console.log(error);
                this.$swal.fire({
                    icon: "error",
                    title: "An error occurred",
                    text: "Oops! There was an error when uploading data, Please try again.",
                });
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>
