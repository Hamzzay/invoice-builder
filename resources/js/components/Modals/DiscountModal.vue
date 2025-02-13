<template>
    <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">
                        Discount
                    </h1>
                </div>
                <div class="modal-body">
                    <div class="mt-3">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="">Discount Name:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="invoice_discount" class="form-control-solid"
                                    placeholder="Discount reason...." v-model=" formValues.discount.discountName
                                        " />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="">Discount Type: </label>
                            </div>
                            <div class="col-md-8">
                                <select name="invoice_type" id="" class="form-select-solid" v-model=" formValues.discount.discountType
                                    ">
                                    <option value="amount">Amount</option>
                                    <option value="percentage">
                                        Percentage
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="">Amount: </label>
                            </div>
                            <div class="col-md-8">
                                <input name="invoice_discount_amount" type="number" class="form-control-solid"
                                    placeholder="" min="0" v-model=" formValues.discount.amount " />
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-primary-orange w-25" @click="closeModals( 'discount' )">
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
    name: "DiscountModal",
    methods: {
        ...mapActions("invoice", ["closeModals"]),
    }, computed: {
        ...mapState("invoice", [
            "formValues",
        ]),
    }
}
</script>
