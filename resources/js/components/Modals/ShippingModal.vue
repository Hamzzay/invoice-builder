<template>
    <div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="shippingModalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">
                        Shipping
                    </h1>
                </div>
                <div class="modal-body">
                    <div class="mt-3">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="">Method Name:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="invoice_shipping_name" class="form-control-solid"
                                    placeholder="Enter name..." v-model=" formValues.shipping.methodName " />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="">Amount: </label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name="invoice_shipping_amount" class="form-control-solid"
                                    placeholder="" min="0" v-model=" formValues.shipping.amount " />
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-primary-orange w-25" @click="closeModals( 'shipping' )">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState } from 'vuex';

export default {
    name: "ShippingModal",
    methods: {
        ...mapActions("invoice", ["closeModals"]),
    }, computed: {
        ...mapState("invoice", ["formValues"]),
    }
}
</script>
