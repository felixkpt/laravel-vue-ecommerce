<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="main-content-area">
                        <div
                            class="wrap-address-billing"
                            v-if="cart_data.count"
                        >
                            <h3 class="box-title">Billing Address</h3>
                            <form @submit.prevent="">
                                <p
                                    class="row-in-form"
                                    :class="{ 'has-errors': errors.fname }"
                                >
                                    <label for="fname"
                                        >First Name<span>*</span></label
                                    >
                                    <input
                                        id="fname"
                                        type="text"
                                        v-model="billing.fname"
                                        placeholder="Your name"
                                    />
                                    <span v-if="errors.fname" class="error-msg">
                                        {{ errors.fname }}
                                    </span>
                                </p>
                                <p
                                    class="row-in-form"
                                    :class="{ 'has-errors': errors.lname }"
                                >
                                    <label for="lname"
                                        >Last Name<span>*</span></label
                                    >
                                    <input
                                        id="lname"
                                        type="text"
                                        v-model="billing.lname"
                                        placeholder="Your last name"
                                    />
                                    <span v-if="errors.lname" class="error-msg">
                                        {{ errors.lname }}
                                    </span>
                                </p>
                                <p
                                    class="row-in-form"
                                    :class="{ 'has-errors': errors.email }"
                                >
                                    <label for="email">Email Address:</label>
                                    <input
                                        id="email"
                                        type="email"
                                        v-model="billing.email"
                                        placeholder="Type your email"
                                    />
                                    <span v-if="errors.email" class="error-msg">
                                        {{ errors.email }}
                                    </span>
                                </p>
                                <p
                                    class="row-in-form"
                                    :class="{ 'has-errors': errors.phone }"
                                >
                                    <label for="phone"
                                        >Phone Number<span>*</span></label
                                    >
                                    <input
                                        id="phone"
                                        type="text"
                                        v-model="billing.phone"
                                        placeholder="10 digits format"
                                    />
                                    <span v-if="errors.phone" class="error-msg">
                                        {{ errors.phone }}
                                    </span>
                                </p>
                                <p
                                    class="row-in-form"
                                    :class="{ 'has-errors': errors.address }"
                                >
                                    <label for="add">Address:</label>
                                    <input
                                        id="add"
                                        type="text"
                                        v-model="billing.address"
                                        placeholder="Street and apartment number"
                                    />
                                    <span
                                        v-if="errors.address"
                                        class="error-msg"
                                    >
                                        {{ errors.address }}
                                    </span>
                                </p>
                                <p
                                    class="row-in-form"
                                    :class="{ 'has-errors': errors.country }"
                                >
                                    <label for="country"
                                        >Country<span>*</span></label
                                    >
                                    <input
                                        id="country"
                                        type="text"
                                        v-model="billing.country"
                                        placeholder="United States"
                                    />
                                    <span
                                        v-if="errors.country"
                                        class="error-msg"
                                    >
                                        {{ errors.country }}
                                    </span>
                                </p>
                                <p
                                    class="row-in-form"
                                    :class="{ 'has-errors': errors.zip }"
                                >
                                    <label for="zip-code"
                                        >Postcode / ZIP:</label
                                    >
                                    <input
                                        id="zip-code"
                                        type="text"
                                        v-model="billing.zip"
                                        placeholder="Your postal code"
                                    />
                                    <span v-if="errors.zip" class="error-msg">
                                        {{ errors.zip }}
                                    </span>
                                </p>
                                <p
                                    class="row-in-form"
                                    :class="{ 'has-errors': errors.city }"
                                >
                                    <label for="city"
                                        >Town / City<span>*</span></label
                                    >
                                    <input
                                        id="city"
                                        type="text"
                                        v-model="billing.city"
                                        placeholder="City name"
                                    />
                                    <span v-if="errors.city" class="error-msg">
                                        {{ errors.city }}
                                    </span>
                                </p>

                                <div
                                    v-if="!formIsValid"
                                    class="summary-item text-center"
                                >
                                    <a
                                        href="#"
                                        class="btn w-50 mx-auto"
                                        @click.prevent="validateForm()"
                                    >
                                        Select Payment method
                                    </a>
                                </div>
                                <div v-else class="summary summary-checkout">
                                    <div class="summary-item shipping-method">
                                        <h4 class="title-box f-title">
                                            Shipping method
                                        </h4>
                                        <p class="summary-info">
                                            <span class="title">Flat Rate</span>
                                        </p>
                                        <p class="summary-info">
                                            <span class="title"
                                                >Fixed $50.00</span
                                            >
                                        </p>
                                    </div>
                                    <div class="summary-item payment-method">
                                        <h4 class="">Payment Method</h4>
                                        <div
                                            v-if="formIsValid"
                                            class="choose-payment-methods"
                                        >
                                            <div
                                                class="payment-methods d-flex"
                                                style="
                                                    flex-direction: column;
                                                    gap: 5px;
                                                "
                                            >
                                                <label>
                                                    <input
                                                        type="radio"
                                                        value="paystack"
                                                        v-model="
                                                            selectedPaymentMethod
                                                        "
                                                        :disabled="!formIsValid"
                                                    />
                                                    Pay with Paystack
                                                </label>
                                            </div>
                                            <p class="summary-info grand-total">
                                                <span>Grand Total</span>
                                                <span class="grand-total-price"
                                                    >${{
                                                        cart_data.subtotal
                                                    }}</span
                                                >
                                            </p>

                                            <!-- Paystack Payment Form (Conditionally Rendered) -->
                                            <div
                                                v-if="
                                                    selectedPaymentMethod ===
                                                    'paystack'
                                                "
                                            >
                                                <pay-with-paystack
                                                    @paymentDone="onPaymentDone"
                                                />
                                            </div>

                                            <!-- Placeholder for Other Payment Method -->
                                            <div
                                                v-else-if="
                                                    selectedPaymentMethod ===
                                                    'other'
                                                "
                                            >
                                                <p>
                                                    Select another payment
                                                    method.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-else>
                            <div class="alert alert-info">
                                You have no items in your cart.
                            </div>
                        </div>
                        <div class="row" v-if="cart_data.count == 0">
                            <MostViewedProducts />
                        </div>
                    </div>
                </div>
                <Sidebar />
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "@/Components/Shared/Layout";
import Sidebar from "@/Components/Shared/Sidebar";
import PayWithPaystack from "./PayWithPaystack.vue";
import MostViewedProducts from "../Components/MostViewedProducts.vue";

