<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Friend pictures</h5>
            <div class="row justify-content-center">
                <div class="col-md-11 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Picture</th>
                            <th>Caption</th>
                            <th>Added By</th>
                            <th>Approve/Disapprove</th>
                            <th>Delete Image</th>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(picture, i) in pictures"
                                :key="picture.id + 'rfrpikerqw'"
                            >
                                <td>
                                    <span class="table__item">{{ i + 1 }}</span>
                                </td>
                                <td>
                                    <img
                                        class="table__item mybooks__img"
                                        :src="picture.image"
                                        alt=""
                                    />
                                </td>
                                <td>
                                    <span class="table__item">{{
                                        picture.caption
                                    }}</span>
                                </td>
                                 <td>
                                    <span class="table__item">{{
                                        picture.user.name
                                    }}</span>
                                </td>
                                <td>
                                    <span class="table__item">
                                        <button
                                            v-if="!picture.published"
                                            :disabled="loading"
                                            class="btn btn-sm btn__primary"
                                            @click.prevent.stop="
                                                toggleImageStatus(picture.id)
                                            "
                                        >
                                            Add to book
                                        </button>

                                        <button
                                            v-else
                                            class="btn btn-sm btn-warning"
                                            @click.prevent.stop="
                                                toggleImageStatus(picture.id)
                                            "
                                            :disabled="loading"
                                        >
                                            Remove from book
                                        </button>
                                    </span>
                                </td>
                                <td>
                                    <span class="table__item">
                                        <button
                                            @click="deleteImage(picture.id)"
                                            :disabled="loading"
                                            v-tooltip.top="'Delete this image'"
                                            class="btn btn-outline-danger btn-sm book-content__image--bt"
                                        >
                                            <i
                                                class="fa fa-trash"
                                                aria-hidden="true"
                                            ></i>
                                        </button>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Toast from "../utils/toast";
export default {
    props: {
        pictures: {
            required: true,
            type: Array,
        },
    },

    data: () => ({
        loading: false,
    }),

    methods: {
        async toggleImageStatus(id) {
            try {
                this.loading = true;
                const response = await axios.post(
                    "/api/celebrations/togglebookimagestatus/" + id
                );
                const responseData = response.data;
                if (responseData.status) {
                    Toast.fire({
                        icon: "success",
                        text: "The image was updated successfully",
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
    },
};
</script>

<style></style>
