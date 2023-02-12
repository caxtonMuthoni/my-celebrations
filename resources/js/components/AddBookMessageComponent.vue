<template>
    <loader-component v-if="loading" />
    <div v-else class="book-message row">
        <!-- Step 1 -->
        <div v-if="step == 1" class="row justify-content-center book-create__row">
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
                <div v-for="(template, i) in templates" :key="i" class="col-md-3">
                    <div class="book-create__template">
                        <input v-model="form.template" class="book-create__template--input" type="radio" name="template"
                            :id="'template-' + i" :value="template.id" />
                        <label :for="'template-' + i" class="book-create__template--lable shadow-sm">
                            <div class="book-create__template--lable--top">
                                <img :src="template.image.url" alt="" class="book-create__template--lable--top_img" />
                            </div>
                            <div class="book-create__template--lable--content">
                                <div class="book-create__template--lable--content_header">
                                    {{ template.name }}
                                </div>
                                <div class="book-create__template--lable--content_description">
                                    {{ template.description }}
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="book-create__btns">
                    <button class="btn btn-block btn-lg btn__primary mt-3" :disabled="!form.template" @click="nextPage">
                        Next
                        <i class="fa fa-arrow-right ms-2" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>

        <div v-if="step == 2" class="row justify-content-center book-create__row">
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
            <div class="col-md-11">
                <div class="alert alert-info">
                    NB. All the messages sent here will be reviewed by the owner
                    of the book. Once the owner approves your message, it will
                    be published to the book.
                </div>
                <div class="card p-2 px-5 text-start row">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="relationship" class="form-label">Title</label>
                                <input v-model="form.title" type="text" class="form-control" name="title" id="title"
                                    aria-describedby="title" placeholder="eg. Mr." required />
                                <small id="title" class="form-text text-muted">Examples Mr., Miss etc.</small>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Your name</label>
                                <input v-model="form.name" type="text" class="form-control" name="name" id="name"
                                    aria-describedby="name" placeholder="eg. John" required />
                                <small id="name" class="form-text text-muted">What is your name ?</small>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Your email address</label>
                                <input v-model="form.email" type="email" class="form-control" name="email" id="email"
                                    aria-describedby="email" required />
                                <small id="email" class="form-text text-muted">What is your email address.</small>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="relationship" class="form-label">What is your relationship with the book
                                    owner?</label>
                                <input v-model="form.relationship" type="text" class="form-control" name="relationship"
                                    id="relationship" aria-describedby="relationship" placeholder="eg. Brother"
                                    required />
                                <small id="relationship" class="form-text text-muted">Examples friend, brother, mother,
                                    teacher
                                    etc.</small>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Enter the message</label>
                                <textarea v-model="form.message" class="form-control" name="message" id="message"
                                    required rows="3"></textarea>
                                <p class="form-text" :class="{ 'text-danger': form.message.length > maxCharacteres }">
                                    Maximum characters is {{ maxCharacteres }} - {{ form.message.length }} / {{
                                        maxCharacteres
                                    }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center px-5 mt-3">
                    <h4 class="heading">Add book image (Optional)</h4>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label text-start text-left">Upload an image (Optional)</label>
                            <input type="file" class="form-control form-control-lg" name="image" id="image"
                                aria-describedby="title" placeholder="" @change="handleImage"/>
                            <small id="titl" class="form-text text-muted">Upload an image to attach to the book</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="caption" class="form-label text-start text-left">Add image caption (Optional)</label>
                            <textarea v-model="form.caption" type="text" class="form-control" name="caption" id="caption"
                                aria-describedby="caption"></textarea>
                            <small id="cp" class="form-text text-muted">Add caption to the uploaded image.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="book-create__btns">
                    <button class="btn btn-block btn-lg btn__primary mt-3" @click="createMessage"
                        :disabled="form.message.length > maxCharacteres">
                        Send Message
                        <i class="fa fa-share ms-2" aria-hidden="true"></i>
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
        maxCharacteres: 500,
        form: new Form({
            name: '',
            title: '',
            email: '',
            message: '',
            template: null,
            relationship: null,
            book_id: null,
            image: null,
            caption: ''
        }),
        loading: false,
    }),

    methods: {
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
                        text: responseData.message,
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

        handleImage(event) {
            const file = event.target.files[0];
            this.form.image = file;
            console.log(this.form, "Tedting");
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

<style>

</style>
