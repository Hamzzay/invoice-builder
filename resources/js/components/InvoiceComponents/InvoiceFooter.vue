<template>
    <div class="invoice-bottom">
        <div class="row">
            <div class="col-md-6">
                <div class="invoice-comments mb-4">
                    <div class="form-group">
                        <textarea name="invoice_comment" id=""
                            placeholder="Notes - any relevant information not already converted" class="form-control"
                            v-model=" formValues.comment "></textarea>
                    </div>
                </div>
                <div class="invoice-comments mb-4">
                    <div class="form-group">
                        <textarea name="" id="" placeholder="Payment Method" class="form-control"
                            v-model=" formValues.payment_method "></textarea>
                    </div>
                </div>
                <div class="invoice-logo">
                    <label for="invoiceSignatureInput" class="upload-label">Upload Signature</label>
                    <input type="file" name="signature" accept=".png, .jpg, .jpeg" @change="uploadSignature( $event )"
                        id="invoiceSignatureInput" class="d-none" />
                    <img :src=" signatureSrc " alt="invoice logo" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="invoice-totals">
                    <div class="invoice-sub-total">
                        <label for="">Subtotal:</label>
                        <span>{{ formattedSubTotal }}</span>
                    </div>
                    <div class="invoice-discount">
                        <div v-if=" !isShowDiscount " class="d-flex justify-content-between align-items-center w-100">
                            <label for="" @click=" showDiscount ">Discount</label>
                            <button type="button" class="btn custom-btn" @click="openTextAreaModal( 'discount' )">
                                +Add discount
                            </button>
                        </div>
                        <div class="card w-100 mb-3" v-if=" isShowDiscount ">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>Discount</label>
                                    <div>
                                        <button class="btn custom-btn" @click=" handleRemoveDiscount ">
                                            Remove
                                        </button>
                                        <button type="button" class="btn custom-btn" @click="
                                            openTextAreaModal( 'discount' )
                                            ">
                                            Edit
                                        </button>
                                    </div>
                                    <div>
                                        {{ formValues.discount.amount }}
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label for="">Discount Name:</label>
                                        </div>
                                        <div class="col-md-8">
                                            {{
                                                formValues.discount.discountName
                                            }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label for="">Discount Type:
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            {{
                                                formValues.discount.discountType
                                            }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label for="">Amount: </label>
                                        </div>
                                        <div class="col-md-8">
                                            {{ formValues.discount.amount }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-shipping">
                        <div v-if=" !isShowShipping " class="d-flex justify-content-between align-items-center">
                            <label for="">Shipping</label>
                            <!-- @click="showShipping" -->
                            <button type="button" class="btn custom-btn" @click="openTextAreaModal( 'shipping' )">
                                +Add Shipping
                            </button>
                        </div>
                        <div class="card w-100 mb-3" v-if=" isShowShipping ">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>Shipping</label>
                                    <div>
                                        <button type="button" class="btn custom-btn" @click=" handleRemoveShipping ">
                                            Remove
                                        </button>
                                        <button type="button" class="btn custom-btn" @click="
                                            openTextAreaModal( 'shipping' )
                                            ">
                                            Edit
                                        </button>
                                    </div>
                                    <div>
                                        {{ formValues.shipping.amount }}
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label for="">Method Name:</label>
                                        </div>
                                        <div class="col-md-8">
                                            {{ formValues.shipping.methodName }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label for="">Amount: </label>
                                        </div>
                                        <div class="col-md-8">
                                            {{ formValues.shipping.amount }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-tax">
                        <div v-if=" !isShowTax " class="d-flex justify-content-between align-items-center">
                            <label for="">Tax</label>
                            <!-- @click="showTax" -->
                            <button type="button" class="btn custom-btn" @click="openTextAreaModal( 'tax' )">
                                +Add Tax
                            </button>
                        </div>
                        <div class="card w-100 mb-3" v-if=" isShowTax ">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label>Tax</label>
                                    <div>
                                        <button type="button" class="btn custom-btn" @click=" handleRemoveTax ">
                                            Remove
                                        </button>
                                        <button type="button" class="btn custom-btn"
                                            @click="openTextAreaModal( 'tax' )">
                                            Edit
                                        </button>
                                    </div>
                                    <div>
                                        {{ formValues.tax.rate }}
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label for="">Tax Name: </label>
                                        </div>
                                        <div class="col-md-8">
                                            {{ formValues.tax.taxName }}
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label for="">Tax Rate: (%) </label>
                                        </div>
                                        <div class="col-md-8">
                                            {{ formValues.tax.rate }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="invoice-grand-total">
                        <label>Total:</label>
                        <span id="totalAmount">{{ formattedGrandTotal }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from "vuex";
import { mapGetters, mapState } from "vuex/dist/vuex.common.js";

export default {
    name: "InvoiceFooter",
    methods: {
        ...mapActions("invoice", [
            "handleRemoveDiscount",
            "handleRemoveShipping",
            "handleRemoveTax",
            "showDiscount",
            "showTax",
            "showTax",
            "openTextAreaModal",
            "uploadSignature",
            "decimalDigits"
        ]),
        formatNumber(value) {
            if (isNaN(value)) {
                return `${this.invoiceCurrency.symbol} 0.00`;
            }
            return `${this.invoiceCurrency.symbol} ${Number(value).toFixed(this.invoiceCurrency.decimal_digits)}`;
        }
    },
    computed: {
        ...mapGetters("invoice", [
            "grandTotal",
            "subTotal",
        ]),
        ...mapState("invoice", [
            "isShowDiscount",
            "isShowShipping",
            "isShowTax",
            "formValues",
            "signatureSrc",
            "invoiceCurrency"
        ]),
        // Format grandTotal
        formattedGrandTotal() {
            return this.formatNumber(this.grandTotal);
        },

        // Format subTotal
        formattedSubTotal() {
            return this.formatNumber(this.subTotal);
        }
    },

};
</script>
