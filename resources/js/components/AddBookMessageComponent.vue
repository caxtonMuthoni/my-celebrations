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
                        <span>Provide the message details</span>
                        <!-- <span>Step 2: Message details</span> -->
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="alert alert-info">
                    NB. All the messages sent here will be reviewed by the owner
                    of the book. Once the owner approves your message, it will
                    be published to the book.
                </div>
                <div class="card p-2 px-5 text-start">
                    <div class="mb-3">
                        <label for="relationship" class="form-label"
                            >What is your relationship with the book
                            owner?</label
                        >
                        <input
                            v-model="form.relationship"
                            type="text"
                            class="form-control"
                            name="relationship"
                            id="relationship"
                            aria-describedby="relationship"
                            placeholder="eg. Brother"
                        />
                        <small id="relationship" class="form-text text-muted"
                            >Examples friend, brother, mother, teacher
                            etc.</small
                        >
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label"
                            >Enter the message</label
                        >
                        <textarea
                            v-model="form.message"
                            class="form-control"
                            name="message"
                            id="message"
                            rows="3"
                        ></textarea>
                        <p class="form-text" :class="{'text-danger': form.message.length > maxCharacteres}">
                            Maximum characters is {{maxCharacteres}} - {{form.message.length}} / {{maxCharacteres}}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="book-create__btns">
                    <button
                        class="btn btn-block btn-lg btn__primary mt-3"
                        @click="createMessage"
                        :disabled="form.message.length > maxCharacteres"
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
    props: {
        bookId: {
            type: Number,
            required: true,
        },
    },

    data: () => ({
        step: 2,
        templates: [],
        maxCharacteres: 150,
        form: new Form({
            message: '',
            template: null,
            relationship: null,
            book_id: null,
        }),
        loading: false,
    }),

    async mounted() {
        try {
            this.loading = true;
            // await this.fetchTemplates();
        } catch (error) {
        } finally {
            this.loading = false;
        }
    },

    methods: {
        async fetchTemplates() {
            try {
                const response = await axios.get(
                    "/api/celebrations/templates/messages"
                );
                this.templates = response.data;
            } catch (e) {
                throw e;
            }
        },

        async createMessage() {
            try {
                this.loading = true;
                this.form.book_id = this.bookId;
                const response = await this.form.post(
                    "/api/celebrations/message"
                );

                const responseData = response.data;

                if (responseData.status) {
                    Toast.fire({
                        icon: "success",
                        text: "Your message was added successfully",
                    });
                    location.href = `/book/book/pdf/read/${this.bookId}`;
                } else {
                    this.$swal.fire({
                    icon: "error",
                    title: "An error occurred",
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
