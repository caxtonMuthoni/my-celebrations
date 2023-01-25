<template>
    <div class="">
        <div v-if="shorturl !== 'none'" class="row cta_bar">
            <div class="col-sm-7 col-md-7">
                <h4>{{ book.title }}</h4>
            </div>
            <div class="col-sm-5 col-md-5">
                <a href="#" class="btn btn-primary m-2" @click.prevent="requestFullScreen">
                    <i class="fa fa-expand me-2" aria-hidden="true"></i>
                    Fullscreen</a>

                <a v-if="userid == book.user_id" href="#" class="btn btn__primary m-2" @click.prevent="printPDF"><i
                        class="fa fa-print me-2" aria-hidden="true"></i>Print</a>

                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sharemodal"><i
                        class="fa fa-share me-2" aria-hidden="true"></i>Share</a>
            </div>
        </div>
        <div id="flipbook-wrapper-id" class="flipbook-wrapper">
            <div class="content-con">
                <div id="flipbook">
                </div>
                <div v-if="!indicatorHidden" class="flipbook-indicator text-light" @click="indicatorHidden = true">
                    <i class="fa fa-times me-2 fa-lg"></i>
                    <span>Click on the top or bottom ends to flip the pages</span>
                    <i class="fa fa-arrow-right ms-2 fa-lg arrow bounce"></i>
                </div>
            </div>
        </div>
        <!-- <div id="pdfvuerdiv" class="pdfvuerclas bg-dark container">
            <div id="pdfvuer">
                <div
                    id="buttons"
                    class="ui grey three item inverted bottom fixed menu transition"
                >
                    <a class="item" @click="page > 1 ? page-- : 1">
                        <i class="left chevron icon"></i>
                        Back
                    </a>
                    <a class="ui active item">
                        {{ page }} / {{ numPages ? numPages : "Loading" }}
                    </a>
                    <a class="item" @click="page < numPages ? page++ : 1">
                        Forward
                        <i class="right chevron icon"></i>
                    </a>
                </div>
                <div
                    id="buttons"
                    class="ui grey three item inverted bottom fixed menu transition hidden"
                >
                    <a class="item" @click="scale -= scale > 0.2 ? 0.1 : 0">
                        <i class="left chevron icon" />
                        Zoom -
                    </a>
                    <a class="ui active item"> {{ formattedZoom }} % </a>
                    <a class="item" @click="scale += scale < 2 ? 0.1 : 0">
                        Zoom +
                        <i class="right chevron icon" />
                    </a>
                </div>
                <pdf
                    :src="pdfdata"
                    v-for="i in numPages"
                    :key="i"
                    :id="i"
                    :page="i"
                    :scale.sync="scale"
                    style="width: 100%; margin: 20px auto"
                    :annotation="true"
                    :resize="true"
                    @link-clicked="handle_pdf_link"
                >
                    <template slot="loading">
                        loading content here...
                    </template>
                </pdf>
            </div>
        </div> -->
        <!-- Share modal -->
        <div class="modal fade" id="sharemodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Select the social network to share to
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="share">
                                    <i class="fab fa-facebook share-icon" aria-hidden="true"></i>
                                    <div class="share__btn">
                                        <ShareNetwork network="facebook" :url="shorturl" :title="book.title"
                                            :description="book.cover_message" :quote="book.cover_message"
                                            hashtags="mycelebrationbooks">
                                            Facebook
                                        </ShareNetwork>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="share">
                                    <i class="fab fa-whatsapp share-icon" aria-hidden="true"></i>
                                    <div class="share__btn">
                                        <ShareNetwork network="whatsapp" :url="shorturl" :title="book.title"
                                            :description="book.cover_message" :quote="book.cover_message"
                                            hashtags="mycelebrationbooks">
                                            Whatsapp
                                        </ShareNetwork>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="share">
                                    <i class="fa fa-envelope share-icon" aria-hidden="true"></i>
                                    <div class="share__btn">
                                        <ShareNetwork network="email" :url="shorturl" :title="book.title"
                                            :description="book.cover_message" :quote="book.cover_message"
                                            hashtags="mycelebrationbooks">
                                            Email
                                        </ShareNetwork>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <div class="share">
                                    <i class="fab fa-telegram share-icon" aria-hidden="true"></i>
                                    <div class="share__btn">
                                        <ShareNetwork network="telegram" :url="shorturl" :title="book.title"
                                            :description="book.cover_message" :quote="book.cover_message"
                                            hashtags="mycelebrationbooks">
                                            Telegram
                                        </ShareNetwork>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <input hidden id="linkInput" type="text" :value="shorturl">
                                <a href="#" class="btn btn-outline-info mt-2 btn-lg"
                                    @click.prevent="copyTextToClipboard">Copy Link</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Toast from '../utils/toast';

