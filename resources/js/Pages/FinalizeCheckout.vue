<template>
    <Layout>
        <div class="container">
            <h2>Finalize Your Payment</h2>
            <p><strong>Payment Method:</strong> {{ paymentMethod }}</p>
            <p><strong>Customer Info:</strong> {{ customerInfo.name }} ({{ customerInfo.email }})</p>
            <p><strong>Total Amount:</strong> ${{ cart.subtotal }}</p>

            <div v-if="paymentMethod === 'stripe'">
                <div id="card-element"></div>
                <div id="card-errors" role="alert" class="text-danger"></div>
                <button @click="processStripePayment" class="btn btn-primary mt-4">Pay with Stripe</button>
            </div>

            <div v-else-if="paymentMethod === 'paypal'">
                <button @click="processPayPalPayment" class="btn btn-success mt-4">Pay with PayPal</button>
            </div>

            <div v-else>
                <p>Please confirm your payment manually.</p>
                <button @click="confirmManualPayment" class="btn btn-secondary mt-4">Confirm Payment</button>
            </div>
        </div>
    </Layout>
</template>

<script>
import { loadStripe } from "@stripe/stripe-js";
import Layout from "@/Components/Shared/Layout";

export default {
    components: {
        Layout,
    },
    data() {
        return {
            stripe: null,
            elements: null,
            card: null,
            paymentMethod: this.$page.props.paymentMethod, // Passed from Checkout.vue
            customerInfo: this.$page.props.customerInfo, // Passed from Checkout.vue
            cart: this.$page.props.cart, // Passed from backend
        };
    },
    async mounted() {
        if (this.paymentMethod === "stripe") {
            this.stripe = await loadStripe("your-stripe-public-key"); // Replace with your public key
            this.elements = this.stripe.elements();
            this.card = this.elements.create("card");
            this.card.mount("#card-element");
        }
    },
    methods: {
        async processStripePayment() {
            const { paymentMethod, error } = await this.stripe.createPaymentMethod({
                type: "card",
                card: this.card,
            });

            if (error) {
                document.getElementById("card-errors").textContent = error.message;
            } else {
                this.$inertia.post("/confirm-payment", {
                    paymentMethodId: paymentMethod.id,
                    cart: this.cart,
                });
            }
        },
        processPayPalPayment() {
            // Redirect or handle PayPal payment here
            console.log("Processing PayPal Payment...");
        },
        confirmManualPayment() {
            this.$inertia.post("/confirm-manual-payment", { cart: this.cart });
        },
    },
};
</script>
