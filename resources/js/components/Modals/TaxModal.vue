<template>
    <div class="modal fade" id="taxModal" tabindex="-1" aria-labelledby="taxModalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">
                        Tax
                    </h1>
                </div>
                <div class="modal-body">
                    <div class="mt-3">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="">Tax Name: </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="invoice_tax_name" class="form-control-solid"
                                    placeholder="Enter tax name..." v-model=" formValues.tax.taxName " />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="">Tax Rate: (%) </label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name="invoice_tax_rate" class="form-control-solid" placeholder=""
                                    min="0" v-model=" formValues.tax.rate " />
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-primary-orange w-25" @click="closeModals( 'tax' )">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from 'vuex';
import { mapState } from 'vuex/dist/vuex.common.js';

export default {
    name: "TaxModal",
    methods: {
        ...mapActions("invoice", ["closeModals"]),
    }, computed: {
        ...mapState("invoice", ["formValues"]),
    }
}
</script>
