<template>
    <loader-component v-if="loading" />
    <div v-else class="containe row justify-content-center">
        <!-- <div class="row col-md-9">
            <div class="col-md-6">
                <div class="book-content__details mb-4 bg-white shadow-sm">
                    <img class="book-content__img" :src="book.image" alt="" />
                    <div class="book-content__text">
                        <h5>{{ book.title }}</h5>
                        <p>{{ book.cover_message }}</p>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-md-9 mb-3 row bg-white p-2">
            <div class="col-md-4 text-center">
                <div class="book-content__nav">
                    <input
                        v-model="selectedTab"
                        value="1"
                        id="bookContnet"
                        type="radio"
                        class="book-content__nav--input"
                    />
                    <label class="book-content__nav--label" for="bookContnet"
                        >Book content</label
                    >
                </div>
            </div>

            <div class="col-md-4 text-center">
                <div class="book-content__nav">
                    <input
                        v-model="selectedTab"
                        value="2"
                        id="bookGallary"
                        type="radio"
                        class="book-content__nav--input"
                    />
                    <label class="book-content__nav--label" for="bookGallary"
                        >Upload Gallery</label
                    >
                </div>
            </div>

            <div class="col-md-4 text-center">
                <div class="book-content__nav">
                    <input
                        v-model="selectedTab"
                        value="3"
                        id="bookMessages"
                        type="radio"
                        class="book-content__nav--input"
                    />
                    <label class="book-content__nav--label" for="bookMessages"
                        >Book Gallery</label
                    >
                </div>
            </div>
        </div>
        <div v-if="selectedTab == 1" class="col-md-9">
            Add book content
            <vue-editor v-model="form.content"></vue-editor>
            <HasError :form="form" field="content" />
            <HasError :form="form" field="book_id" />
            <HasError :form="form" field="page" />
            <div class="text-end mt-3">
                <button class="btn btn__primary" @click="createBookContent">
                    Save Content
                </button>
            </div>
        </div>
        <div v-if="selectedTab == 2" class="col-md-9">
            <h4 class="heading text-dark">Upload book images</h4>
            <div>
                <UploadImages
                    uploadMsg="upload book images"
                    :max="10"
                    @changed="handleImages"
                />
            </div>
            <div class="text-end mt-3">
                <button class="btn btn__primary" @click="uploadImages">
                    Upload images
                </button>
            </div>
        </div>

        <div v-if="selectedTab == 3" class="col-md-9">
            <div>
                <gallery
                    :images="images"
                    :index="index"
                    @close="index = null"
                ></gallery>
                <div
                    class="book-content__image"
                    v-for="(image, imageIndex) in bookImages"
                    :key="imageIndex"
                    @click="index = imageIndex"
                    :style="{
                        backgroundImage: 'url(' + image.image + ')',
                        width: '300px',
                        height: '200px',
                    }"
                >
                    <button
                        @click="deleteImage(image.id)"
                        v-tooltip.top="'Delete this image'"
                        class="btn btn-outline-danger btn-sm book-content__image--btn"
                    >
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import Form from "vform";
import LoaderComponent from "./LoaderComponent.vue";
import Toast from "../utils/toast";
import UploadImages from "vue-upload-drop-images";
import Gallery from "vue-gallery";
import axios from "axios";

export default {
    components: {
        VueEditor,
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
        handleImages(files) {
            this.imageUploadForm.images = files;
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
