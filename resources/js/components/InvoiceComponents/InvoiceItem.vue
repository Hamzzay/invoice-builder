<template>
    <div class="invoice-items table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="item-column">Item</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(invoiceItem, index) in formValues.invoiceItems"
                    :key="index"
                >
                    <th scope="row" class="item-column">
                        <div class="d-flex flex-column gap-2">
                            <input
                                type="text"
                                name="item_name"
                                class="form-control mt-2"
                                placeholder="Service name"
                                v-model="invoiceItem.itemName"
                            />
                            <input
                                type="text"
                                name="item_description"
                                class="form-control"
                                placeholder="Item description"
                                v-model="invoiceItem.itemDescription"
                            />
                        </div>
                    </th>
                    <td>
                        <input
                            type="number"
                            name="item_quantity"
                            class="form-control mt-2"
                            placeholder="Quantity"
                            v-model="invoiceItem.itemQuantity"
                        />
                    </td>
                    <td>
                        <input
                            type="number"
                            name="item_price"
                            class="form-control mt-2"
                            placeholder="Price"
                            v-model="invoiceItem.itemPricePer"
                            step="0.01"
                        />
                    </td>
                    <td>
                        <div class="d-flex gap-1 align-items-center">
                            <input
                                type="text"
                                name="item_total"
                                class="form-control mt-2"
                                placeholder="Total"
                                :value="
                                    invoiceItem.itemPricePer *
                                    invoiceItem.itemQuantity
                                "
                                readonly
                            />
                            <div
                                class="text-end trash-icon pt-2"
                                v-if="index !== 0"
                            >
                                <i
                                    class="fa-solid fa-trash text-danger"
                                    @click="deleteItem(index)"
                                ></i>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="invoice-item-add mt-2">
            <button
                type="button"
                class="btn btn-outline-primary w-100"
                @click="addNewItem"
            >
                + Add Invoice Item
            </button>
        </div>
    </div>
</template>
<script>
import { mapState, mapActions } from "vuex";

export default {
    name: "InvoiceItem",
    methods: {
        ...mapActions("invoice", ["addNewItem", "deleteItem"]),
    },
    computed: {
        ...mapState("invoice", ["formValues"]),
    },
};
</script>
