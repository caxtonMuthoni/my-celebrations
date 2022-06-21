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
                    <div>&nbsp;</div>
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
                        class="btn btn-secondary btn-lg mt-3"
                        @click="prevPage"
                    >
                        <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                        Back
                    </button>
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
                            accept="image/*"
                            aria-describedby="book-title"
                            placeholder="Book title"
                            @change="handleFile"
                        />
                        <small id="book-title" class="form-text text-muted"
                            >Upload your book's cover image.</small
                        >
                        <HasError :form="form" field="cover_image" />
                    </div>
                    <div class="form-chec mt-4 switcher-container">
                        <div class="toggleWrapper">
                            <input
                                v-model="form.public"
                                type="checkbox"
                                class="dn"
                                id="dn2"
                            />
                            <label for="dn2" class="toggle">
                                <span class="toggle__handler">
                                    <span class="crater crater--1"></span>
                                    <span class="crater crater--2"></span>
                                    <span class="crater crater--3"></span>
                                </span>
                                <span class="star star--1"></span>
                                <span class="star star--2"></span>
                                <span class="star star--3"></span>
                                <span class="star star--4"></span>
                                <span class="star star--5"></span>
                                <span class="star star--6"></span>
                            </label>
                        </div>
                        <div class="ms-3" :class="{'text-success': form.public}">
                            <label
                                class="form-check-label"
                                for="accept_message"
                            >
                                Do you want this book to be public ?
                            </label>
                            <br />
                            <small id="book-title" class="form-text" :class="{'text-success': form.public}"
                                >Public books can be read by anyone who can
                                access mycelebrationbooks.com</small
                            >
                        </div>
                    </div>

                    <div class="form-chec mt-4 switcher-container">
                        <div class="toggleWrapper">
                            <input
                                v-model="form.accept_message"
                                type="checkbox"
                                class="dn"
                                id="dn"
                            />
                            <label for="dn" class="toggle">
                                <span class="toggle__handler">
                                    <span class="crater crater--1"></span>
                                    <span class="crater crater--2"></span>
                                    <span class="crater crater--3"></span>
                                </span>
                                <span class="star star--1"></span>
                                <span class="star star--2"></span>
                                <span class="star star--3"></span>
                                <span class="star star--4"></span>
                                <span class="star star--5"></span>
                                <span class="star star--6"></span>
                            </label>
                        </div>
                        <div class="ps-3" :class="{'text-success': form.accept_message}">
                            <label
                                class="form-check-label"
                                for="accept_message"
                            >
                                Do you want to accept messages ?
                            </label>
                            <br />
                            <small id="book-title" class="form-text" :class="{'text-success': form.accept_message}"
                                >Other mycelebration books users can add
                                messages to the book</small
                            >
                        </div>
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
                        <small
                            id="book-title"
                            class="form-text"
                            :class="{
                                'text-danger':
                                    form.cover_message.length >
                                    coverMessageCharacters,
                            }"
                            >What is your book's cover message ?
                            {{ form.cover_message.length }}/{{
                                coverMessageCharacters
                            }}</small
                        >
                        <HasError :form="form" field="cover_message" />
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="book-create__btns">
                    <button
                        class="btn btn-secondary btn-lg mt-3"
                        @click="prevPage"
                    >
                        <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                        Back
                    </button>
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
import Toast from "../utils/toast";

