import { Modal } from "bootstrap";
import axios from "axios";
import { axiosConfig } from "../../utils/Helper";
const state = {

    isShowDiscount: false,
    isShowShipping: false,
    isShowTax: false,

    isRemoveDiscount: false,
    isRemoveShipping: false,
    isRemoveTax: false,

    isDownloading: false,
    isContinue: false,
    isDownloadingDisabled: false,
    isContinueDisabled: false,


    isPreviewing: false,
    isDisabledPreview: false,

    formValues: {
        logo: null,
        signature: null,
        from: null,
        to: null,
        invoiceType: "",
        invoiceNumber: `${~~(Math.random() * 10e3)}`.padStart(4, 0),
        invoiceTerm: "",
        date: null,
        dueDate: null,
        invoiceItems: [
            {
                itemName: null,
                itemDescription: null,
                itemQuantity: 0,
                itemPricePer: 0.0,
                itemTotal: 0,
            },
        ],
        comment: null,
        payment_method: null,
        discount: {
            discountName: "",
            discountType: "amount",
            amount: 0,
        },
        shipping: {
            methodName: "",
            amount: 0,
        },
        tax: {
            taxName: "",
            rate: 0,
        },
        invoiceSampleValue: 1,
        invoiceTemplatePath: "pdf.invoice",
        fromAddress: {
            name: "",
            email: "",
            phone: "",
            address: "",
            country: "",
            city: "",
        },
        toAddress: {
            name: "",
            email: "",
            phone: "",
            address: "",
            country: "",
            city: "",
        },
    },
    invoiceData: null,
    invoiceTypeOptions: [
        { value: "", text: "Select Type" },
        { value: "Estimate", text: "Estimate" },
        { value: "Quote", text: "Quote" },
        { value: "Order", text: "Order" },
        { value: "Purchase Order", text: "Purchase Order" },
        { value: "Invoice", text: "Invoice" },
        { value: "Statement", text: "Statement" },
        { value: "Registration", text: "Registration" },
        { value: "Credit", text: "Credit" },
    ],
    invoiceTermOptions: [
        { value: "", text: "Term" },
        { value: "none", text: "None" },
        { value: "custom", text: "Custom" },
        { value: "tomorrow", text: "Next Day" },
        { value: "2", text: "2 Days" },
        { value: "3", text: "3 Days" },
        { value: "4", text: "4 Days" },
        { value: "5", text: "5 Days" },
        { value: "6", text: "6 Days" },
        { value: "7", text: "7 Days" },
        { value: "10", text: "10 Days" },
        { value: "14", text: "14 Days" },
        { value: "21", text: "21 Days" },
        { value: "30", text: "30 Days" },
        { value: "45", text: "45 Days" },
        { value: "60", text: "60 Days" },
        { value: "90", text: "90 Days" },
        { value: "120", text: "120 Days" },
        { value: "180", text: "180 Days" },
        { value: "365", text: "365 Days" },
    ],

    logoSrc: "/asset/images/logo.png",
    signatureSrc: "/asset/images/signature.png",
    invoiceSamples: [],
    invoiceCurrency: {
        symbol: "$",
        name: "US Dollar",
        symbol_native: "$",
        decimal_digits: 2,
        rounding: 0,
        code: "USD",
        name_plural: "US dollars",
    },
};

const mutations = {
    setInvoiceData(state, invoiceData) {
        state.invoiceData = invoiceData;
    },
    setIsShowDiscount(state) {
        state.isShowDiscount = true;
    },
    setIsShowShipping(state) {
        state.isShowShipping = true;
    },
    setIsShowTax(state) {
        state.isShowTax = true;
    },
    setRemoveDiscount(state) {
        state.formValues.discount.discountName = "";
        state.formValues.discount.discountType = "";
        state.formValues.discount.amount = 0;
        state.isRemoveDiscount = true;
        state.isShowDiscount = false;
    },
    setShowDiscount(state) {
        state.isShowDiscount = true;
    },
    setShowShipping(state) {
        state.isShowShipping = true;
    },
    setShowTax(state) {
        state.isShowTax = true;
    },
    setRemoveShipping(state) {
        state.formValues.shipping.methodName = null;
        state.formValues.shipping.amount = 0;

        state.isRemoveShipping = true;
        state.isShowShipping = false;
    },
    setRemoveTax(state) {
        state.formValues.tax.taxName = null;
        state.formValues.tax.rate = 0;

        state.isRemoveTax = true;
        state.isShowTax = false;
    },
    setInvoiceItem(state) {
        state.formValues.invoiceItems.push({
            itemName: "",
            itemDescription: "",
            itemQuantity: 0,
            itemPricePer: 0.0,
            itemTotal: 0.0,
        });
    },
    setDeleteItem(state, index) {
        state.formValues.invoiceItems.splice(index, 1);
    },
    setUploadLogo(state, file) {
        state.formValues.logo = file;
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                state.logoSrc = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    },
    setUploadSignature(state, file) {
        state.formValues.signature = file;
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                state.signatureSrc = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    },

    setFromAddress() {
        const { name, email, country, city, phone, address } = state.formValues.fromAddress;
        state.formValues.from = `${name}\n${email}\n${phone}\n${city}\n${country}\n${address}`;
    },
    setToAddress() {
        const { name, email, country, city, phone, address } = state.formValues.toAddress;
        state.formValues.to = `${name}\n${email}\n${phone}\n${city}\n${country}\n${address}`;
    },
    setInvoiceSamples(state, data) {
        state.invoiceSamples = data;
    },
    setStartLoadingSample(state) {
        state.isDownloading = true;
        state.isDownloadingDisabled = true;
    },
    setStoptLoadingSample(state) {
        state.isDownloading = false;
        state.isDownloadingDisabled = false;
    },
    setStartDownloadInvoice(state) {
        state.isContinue = true;
        state.isContinueDisabled = true;
    },
    setSopDownloadInvoice(state) {
        state.isContinue = false;
        state.isContinueDisabled = false;
    },
    setSampleChecked(state, data) {
        state.formValues.invoiceSampleValue = data?.sampleId;
        state.formValues.invoiceTemplatePath = data?.path;
    },
    setStartPreviewInvoice(state) {
        state.isPreviewing = true
        state.isDisabledPreview = true
    },
    setStopPreviewInvoice(state) {
        state.isPreviewing = false
        state.isDisabledPreview = false
    },
    setDecimalDigits(state, value) {
        if (isNaN(value)) {
            return state.invoiceCurrency.symbol + " 0.00";
        }
        return state.invoiceCurrency.symbol + " " + value.toFixed(state.invoiceCurrency.decimal_digits);
    }
};

