<template>
    <loader-component v-if="loading" />
    <div v-else class="book-message row">
        <!-- Step 1 -->
        <div
            v-if="step == 1"
            class="row justify-content-center book-create__row"
        >
            <div class="col-md-11 book-create__co">
                <div class="book-create__col--content">
                    <div class="book-create__header">
                        <div class="book-create__header--step">
                            <i class="fa fa-gift" aria-hidden="true"></i>
                        </div>
                        <span>Step 1: Select message template</span>
                    </div>
                </div>
            </div>
            <div class="col-md-11 row mt-3">
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

        <div
            v-if="step == 2"
            class="row justify-content-center book-create__row"
        >
         <div class="col-md-11 book-create__co">
                <div class="book-create__col--content">
                    <div class="book-create__header">
                        <div class="book-create__header--step">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </div>
                        <span>Step 2: Message details</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card p-2 px-5 text-start">
                    <div class="mb-3">
                      <label for="relationship" class="form-label">What is your relationship with the book owner?</label>
                      <input type="text"
                        class="form-control" name="relationship" id="relationship" aria-describedby="relationship" placeholder="eg. Brother">
                      <small id="relationship" class="form-text text-muted">Examples friend, brother, mother, teacher etc.</small>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label"
                            >Enter the massage</label
                        >
                        <textarea
                            class="form-control"
                            name="message"
                            id="message"
                            rows="3"
                        ></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="book-create__btns">
                    <button
                        class="btn btn-block btn-lg btn__primary mt-3"
                    >
                        Save Message
                       <i class="fa fa-save ms-2" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LoaderComponent from "./LoaderComponent.vue";
import SearchComponent from "./SearchComponent.vue";
import Form from "vform";
import Toast from "../utils/toast";

export default {
    components: { SearchComponent, LoaderComponent },
    data: () => ({
        step: 2,
        templates: [],
        form: new Form({
            message: null,
            template: null,
        }),
        loading: false,
    }),

    async mounted() {
        try {
            this.loading = true;
            await this.fetchTemplates();
        } catch (error) {
        } finally {
            this.loading = false;
        }
    },

    methods: {
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
