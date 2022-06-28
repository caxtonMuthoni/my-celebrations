<template>
    <div class="card" style="">
        <div class="card-body">
            <h5 class="card-title">Friend Messages</h5>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div
                        v-for="(message, i) in messages"
                        :key="i + 'sadfdsfeswe'"
                        class="card p-2 mt-3 book-content__message"
                    >
                        <figure class="text-center">
                            <blockquote class="blockquote">
                                <p>
                                    {{ message.message }}
                                </p>
                            </blockquote>
                            <figcaption class="blockquote-footer">
                                {{ message.relationship }}
                                <cite title="Source Title">{{
                                    message.user.name
                                }}</cite>
                            </figcaption>
                        </figure>
                        <div class="book-content__message--btn">
                            <button
                                v-if="!message.public"
                                class="btn btn-sm btn__primary mx-2"
                                @click="toggleBookMessageStatus(message.id)"
                                :disabled="loading"
                            >
                                Add to book
                            </button>

                            <button
                                v-else
                                class="btn btn-sm btn-warning mx-2"
                                @click="toggleBookMessageStatus(message.id)"
                                :disabled="loading"
                            >
                                Remove from book
                            </button>

                            <button
                                @click="deleteMessage(message.id)"
                                :disabled="loading"
                                class="btn btn-outline-danger btn-sm mx-2"
                            >
                                <i
                                    class="fa fa-trash me-2"
                                    aria-hidden="true"
                                ></i>
                                Delete Message
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Toast from "../utils/toast";
export default {
    props: {
        messages: {
            required: true,
            type: Array,
        },
    },

    data: () => ({
        loading: false,
    }),

    methods: {
        async deleteMessage(id) {
            try {
                this.loading = true;
                const response = await axios.delete(
                    `/api/celebrations/bookmessage/${id}`
                );
                const responseData = response.data;
                if (responseData.status) {
                    Toast.fire({
                        icon: "success",
                        text: "Your message deleted successfully",
                    });
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

        async toggleBookMessageStatus(id) {
            try {
                this.loading = true;
                const response = await axios.post(
                    "/api/celebrations/togglebookstatus/" + id
                );
                const responseData = response.data;
                if (responseData.status) {
                    Toast.fire({
                        icon: "success",
                        text: "The message was updated successfully",
                    });
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
