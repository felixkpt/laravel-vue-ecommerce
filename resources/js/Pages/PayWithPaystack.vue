<!-- resources/js/Pages/PayWithPaystack.vue -->
<template>
    <Layout>
        <div class="container-fluid">
            <!-- Checkout Form -->
            <form @submit.prevent="payWithPaystack">
                <div class="form-submit">
                    <button type="submit" class="btn btn-medium">
                        Pay with Paystack
                    </button>
                </div>
            </form>
        </div>
    </Layout>
</template>

<script>
export default {
    data() {
        return {
            billing: {
                email: "mughalbilal89@gmail.com", // Replace with user's email
            },
            cart_data: this.$page.props.cart_data,
        };
    },
    methods: {
        payWithPaystack() {
            const key = process.env.MIX_PAYSTACK_PUBLIC_KEY;
            console.log("key:", key);
            const handler = PaystackPop.setup({
                key: key,
                email: process.env.MIX_BILLING_EMAIL,
                currency: process.env.MIX_PAYSTACK_CURRENCY,
                amount:
                    parseInt(this.cart_data.subtotal.replace(/,/g, ""), 10) *
                    100, // Convert to kobo
                onClose: () => {
                    console.log("Payment window closed.");
                },
                callback: (response) => {
                    const reference = response.reference;
                    this.$emit("paymentDone", reference); // Emit reference to parent
                },
            });
            handler.openIframe();
        },
    },
};
</script>
