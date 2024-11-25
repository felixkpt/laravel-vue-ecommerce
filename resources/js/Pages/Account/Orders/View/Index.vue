<template>
    <Layout>
        <div class="container my-5">
            <h3 class="mb-4">Order Details</h3>

            <div v-if="$page.props.order">
                <div class="card mb-4">
                    <div class="card-header">
                        Order #{{ $page.props.order.id }}
                    </div>
                    <div class="card-body">
                        <p>
                            <strong>Date:</strong>
                            {{
                                new Date(
                                    $page.props.order.created_at
                                ).toLocaleDateString()
                            }}
                        </p>
                        <p>
                            <strong>Total Amount:</strong> ${{
                                $page.props.order.total_amount
                            }}
                        </p>
                        <p>
                            <strong>Payment Method:</strong>
                            {{ $page.props.order.payment_method }}
                        </p>
                        <p>
                            <strong>Payment Ref:</strong>
                            {{ $page.props.order.payment_reference }}
                        </p>
                        <p>
                            <strong>Status:</strong>
                            {{ $page.props.order.status || 'Pending' }}
                        </p>
                    </div>
                </div>

                <h4 class="mb-3">Items</h4>
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
                        <tr
                            v-for="(item, index) in $page.props.items"
                            :key="index"
                        >
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.product.name }}</td>
                            <td>${{ item.price }}</td>
                            <td>{{ item.quantity }}</td>
                            <td>${{ item.price * item.quantity }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-else>
                <div class="text-center mt-5">
                    <h3 class="text-muted">Order not found!</h3>
                    <p class="text-secondary">
                        We couldn't find the order you're looking for.
                    </p>
                    <InertiaLink
                        href="/account/orders"
                        class="btn btn-primary mt-3"
                        >Back to Orders</InertiaLink
                    >
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "@/Components/Shared/Layout";

import { InertiaLink } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Layout,
        InertiaLink,
    },
};
</script>

<style scoped>
.text-secondary {
    font-size: 1.1rem;
}
</style>
