<!-- resources/js/Pages/CheckoutSuccess.vue -->
<template>
    <Layout>
        <div class="container my-5">
            <div class="text-center">
                <h2>Thank You for Your Order!</h2>
                <p class="lead">
                    Your order <strong>#{{ order.id }}</strong> has been placed successfully.
                </p>
            </div>

            <div class="order-details my-4">
                <h3>Order Details</h3>
                <p><strong>Order ID:</strong> {{ order.id }}</p>
                <p><strong>Name:</strong> {{ order.first_name }} {{ order.last_name }}</p>
                <p><strong>Email:</strong> {{ order.email }}</p>
                <p><strong>Phone:</strong> {{ order.phone }}</p>
                <p><strong>Address:</strong> {{ order.address }}, {{ order.city }}, {{ order.country }}, {{ order.zip }}</p>
                <p><strong>Payment Method:</strong> {{ order.payment_method }}</p>
                <p><strong>Total Amount:</strong> ${{ order.total_amount.toFixed(2) }}</p>
            </div>

            <div class="items-list my-4">
                <h3>Items in Your Order</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in items" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.name }}</td>
                            <td>${{ item.price.toFixed(2) }}</td>
                            <td>{{ item.quantity }}</td>
                            <td>${{ (item.price * item.quantity).toFixed(2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-5">
                <a href="/" class="btn btn-primary">Continue Shopping</a>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "@/Components/Shared/Layout";

export default {
    props: {
        order: {
            type: Object,
            required: true,
        },
        items: {
            type: Array,
            required: true,
        },
    },
    components: {
        Layout,
    },
};
</script>

<style>
.container {
    max-width: 800px;
}
.order-details, .items-list {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