export default {
    components: {
        Layout,
        Sidebar,
        MostViewedProducts,
        PayWithPaystack,
    },
    data() {
        return {
            formIsValid: false,
            billing: {
                fname: "",
                lname: "",
                email: "",
                phone: "",
                address: "",
                country: "",
                zip: "",
                city: "",
            },
            errors: {},
            cart_data: this.$page.props.cart_data,
            selectedPaymentMethod: "paystack", // Tracks the selected payment method
            cart_data: this.$page.props.cart_data,
        };
    },
    methods: {
        onPaymentDone(reference) {
            console.log("Payment successful. Reference:", reference);
            const payload = {
                billing: this.billing,
                payment_method: this.selectedPaymentMethod,
                payment_reference: reference,
                cart: this.cart_data,
            };

            this.$inertia
                .post(`${this.$page.props.url}finalize-checkout`, payload)
                .then(() => {
                    console.log("Done!");
                })
                .catch((e) => {
                    console.log("There was an issue:", e);
                });
        },
        validateForm(checkOnly = false, newVal = null) {
            // Clear previous errors
            this.errors = {};
            const errors = {};

            // Validate fields
            const requiredFields = [
                "fname",
                "lname",
                "email",
                "phone",
                "address",
                "country",
                "zip",
                "city",
            ];
            requiredFields.forEach((field) => {
                const billing = newVal || this.billing;

                if (!billing[field]) {
                    errors[field] = `The ${field} field is required.`;
                }
            });

            if (!checkOnly) {
                this.errors = errors;
            }

            const res = Object.keys(errors).length === 0;

            this.formIsValid = res;

            return res;
        },
    },
    watch: {},
};
</script>

<style>
.has-errors input {
    border-color: red;
}
.error-msg {
    color: red;
    font-size: 12px;
}
</style>