const actions = {
    invoiceData({ commit }, invoiceData) {
        commit("setInvoiceData", invoiceData);
    },
    showDiscount() {
        commit("setShowDiscount");
    },
    showShipping() {
        commit("setShowShipping");
    },
    showTax() {
        commit("setShowTax");
    },
    closeModals({ commit }, type) {
        if (type == "from_address") {
            const modal = document.getElementById("formModal");
            const textAreaModal = Modal.getInstance(modal);
            if (textAreaModal) {
                textAreaModal.hide();
            }
        }
        if (type == "to_address") {
            const toModal = document.getElementById("toModal");
            const textAreaModal = Modal.getInstance(toModal);
            if (textAreaModal) {
                textAreaModal.hide();
            }
        }
        if (type == "shipping") {
            commit("setIsShowShipping");
            const shippingModal = document.getElementById("shippingModal");
            const textAreaModal = Modal.getInstance(shippingModal);
            if (textAreaModal) {
                textAreaModal.hide();
            }
        }
        if (type == "discount") {
            commit("setIsShowDiscount");
            const discountModal = document.getElementById("discountModal");
            const textAreaModal = Modal.getInstance(discountModal);
            if (textAreaModal) {
                textAreaModal.hide();
            }
        }
        if (type == "tax") {
            commit("setIsShowTax");
            const taxModal = document.getElementById("taxModal");
            const textAreaModal = Modal.getInstance(taxModal);
            if (textAreaModal) {
                textAreaModal.hide();
            }
        }
    },
    handleRemoveDiscount({ commit }) {
        commit("setRemoveDiscount");
    },
    handleRemoveShipping({ commit }) {
        commit("setRemoveShipping");
    },
    handleRemoveTax({ commit }) {
        commit("setRemoveTax");
    },
    addNewItem({ commit }) {
        commit("setInvoiceItem");
    },
    deleteItem({ commit }, index) {
        commit("setDeleteItem", index);
    },
    openTextAreaModal({ commit }, type) {
        if (type == "from") {
            const modal = document.getElementById("formModal");
            const textAreaModal = new Modal(modal);
            if (textAreaModal) {
                textAreaModal.show();
            }
        }
        if (type == "to") {
            const toModal = document.getElementById("toModal");
            const textAreaModal = new Modal(toModal);
            if (textAreaModal) {
                textAreaModal.show();
            }
        }
        if (type == "discount") {
            const discountModal = document.getElementById("discountModal");
            const modal = new Modal(discountModal);
            if (discountModal) {
                modal.show();
            }
        }
        if (type == "shipping") {
            const shippingModal = document.getElementById("shippingModal");
            const modal = new Modal(shippingModal);
            if (shippingModal) {
                modal.show();
            }
        }
        if (type == "tax") {
            const taxModal = document.getElementById("taxModal");
            const modal = new Modal(taxModal);
            if (taxModal) {
                modal.show();
            }
        }
    },

    uploadLogo({ commit }, event) {
        const file = event.target.files[0];
        commit("setUploadLogo", file);
    },
    uploadSignature({ commit }, event) {
        const file = event.target.files[0];
        commit("setUploadSignature", file);
    },
    hideShowPreviewModal({ commit }, type) {
        const sampleModalElement = document.getElementById("previewSampleModal");
        if (sampleModalElement) {
            const sampleModal = Modal.getInstance(sampleModalElement) || new Modal(sampleModalElement);
            type == "hide" ? sampleModal.hide() : sampleModal.show();
        } else {
            console.error("Modal element not found");
        }
    },
    saveAddress({ commit, dispatch }, type) {
        if (type == "from_address") {
            commit("setFromAddress");
            dispatch("closeModals", "from_address");
        }
        if (type == "to_address") {
            commit("setToAddress");
            dispatch("closeModals", "to_address");
        }
    },
    getDefaultDate() {
        const today = new Date();
        const month = String(today.getMonth() + 1).padStart(2, "0");
        const day = String(today.getDate()).padStart(2, "0");
        const year = today.getFullYear();
        return `${month}/${day}/${year}`;
    },

    downloadInvoice({ commit, dispatch }, event) {
        event.preventDefault();
        dispatch("startProgress", "loadInvoiceTemplate");
        axios.get("/invoice/templates", axiosConfig).then((response) => {
            dispatch("stopProgress", "loadInvoiceTemplate");
            const { data, status } = response.data;
            if (status == 200) {
                commit("setInvoiceSamples", data);
                dispatch("hideShowPreviewModal", "show");
            }
        }).catch((error) => {
            console.log(error);
            dispatch("stopProgress", "loadInvoiceTemplate");
        });
    },
    startProgress({ commit }, type) {
        if (type == "loadInvoiceTemplate") {
            commit("setStartLoadingSample");
        } if (type == "startContinueDownloadInvoice") {
            commit("setStartDownloadInvoice");
        }
        if (type == "startPreviewInvoice") {
            commit("setStartPreviewInvoice");
        }
    },
    stopProgress({ commit }, type) {
        if (type == "loadInvoiceTemplate") {
            commit("setStoptLoadingSample");
        } if (type == "stopContinueDownloadInvoice") {
            commit("setSopDownloadInvoice");
        }
        if (type == "stopPreviewInvoice") {
            commit("setStopPreviewInvoice");
        }
    },

    continueInvoiceApi({ comment, dispatch }, data) {
        dispatch("startProgress", "startContinueDownloadInvoice");
        axios.post("/invoice/generate", data.formData, {
            responseType: "blob",
            axiosConfig,
        }).then((response) => {
            dispatch("stopProgress", "stopContinueDownloadInvoice");
            const pdfData = {
                response: response,
                invoiceNumber: data?.invoiceNumber,
            }
            dispatch("convertAndDownloadPdf", pdfData);
            dispatch("hideShowPreviewModal", "hide");
        }).catch((error) => {
            dispatch("stopProgress", "stopContinueDownloadInvoice");
            console.log("🚀 ~ .then ~ error:", error);
        });
    },
    convertAndDownloadPdf({ commit }, data) {
        console.log("🚀 ~ convertAndDownloadPdf ~ data:", data);
        const url = window.URL.createObjectURL(new Blob([data.response.data]));
        const link = document.createElement("a");
        link.href = url;
        const invoiceName = data?.invoiceNumber != null ? `${data.invoiceNumber}.pdf` : "invoice.pdf";
        link.setAttribute("download", invoiceName);
        document.body.appendChild(link);
        link.click();
    },
    handleSampleChecked({ commit }, sampleId, path) {
        const data = {
            sampleId: sampleId,
            path: path,
        }
        commit("setSampleChecked", data);
    },
    async previewInvoiceApi({ commit, dispatch }, formData) {
        try {
            dispatch("startProgress", "startPreviewInvoice");
            const response = await axios.post("/invoice/preview", formData, {
                responseType: "blob",
                axiosConfig,
            });
            const fileURL = URL.createObjectURL(
                new Blob([response.data], { type: "application/pdf" })
            );
            return fileURL;
        } catch (error) {
            console.error("🚀 ~ .then ~ error:", error);
            throw error;
        } finally {
            dispatch("stopProgress", "stopPreviewInvoice");
        }
    },
    decimalDigits({ commit }, value) {
        const numValue = Number(value);
        commit("setDecimalDigits", numValue);
    },
};

const getters = {
    getInvoiceData(state) {
        return state.invoiceData;
    },
    subTotal(state) {
        return state.formValues.invoiceItems.reduce((accumulator, item) => {
            return accumulator + item.itemPricePer * item.itemQuantity;
        }, 0);
    },

    discountTotal(state, getters) {
        if (state.formValues.discount.discountType === 'percentage') {
            return getters.subTotal * (state.formValues.discount.amount / 100);
        } else {
            return state.formValues.discount.amount;
        }
    },

    shippingTotal(state) {
        return state.formValues.shipping.amount;
    },

    taxTotal(state, getters) {
        return (getters.subTotal - getters.discountTotal) * (state.formValues.tax.rate / 100);
    },

    grandTotal(state, getters) {
        const subtotalAfterDiscount = getters.subTotal - getters.discountTotal;
        return Number(subtotalAfterDiscount) + Number(getters.shippingTotal) + Number(getters.taxTotal);
    },

};

export default {
    namespaced: true, // Ensure namespaced is true
    state,
    mutations,
    actions,
    getters,
};
