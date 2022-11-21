<template>
    <div class="w-100">
        <div v-if="shorturl !== 'none'" class="row cta_bar">
            <div class="col-sm-7 col-md-7">
                <h4>{{ book.title }}</h4>
            </div>
            <div class="col-sm-5 col-md-5">
                <a
                    href="#"
                    class="btn btn-primary me-4"
                    @click.prevent="requestFullScreen"
                >
                    <i class="fa fa-expand me-2" aria-hidden="true"></i>
                    Fullscreen</a
                >
                
                <a
                  v-if="userid == book.user_id"
                    href="#"
                    class="btn btn__primary me-4"
                    @click.prevent="printPDF"
                    ><i class="fa fa-print me-2" aria-hidden="true"></i>Print</a
                >

                <a
                    href="#"
                    class="btn btn-success"
                    data-bs-toggle="modal"
                    data-bs-target="#sharemodal"
                    ><i class="fa fa-share me-2" aria-hidden="true"></i>Share</a
                >
            </div>
        </div>
        <div id="pdfvuerdiv" class="pdfvuerclas bg-dark container">
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
                <!-- <pdf
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
                </pdf> -->
            </div>
        </div>
        <!-- Share modal -->
        <div
            class="modal fade"
            id="sharemodal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modelTitleId"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Select the social network to share to
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="share">
                                    <i
                                        class="fab fa-facebook share-icon"
                                        aria-hidden="true"
                                    ></i>
                                    <div class="share__btn">
                                        <ShareNetwork
                                            network="facebook"
                                            :url="shorturl"
                                            :title="book.title"
                                            :description="book.cover_message"
                                            :quote="book.cover_message"
                                            hashtags="mycelebrationbooks"
                                        >
                                            Facebook
                                        </ShareNetwork>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="share">
                                    <i
                                        class="fab fa-whatsapp share-icon"
                                        aria-hidden="true"
                                    ></i>
                                    <div class="share__btn">
                                        <ShareNetwork
                                            network="whatsapp"
                                            :url="shorturl"
                                            :title="book.title"
                                            :description="book.cover_message"
                                            :quote="book.cover_message"
                                            hashtags="mycelebrationbooks"
                                        >
                                            Whatsapp
                                        </ShareNetwork>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="share">
                                    <i
                                        class="fa fa-envelope share-icon"
                                        aria-hidden="true"
                                    ></i>
                                    <div class="share__btn">
                                        <ShareNetwork
                                            network="email"
                                            :url="shorturl"
                                            :title="book.title"
                                            :description="book.cover_message"
                                            :quote="book.cover_message"
                                            hashtags="mycelebrationbooks"
                                        >
                                            Email
                                        </ShareNetwork>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <div class="share">
                                    <i
                                        class="fab fa-telegram share-icon"
                                        aria-hidden="true"
                                    ></i>
                                    <div class="share__btn">
                                        <ShareNetwork
                                            network="telegram"
                                            :url="shorturl"
                                            :title="book.title"
                                            :description="book.cover_message"
                                            :quote="book.cover_message"
                                            hashtags="mycelebrationbooks"
                                        >
                                            Telegram
                                        </ShareNetwork>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <input hidden id="linkInput" type="text" :value="shorturl">
                                <a href="#" class="btn btn-outline-info mt-2 btn-lg" @click.prevent="copyTextToClipboard">Copy Link</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// import pdfvuer from "pdfvuer";
import Toast from '../utils/toast';


export default {
    components: {
        pdf: pdfvuer,
    },
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
            page: 1,
            numPages: 0,
            pdfdata: undefined,
            errors: [],
            scale: "page-width",
        };
    },
    computed: {
        formattedZoom() {
            return Number.parseInt(this.scale * 100);
        },
    },
    mounted() {
        this.getPdf();
    },
    watch: {
        show: function (s) {
            if (s) {
                this.getPdf();
            }
        },
        page: function (p) {
            if (
                window.pageYOffset <=
                    this.findPos(document.getElementById(p)) ||
                (document.getElementById(p + 1) &&
                    window.pageYOffset >=
                        this.findPos(document.getElementById(p + 1)))
            ) {
                // window.scrollTo(0,this.findPos(document.getElementById(p)));
                document.getElementById(p).scrollIntoView();
            }
        },
    },
    methods: {
        handle_pdf_link: function (params) {
            // Scroll to the appropriate place on our page - the Y component of
            // params.destArray * (div height / ???), from the bottom of the page div
            var page = document.getElementById(String(params.pageNumber));
            page.scrollIntoView();
        },
        getPdf() {
            var self = this;
            self.pdfdata = pdfvuer.createLoadingTask(this.pdfurl);
            self.pdfdata.then((pdf) => {
                self.numPages = pdf.numPages;
                window.onscroll = function () {
                    changePage();
                    stickyNav();
                };

                // Get the offset position of the navbar
                var sticky = $("#buttons")[0].offsetTop;

                // Add the sticky class to the self.$refs.nav when you reach its scroll position. Remove "sticky" when you leave the scroll position
                function stickyNav() {
                    if (window.pageYOffset >= sticky) {
                        $("#buttons")[0].classList.remove("hidden");
                    } else {
                        $("#buttons")[0].classList.add("hidden");
                    }
                }

                function changePage() {
                    var i = 1,
                        count = Number(pdf.numPages);
                    do {
                        if (
                            window.pageYOffset >=
                                self.findPos(document.getElementById(i)) &&
                            window.pageYOffset <=
                                self.findPos(document.getElementById(i + 1))
                        ) {
                            self.page = i;
                        }
                        i++;
                    } while (i < count);
                    if (
                        window.pageYOffset >=
                        self.findPos(document.getElementById(i))
                    ) {
                        self.page = i;
                    }
                }
            });
        },
        findPos(obj) {
            return obj.offsetTop;
        },

        // print pdf
        printPDF() {
            var iframe = document.createElement("iframe");
            iframe.style.visibility = "hidden";
            iframe.src = this.pdfurl;
            document.body.appendChild(iframe);
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        },

        requestFullScreen() {
            var elem = document.getElementById("pdfvuerdiv");
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
<style src="pdfvuer/dist/pdfvuer.css"></style>
<style lang="css" scoped>
@import "https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css";
.cta_bar {
    border-bottom: 1px solid rgba(192, 192, 192, 0.229);
    padding: 20px;
    padding-top: 0 !important;
}
.pdfvuerclas {
    padding: 20px 10%;
    margin-top: 20px;
    border-radius: 5px;
}
#buttons {
    margin-left: 0 !important;
    margin-right: 0 !important;
}
/* Page content */
.content {
    padding: 16px;
}

.pdfvuerclas {
    overflow-y: auto;
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
