<template>
    <Layout>
        <div class="container mt-5">
            <div
                v-if="$page.props.orders && $page.props.orders.data.length > 0"
            >
                <h3 class="mb-4">Your Orders</h3>
                <div class="list-group">
                    <InertiaLink
                        v-for="order in $page.props.orders.data"
                        :key="order.id"
                        :href="`/account/orders/view/${order.id}`"
                        class="list-group-item list-group-item-action"
                    >
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Order #{{ order.id }}</h5>
                            <small class="text-muted">
                                {{
                                    new Date(
                                        order.created_at
                                    ).toLocaleDateString()
                                }}
                            </small>
                        </div>
                        <p class="mb-1">Total: ${{ order.total_amount }}</p>
                        <small class="text-muted">
                            Status:
                            <i
                                class="fa"
                                :class="{
                                    'fa-hourglass-start text-warning':
                                        order.status === 'pending',
                                    'fa-spinner text-primary':
                                        order.status === 'inprogress',
                                    'fa-check-circle text-success':
                                        order.status === 'delivered',
                                    'fa-times-circle text-danger':
                                        order.status === 'rejected',
                                    'fa-ban text-muted':
                                        order.status === 'cancelled',
                                }"
                                aria-hidden="true"
                            ></i>
                            {{ order.status }}
                        </small>
                    </InertiaLink>
                </div>
            </div>
            <div v-else>
                <div class="text-center mt-5">
                    <h3 class="text-muted">No orders yet!</h3>
                    <p class="text-secondary">
                        Looks like you haven't placed any orders yet. Explore
                        our products and start shopping!
                    </p>
                    <InertiaLink href="/" class="btn btn-primary mt-3"
                        >Shop Now</InertiaLink
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
