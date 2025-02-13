<template>
    <div class="invoice-header">
        <div class="row w-100">
            <div class="col-md-6">
                <div class="invoice-header-left">
                    <div class="invoice-logo">
                        <label for="invoiceLogoInput" class="upload-label">Upload Logo</label>
                        <input type="file" name="logo" accept=".png, .jpg, .jpeg" @change="uploadLogo( $event )"
                            id="invoiceLogoInput" />
                        <img :src=" logoSrc " alt="invoice logo" />
                    </div>
                    <div class="business-info">
                        <div class="form-group mb-2">
                            <textarea type="textarea" v-model=" formValues.from " id="" class="form-control" name="form"
                                placeholder="From" @click="openTextAreaModal( 'from' )" readonly rows="5">
                            </textarea>
                        </div>
                        <div class="form-group mb-2">
                            <textarea v-model=" formValues.to " class="form-control" placeholder="To"
                                @click="openTextAreaModal( 'to' )" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="invoice-header-right">
                    <div class="fix-width">
                        <div class="invoice-type mb-2">
                            <select id="invoiceType" name="invoice_type" class="form-select"
                                v-model=" formValues.invoiceType ">
                                <option :value=" invoiceType.value " v-for="(
                                                      invoiceType,index
                                    ) in invoiceTypeOptions" :key=" index ">
                                    {{ invoiceType.text }}
                                </option>
                            </select>
                        </div>
                        <div class="invoice-number mb-2">
                            <div class="form-group">
                                <input type="text" name="invoice_number" id="" class="form-control"
                                    placeholder="Invoice Number" v-model=" formValues.invoiceNumber " />
                            </div>
                        </div>
                        <div class="invoice-term mb-2">
                            <select name="invoice_term" id="" class="form-select" v-model=" formValues.invoiceTerm ">
                                <option :value=" invoiceTerm.value " v-for="(   invoiceTerm,index) in invoiceTermOptions"
                                    :key=" index ">
                                    {{ invoiceTerm.text }}
                                </option>
                            </select>
                        </div>
                        <div class="invoice-date">
                            <div class="form-group mb-2">
                                <date-picker name="invoice_date" v-model=" formValues.date " valueType="format"
                                    format="MM/DD/YYYY" :default-value=" getDefaultDate() " input-class=" form-control"
                                    placeholder="Select Date" @change=" onDateChange "></date-picker>
                            </div>
                            <div class="form-group mb-2">
                                <date-picker name="invoice_due_date" v-model=" formValues.dueDate " valueType="format"
                                    format="MM/DD/YYYY" :default-value=" getDefaultDate() " input-class=" form-control"
                                    placeholder="Invoice Due Date" :disabled-date=" disableDueDate "></date-picker>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DatePicker from "vue2-datepicker";
import { mapActions, mapGetters, mapState } from "vuex";
export default {
    name: "Header",
    components: {
        DatePicker,
    },

    methods: {
        onDateChange() {
            this.formValues.dueDate = null; // Clear the due date when the invoice date changes
        },
        disableDueDate(date) {
            if (this.formValues.date) {
                // Disable dates before the selected invoice date
                return new Date(date) < new Date(this.formValues.date);
            }
            return false;
        },
        ...mapActions("invoice", [
            "openTextAreaModal",
            "uploadLogo",
            "getDefaultDate",
        ]),
    },
    computed: {
        ...mapState("invoice", [
            "formValues",
            "invoiceTypeOptions",
            "invoiceTermOptions",
            "logoSrc",
        ]),
        ...mapGetters("invoice", ["subTotal", "grandTotal"]),
    },
};
</script>
