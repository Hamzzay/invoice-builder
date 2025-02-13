<template>
    <div class="modal fade" id="toModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">
                        Add Information
                    </h1>
                </div>
                <div class="modal-body">
                    <form action="#">
                        <AddressComponent :address=" formValues.toAddress " />
                        <div class="text-end">
                            <button type="button" class="btn btn-primary-orange w-25"
                                @click="saveAddress( 'to_address' )">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState } from 'vuex';
import AddressComponent from '../InvoiceComponents/preview/AddressComponent.vue';

export default {
    name: "ToAddressModal",
    components: {
        AddressComponent,
    },
    methods: {
        ...mapActions("invoice", ["saveAddress"]),
    }, computed: {
        ...mapState("invoice", ["formValues"]),
    }
}
</script>
