<template>
    <div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="" class="bold-label">Name</label>
                    <input
                        type="text"
                        class="form-control-solid"
                        placeholder="Enter Company or Customer Name"
                        v-model="address.name"
                    />
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="" class="bold-label">Email</label>
                <input
                    type="email"
                    class="form-control-solid"
                    placeholder="Enter Email Address"
                    v-model="address.email"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="" class="bold-label">Phone</label>
                    <input
                        type="text"
                        class="form-control-solid"
                        placeholder="Phone Number"
                        v-model="address.phone"
                    />
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="" class="bold-label">Address</label>
                <input
                    type="text"
                    class="form-control-solid"
                    placeholder="Enter Address"
                    v-model="address.address"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="" class="bold-label">Country</label>
                    <input
                        type="text"
                        class="form-control-solid"
                        placeholder="Country"
                        v-model="address.country"
                    />
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="" class="bold-label">City</label>
                <input
                    type="text"
                    class="form-control-solid"
                    placeholder="City"
                    v-model="address.city"
                />
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "AddressComponent",
    props: {
        address: {
            type: Object,
        },
    },
};
</script>
