<template>
    <loader-component v-if="loading" />
    <div v-else>
        <!-- Step 1 -->
        <div
            v-if="step == 1"
            class="row justify-content-center book-create__row"
        >
            <div class="col-md-10 book-create__co">
                <div class="book-create__col--content">
                    <div class="book-create__header">
                        <div class="book-create__header--step">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                        </div>
                        <span>Step 1: Select book category to create</span>
                    </div>
                </div>
            </div>
            <div class="col-md-10 row">
                <div
                    v-for="(category, i) in categories"
                    :key="i + 'cat8+5+592'"
                    class="col-md-3"
                >
                    <div class="book-create__category">
                        <input
                            v-model="form.category"
                            class="book-create__category--input"
                            type="radio"
                            name="category"
                            :id="'template-' + i"
                            :value="category.id"
                        />
                        <label
                            :for="'template-' + i"
                            class="book-create__category--lable shadow-sm"
                            :style="`background: url(${category.image});`"
                        >
                            <div class="book-create__category--text">
                                <span
                                    class="book-create__category--text--inner"
                                    >{{ category.name }}</span
                                >
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="book-create__btns">
                    <button
                        :disabled="!form.category"
                        class="btn btn-block btn-lg btn__primary mt-3"
                        @click="nextPage"
                    >
                        Next
                        <i
                            class="fa fa-arrow-right ms-2"
                            aria-hidden="true"
                        ></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Step 2 -->
        <div
            v-else-if="step == 2"
            class="row justify-content-center book-create__row"
        >
            <div class="col-md-10 book-create__co">
                <div class="book-create__col--content">
                    <div class="book-create__header">
                        <div class="book-create__header--step">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                        </div>
                        <span>Step 2: Select book category template</span>
                    </div>
                </div>
            </div>
            <div class="col-md-10 row mt-3">
                <div
                    v-for="(template, i) in templates"
                    :key="i"
                    class="col-md-3"
                >
                    <div class="book-create__template">
                        <input
                            v-model="form.template"
                            class="book-create__template--input"
                            type="radio"
                            name="template"
                            :id="'template-' + i"
                            :value="template.id"
                        />
                        <label
                            :for="'template-' + i"
                            class="book-create__template--lable shadow-sm"
                        >
                            <div class="book-create__template--lable--top">
                                <img
                                    :src="template.image.url"
                                    alt=""
                                    class="book-create__template--lable--top_img"
                                />
                            </div>
                            <div class="book-create__template--lable--content">
                                <div
                                    class="book-create__template--lable--content_header"
                                >
                                    {{ template.name }}
                                </div>
                                <div
                                    class="book-create__template--lable--content_description"
                                >
                                    {{ template.description }}
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="book-create__btns">
                    <button
                        class="btn btn-block btn-lg btn__primary mt-3"
                        :disabled="!form.template"
                        @click="nextPage"
                    >
                        Next
                        <i
                            class="fa fa-arrow-right ms-2"
                            aria-hidden="true"
                        ></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Step 3 -->
        <div
            v-else-if="step == 3"
            class="row justify-content-center book-create__row"
        >
            <div class="col-md-10 book-create__co">
                <div class="book-create__col--content">
                    <div class="book-create__header">
                        <div class="book-create__header--step">
                            <i class="fa fa-book" aria-hidden="true"></i>
                        </div>
                        <span>Step 3: Enter book details</span>
                    </div>
                </div>
            </div>
            <div class="bg-white col-md-10 p-3 row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Book title</label>
                        <input
                            v-model="form.title"
                            type="text"
                            class="form-control form-control-lg"
                            name="title"
                            id="title"
                            aria-describedby="book-title"
                            placeholder="Book title"
                        />
                        <small id="book-title" class="form-text text-muted"
                            >What is your book's title?</small
                        >
                        <HasError :form="form" field="title" />
                    </div>

                    <div class="mb-3">
                        <label for="cover-image" class="form-label"
                            >Book cover image</label
                        >
                        <input
                            type="file"
                            class="form-control form-control-lg"
                            name="cover-image"
                            id="cover-image"
                            aria-describedby="book-title"
                            placeholder="Book title"
                            @change="handleFile"
                        />
                        <small id="book-title" class="form-text text-muted"
                            >Upload your book's cover image.</small
                        >
                        <HasError :form="form" field="cover_image" />
                    </div>
                    <div class="form-check mt-4">
                        <input
                            v-model="form.public"
                            type="checkbox"
                            class="form-check-input form-check-input-lg"
                            name="public"
                            id="public"
                        />

                        <label class="form-check-label" for="public">
                            Do you want this book to be public ?
                        </label>
                        <br />
                        <small id="book-title" class="form-text text-muted"
                            >Public books can be read by anyone who can access
                            mycelebrationbooks.com</small
                        >
                    </div>

                    <div class="form-check mt-4">
                        <input
                            v-model="form.accept_message"
                            type="checkbox"
                            class="form-check-input form-check-input-lg"
                            name="accept_message"
                            id="accept_message"
                        />

                        <label class="form-check-label" for="accept_message">
                            Do you want to accept messages ?
                        </label>
                        <br />
                        <small id="book-title" class="form-text text-muted"
                            >Other mycelebration books users can add messages to
                            the book</small
                        >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label"
                            >Book cover message</label
                        >
                        <textarea
                            v-model="form.cover_message"
                            class="form-control form-control-lg"
                            rows="8"
                        ></textarea>
                        <small id="book-title" class="form-text text-muted"
                            >What is your book's cover message ?</small
                        >
                        <HasError :form="form" field="cover_message" />
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="book-create__btns">
                    <button
                        class="btn btn-block btn-lg btn__primary mt-3"
                        @click="createBook"
                    >
                        Next
                        <i
                            class="fa fa-arrow-right ms-2"
                            aria-hidden="true"
                        ></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Step 4 -->
    </div>
