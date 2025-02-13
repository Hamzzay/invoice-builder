<template>
    <!-- https://codepen.io/vinceumo/pen/qKPzjL -->
    <section class="invoice-main-section">
        <FromAddressModal />
        <ToAddressModal />
        <InvoiceSampleModal :continueInvoice=" continueInvoice " />
        <PreviewPdfModal ref="childComp" />
        <DiscountModal />
        <ShippingModal />
        <TaxModal />
        <div class="container">
            <div class="content-max-width">
                <div class="row">
                    <div class="col-md-12">
                        <div class="w-100">
                            <div class="tall">
                                <h1 class="invoice-main-heading">
                                    <span>
                                        <span>
                                            <em class="accent">Free</em>
                                        </span>
                                        invoice generator.
                                    </span>
                                </h1>
                                <p class="subheading">
                                    Create your own invoice with our free
                                    invoice maker below. This tool is 100% free!
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="invoice-block">
                                    <div class="invoice-block-inside">
                                        <Header />
                                        <InvoiceItem />
                                        <InvoiceFooter :subTotal=" subTotal " :grandTotal=" grandTotal " />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex flex-column gap-2 mt-2 mb-2">
                                    <button type="button" @click=" downloadInvoice "
                                        class="btn btn-primary-orange w-100" :disabled=" isDownloadingDisabled ">
                                        <span v-if=" isDownloading " class="spinner-border spinner-border-sm"
                                            aria-hidden="true"></span>
                                        <span role="status">Download</span>
                                    </button>
                                    <button type="button" class="btn btn-primary-blue w-100" @click=" preview "
                                        :disabled=" isDisabledPreview ">
                                        <span v-if=" isPreviewing " class="spinner-border spinner-border-sm"
                                            aria-hidden="true"></span>
                                        <span role="status">Preview</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import Header from "./InvoiceComponents/Header.vue";
import InvoiceFooter from "./InvoiceComponents/InvoiceFooter.vue";
import InvoiceItem from "./InvoiceComponents/InvoiceItem.vue";
import FromAddressModal from "./Modals/FromAddressModal.vue";
import ToAddressModal from "./Modals/ToAddressModal.vue";
import InvoiceSampleModal from './Modals/InvoiceSampleModal.vue';
import PreviewPdfModal from './Modals/PreviewPdfModal.vue';
import DiscountModal from './Modals/DiscountModal.vue';
import ShippingModal from "./Modals/ShippingModal.vue";
import TaxModal from './Modals/TaxModal.vue';
import { Modal } from "bootstrap";
import { mapActions, mapGetters, mapState } from "vuex";
export default {
    name: "Home",
    components: {
        Header,
        InvoiceItem,
        InvoiceFooter,
        FromAddressModal,
        ToAddressModal,
        InvoiceSampleModal,
        PreviewPdfModal,
        DiscountModal,
        ShippingModal,
        TaxModal,
    },
    data() {
        return {
            refPdfIframe: "pdfIframe",
        };
    },
    methods: {

        async continueInvoice() {
            const formData = new FormData();
            formData.append("formValues", JSON.stringify(this.formValues));
            formData.append("sub_total", this.subTotal.toFixed(2));
            formData.append("grand_total", this.grandTotal.toFixed(2));
            if (this.formValues.logo) {
                formData.append("logo", this.formValues.logo);
            }
            if (this.formValues.signature) {
                formData.append("signature", this.formValues.signature);
            }
            await this.continueInvoiceApi({ formData: formData, invoiceNumber: this.formValues.invoiceNumber });
        },

        async preview() {
            const formData = new FormData();
            formData.append("formValues", JSON.stringify(this.formValues));
            formData.append("sub_total", this.decimalDigits(this.subTotal));
            formData.append("grand_total", this.decimalDigits(this.grandTotal));
            if (this.formValues.logo) {
                formData.append("logo", this.formValues.logo);
            }
            if (this.formValues.signature) {
                formData.append("signature", this.formValues.signature);
            }
            const fileURL = await this.previewInvoiceApi(formData);
            this.$nextTick(() => {
                const modalElement = document.getElementById("previewPdf");
                const modalInstance = new Modal(modalElement);
                modalInstance.show();
                const iframe = this.$refs.childComp.getIframe();
                if (iframe) {
                    iframe.src = fileURL;
                } else {
                    console.error("pdfIframe is not defined");
                }
            });
        },

        ...mapActions("invoice", ["downloadInvoice", "continueInvoiceApi", "previewInvoiceApi", "decimalDigits"]),
    },
    computed: {
        ...mapState("invoice", ["formValues", "isDownloadingDisabled", "isDownloading", "isPreviewing", "isDisabledPreview"]),
        ...mapGetters("invoice", ["subTotal", "grandTotal"]),
    },
};
</script>

<style lang="scss">
@import "@/custom.scss";
</style>