export default {
    props: {
        pdfurl: {
            type: String,
            required: true,
        },

        shorturl: {
            type: String,
            required: true,
        },

        book: {
            type: Object,
            required: true,
        },

        userid: {
            type: Number,
            required: false,
            default: null
        }
    },
    data() {
        return {
            screenWidth: 0,
            indicatorHidden: false,
        };
    },

    mounted() {
        this.screenWidth = screen.width;
        this.loadPdfData()
    },

    methods: {

        loadPdfData() {
            var loadingTask = pdfjsLib.getDocument(this.pdfurl);
            const _vm = this;
            loadingTask.promise.then(function (pdf) {
                const parent = document.getElementById('flipbook');
                for (let i = 0; i < pdf.numPages; i++) {
                    const node = document.createElement("canvas");
                    var pageNumber = i + 1;
                    node.id = "canvas-id-" + pageNumber;
                    parent.appendChild(node)
                    _vm.renderPage(pdf, node, pageNumber)
                }

                const node = document.createElement("div");
                node.style.backgroundColor = "#fff";
                node.style.display = "flex";
                node.style.alignItems = "center";
                node.style.justifyContent = "center";
                const h1Node = document.createElement("h1");
                const textnode = document.createTextNode("THE END.");
                h1Node.appendChild(textnode);
                node.appendChild(h1Node)
                parent.appendChild(node)
                _vm.renderPage(pdf, node, pageNumber + 1)

                if (_vm.screenWidth > 1024) {
                    $('#flipbook').turn({
                        display: 'double',
                        acceleration: true,
                        elevation: 50,
                        autocenter: true,
                        gradients: true,
                        zoom: 2,
                        duration: 1000,
                        when: {
                            turned: function (e, page) {
                                const canvaOne = document.getElementById('flipbook');
                                if (page < 2) {
                                    canvaOne.style.marginLeft = "-100px";
                                }
                                else {
                                    canvaOne.style.margin = "auto";
                                }
                            }
                        }
                    });

                } else {
                    $('#flipbook').turn({
                        display: 'single',
                        acceleration: true,
                        elevation: 50,
                        autocenter: true,
                        gradients: true,
                        zoom: 2,
                        duration: 1000,
                        when: {
                            turned: function (e, page) {
                                // const canvaOne = document.getElementById('flipbook');
                                // if (page < 2) {
                                //     canvaOne.style.marginLeft = "-100px";
                                // }
                                // else {
                                //     canvaOne.style.margin = "auto";
                                // }
                            }
                        }
                    });

                }

            }, function (reason) {
                // PDF loading error
                console.error(reason);
            });
        },

        renderPage(pdf, canvas, pageNumber) {
            pdf.getPage(pageNumber).then(function (page) {
                var scale = 1.5;
                var viewport = page.getViewport({ scale: scale });
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);
                renderTask.promise.then(function () {

                });
            });
        },

        // print pdf
        printPDF() {
            var iframe = document.createElement("iframe");
            iframe.style.visibility = "hidden";
            iframe.src = this.pdfurl;
            document.body.appendChild(iframe);

            iframe.onload = () => {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            }
        },

        requestFullScreen() {
            var elem = document.getElementById("flipbook-wrapper-id");
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) {
                /* Safari */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                /* IE11 */
                elem.msRequestFullscreen();
            }
        },

        copyTextToClipboard() {
            var copyText = document.getElementById("linkInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            Toast.fire({
                title: 'Success',
                text: 'Link copied to clipboard',
                icon: 'info'
            })
        },
    },
};
</script>

<style lang="css" scoped>
.cta_bar {
    border-bottom: 1px solid rgba(192, 192, 192, 0.229);
    padding: 20px;
    padding-top: 0 !important;
}

#buttons {
    margin-left: 0 !important;
    margin-right: 0 !important;
}

/* Page content */
.flipbook-wrapper {
    background: rgb(27, 27, 27);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

#flipbook {
    width: 80%;
    height: 100vh;
    margin: auto;
    overflow: hidden;

}

.content-con {
    position: relative !important;
}

.flipbook-indicator {
    position: absolute !important;
    top: 0;
    right: 50px;
    background: rgba(0, 0, 0, 0.742);
    padding: 10px;
    display: flex;
    align-items: center;
    border-radius: 5px;
    cursor: pointer;
}

.bounce {
    animation: bounce 2s infinite;
}

@keyframes bounce {

    0%,
    20%,
    50%,
    80%,
    100% {
        transform: translateX(0);
    }

    40% {
        transform: translateX(-30px);
    }

    60% {
        transform: translateX(-15px);
    }
}

@media screen and (max-width:1024px) {
    #flipbook {
        width: 100%;
        padding-left: 10px;
        padding-right: 0;
        height: 90vh;
    }
}

#flipbook {
    -webkit-transition: margin-left 0.2s ease-in-out;
    -moz-transition: margin-left 0.2s ease-in-out;
    -o-transition: margin-left 0.2s ease-in-out;
    -ms-transition: margin-left 0.2s ease-in-out;
    transition: margin-left 0.2s ease-in-out;
}

#flipbook .turn-page {
    background-color: rgb(243, 243, 243);
    background-size: cover;
}

.share {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100px;
    height: 100px;
    flex-direction: column;
    border: 1px solid #364787;
    border-radius: 5px;
    color: #364787 !important;
}

.share-icon {
    font-size: 25px;
}
</style>