</template>

<script>
import LoaderComponent from "./LoaderComponent.vue";
import SearchComponent from "./SearchComponent.vue";
import Form from "vform";
import Toast from '../utils/toast';

export default {
    components: { SearchComponent, LoaderComponent },
    data: () => ({
        step: 1,
        categories: [],
        templates: [],
        form: new Form({
            category: null,
            template: null,
            cover_message: null,
            accept_message: false,
            public: false,
            title: null,
            cover_image: null,
        }),
        loading: false,
    }),

    async mounted() {
        try {
            this.loading = true;
            await this.fetchCategories();
            await this.fetchTemplates();
        } catch (error) {
        } finally {
            this.loading = false;
        }
    },

    methods: {
        async fetchCategories() {
            try {
                const response = await axios.get(
                    "/api/celebrations/categories"
                );
                this.categories = response.data;
            } catch (e) {
                throw e;
            }
        },

        async fetchTemplates() {
            try {
                const response = await axios.get("/api/celebrations/templates");
                this.templates = response.data;
            } catch (e) {
                throw e;
            }
        },

        async createBook() {
            try {
                this.loading = true;
                const response = await this.form.post("/api/celebrations/book");
                const responseData = response.data;
                if (responseData.status) {
                    Toast.fire({
                        icon: "success",
                        text: "Your book was created successfully",
                    });
                    location.href = `/book/content/${responseData.id}`;
                } else {
                    throw "error occured";
                }
            } catch (error) {
                this.$swal.fire({
                    icon: "error",
                    title: "An error occurred",
                    text: "Oops! There was an error when uploading data, Please try again.",
                });
            } finally {
                this.loading = false;
            }
        },

        handleFile(event) {
            const file = event.target.files[0];
            this.form.cover_image = file;
        },

        nextPage() {
            this.step++;
        },

        prevPage() {
            this.step--;
        },
    },
};
</script>

<style></style>
