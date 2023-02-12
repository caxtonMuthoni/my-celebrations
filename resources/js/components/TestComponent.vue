<template>
    <div>
        <button class="btn btn-primary mb-4" @click="htmlToImage">To Image</button>
        <div class="book-container" id="my-node">
            <div class="book-container__header">
                <h1 class="book-container__header--title">Shaddy Aggy Anniversary</h1>
                <div class="book-container__header--image">
                    <img class="book-container__header--image-photo"
                        src="https://images.pexels.com/photos/4746698/pexels-photo-4746698.jpeg?auto=compress&cs=tinysrgb&w=600"
                        alt="">
                </div>
                <p class="book-container__cover-message">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Illum, odit. Nam delectus reiciendis fuga, quos cumque vitae eveniet error a?</p>
            </div>
            <div class="book-container__body px-5">
                <p v-for="i in 10">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit adipisci et
                    ipsam. Doloribus
                    commodi culpa facilis quisquam exercitationem architecto impedit sit voluptatum quos voluptas ipsa
                    cupiditate tempore quaerat voluptate repellendus ad voluptatem eligendi expedita quas numquam
                    inventore, dolorem magni fugit. Unde, rem ab. Accusamus voluptate rem maxime totam eveniet quas
                    pariatur quaerat optio facilis et ratione omnis, natus corrupti beatae expedita blanditiis earum
                    dicta, possimus illo cum odio amet accusantium? Alias, nam recusandae. Sapiente impedit maxime neque
                    praesentium dolor aspernatur ex minus assumenda quos consequatur dolores deleniti, ut expedita
                    officia velit modi ab itaque ipsa voluptatum architecto, accusamus fugit eaque.</p>
            </div>
            <div class="book-container__images">

            </div>
            <div class="book-container__messages">

            </div>
        </div>
        <div id="image-container-print bg-success px-5"></div>
    </div>
</template>

<script>
import { toPng, toJpeg, toBlob, toPixelData, toSvg } from 'html-to-image';
export default {

    methods: {
        htmlToImage() {
            var node = document.getElementById('my-node');
            var nodeImg = document.getElementById('image-container-print');

            toPng(node)
                .then(function (dataUrl) {
                    var img = new Image();
                    img.src = dataUrl;
                    img.onload = function () { img.contentWindow.print(); }
                })
                .catch(function (error) {
                    console.error('oops, something went wrong!', error);
                });
        }
    }
}
</script>

<style lang="scss" scoped>
.book-container {
    background: rgb(175, 174, 174);
    color: blue;

    &__header {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;

        &--image {
            height: 300px;
            width: 300px;
            overflow: hidden;
            border-radius: 100%;
            margin: 50px 0;

            &-photo {
                height: 100%;
                width: 100%;
            }
        }
    }
}
</style>