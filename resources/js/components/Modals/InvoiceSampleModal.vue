<template>
    <div class="modal fade" id="previewSampleModal" tabindex="-1" aria-labelledby="previewSampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="">
                        <div class="invoice-samples w-100">
                            <div class="row">
                                <div class="col-md-4" v-for="(
                                                                                 invoiceSample,index
                                        ) in invoiceSamples" :key=" index ">
                                    <div class="select-sample-parent">
                                        <i v-if="
                                            formValues.invoiceSampleValue ==
                                            invoiceSample.id
                                        " class="fa-solid fa-circle-check fs-2 select-sample-child"></i>
                                        <img :src=" invoiceSample.preview " :alt=" invoiceSample.name "
                                            class="img-fluid h-100" @click="handleSampleChecked( invoiceSample.id,invoiceSample.path )
                                                " />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button type="button" @click=" continueInvoice " class="btn btn-primary-orange w-100"
                                    :disabled=" isContinueDisabled ">
                                    <span v-if=" isContinue " class="spinner-border spinner-border-sm"
                                        aria-hidden="true"></span>
                                    <span role="status">Continue</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState } from 'vuex';

export default {
    name: "InvoiceSampleModal",
    props: {
        continueInvoice: {
            type: Function,
        },
    },
    methods: {
        ...mapActions("invoice", ["handleSampleChecked"]),
    },
    computed: {
        ...mapState("invoice", ["isContinue", "isContinueDisabled", "formValues", "invoiceSamples"]),
    },
}

</script>