export default {
    components: { SearchComponent, LoaderComponent },
    data: () => ({
        step: 1,
        categories: [],
        coverMessageCharacters: 150,
        templates: [],
        form: new Form({
            category: null,
            template: null,
            cover_message: "",
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
            // await this.fetchTemplates();
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
                const response = await axios.get(
                    "/api/celebrations/templates/" + this.form.category
                );
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
            const size = file.size / 1024 / 1024 ;
            // if(size > 2) {
            //     this.form.errors.set('cover_image', 'The selected image size is greator than 2MB.')
            //     Toast.fire({
            //         title: 'File is too large',
            //         text: "Cover image must not be more than 2MB",
            //         icon: "info"
            //     })
            // }
            // else {
                this.form.errors.clear('cover_image')
                this.form.cover_image = file;
            // }
        },

        async nextPage() {
            if (this.step === 1) {
                this.loading = true;
                await this.fetchTemplates();
                this.loading = false;
            }
            this.step++;
        },

        prevPage() {
            this.step--;
        },
    },
};
</script>

<style lang="scss" scoped>
.switcher-container {
    display: flex;
    justify-content: flex-start;
}
.toggleWrapper {
    width: 100px;
    position: relative;
    // overflow: hidden;
    //   padding: 0 200px;

    input {
        position: absolute;
        left: -99em;
    }
}

.toggle {
    cursor: pointer;
    display: inline-block;
    position: relative;
    width: 70px;
    height: 30px;
    background-color: #dad8cf;
    border-radius: 90px - 6;
    transition: background-color 200ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
}

.toggle__handler {
    display: inline-block;
    position: relative;
    z-index: 1;
    top: 3px;
    left: 3px;
    width: 30px - 6;
    height: 30px - 6;
    background-color: #ffcf96;
    border-radius: 50px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    transition: all 400ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
    transform: rotate(-45deg);

    .crater {
        position: absolute;
        background-color: #e8cda5;
        opacity: 0;
        transition: opacity 200ms ease-in-out;
        border-radius: 100%;
    }

    .crater--1 {
        top: 18px;
        left: 10px;
        width: 4px;
        height: 4px;
    }

    .crater--2 {
        top: 28px;
        left: 22px;
        width: 6px;
        height: 6px;
    }

    .crater--3 {
        top: 10px;
        left: 25px;
        width: 8px;
        height: 8px;
    }
}

.star {
    position: absolute;
    background-color: #ffffff;
    transition: all 300ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
    border-radius: 50%;
}

.star--1 {
    top: 10px;
    left: 35px;
    z-index: 0;
    width: 30px;
    height: 3px;
}

.star--2 {
    top: 18px;
    left: 28px;
    z-index: 1;
    width: 30px;
    height: 3px;
}

.star--3 {
    top: 27px;
    left: 40px;
    z-index: 0;
    width: 30px;
    height: 3px;
}

.star--4,
.star--5,
.star--6 {
    opacity: 0;
    transition: all 300ms 0 cubic-bezier(0.445, 0.05, 0.55, 0.95);
}

.star--4 {
    top: 16px;
    left: 11px;
    z-index: 0;
    width: 2px;
    height: 2px;
    transform: translate3d(3px, 0, 0);
}

.star--5 {
    top: 32px;
    left: 17px;
    z-index: 0;
    width: 3px;
    height: 3px;
    transform: translate3d(3px, 0, 0);
}

.star--6 {
    top: 36px;
    left: 28px;
    z-index: 0;
    width: 2px;
    height: 2px;
    transform: translate3d(3px, 0, 0);
}

input:checked {
    + .toggle {
        background-color: #74d6b0;

        &:before {
            color: #749ed7;
        }

        &:after {
            color: #ffffff;
        }

        .toggle__handler {
            background-color: #ffe5b5;
            transform: translate3d(40px, 0, 0) rotate(0);

            .crater {
                opacity: 1;
            }
        }

        .star--1 {
            width: 2px;
            height: 2px;
        }

        .star--2 {
            width: 4px;
            height: 4px;
            transform: translate3d(-5px, 0, 0);
        }

        .star--3 {
            width: 2px;
            height: 2px;
            transform: translate3d(-7px, 0, 0);
        }

        .star--4,
        .star--5,
        .star--6 {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
        .star--4 {
            transition: all 300ms 200ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
        }
        .star--5 {
            transition: all 300ms 300ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
        }
        .star--6 {
            transition: all 300ms 400ms cubic-bezier(0.445, 0.05, 0.55, 0.95);
        }
    }
}
</style>
