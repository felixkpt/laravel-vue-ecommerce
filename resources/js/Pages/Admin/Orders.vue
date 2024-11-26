<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <Sidebar />
                <Content>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h4>All Orders</h4>
                                </div>
                                <div class="col-6 text-end">
                                    <Link
                                        :href="`${$page.props.url}admin/orders/export`"
                                        class="btn btn-success btn-sm me-2"
                                        >Export</Link
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(order, index) in $page.props
                                            .orders.data"
                                        :key="order.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>
                                            {{ order.first_name }}
                                            {{ order.last_name }}
                                        </td>
                                        <td>{{ order.email }}</td>
                                        <td>{{ order.phone }}</td>
                                        <td>
                                            ${{ order.total_amount }}
                                        </td>
                                        <td>
                                            <!-- Dropdown for order status -->
                                            <select
                                                class="form-select form-select-sm"
                                                v-model="order.status"
                                                @change="
                                                    updateOrderStatus(
                                                        order.id,
                                                        order.status
                                                    )
                                                "
                                            >
                                                <option value="pending">
                                                    Pending
                                                </option>
                                                <option value="inprogress">
                                                    In Progress
                                                </option>
                                                <option value="delivered">
                                                    Delivered
                                                </option>
                                                <option value="rejected">
                                                    Rejected
                                                </option>
                                                <option value="cancelled">
                                                    Cancelled
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <Link
                                                :href="`${$page.props.url}admin/orders/view/${order.id}`"
                                                class="btn btn-sm btn-primary"
                                            >
                                                View
                                            </Link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <PaginationLinks :links="links" />
                        </div>
                    </div>
                </Content>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "@/Components/Admin/Shared/Layout";
import Sidebar from "@/Components/Admin/Shared/Sidebar";
import Content from "@/Components/Admin/Shared/Content";
import PaginationLinks from "@/Components/Shared/PaginationLinks";
export default {
    components: {
        Layout,
        Sidebar,
        Content,
        PaginationLinks,
    },
    data() {
        return {
            links: this.$page.props.orders,
        };
    },
    methods: {
        // Method to update the order status
        updateOrderStatus(orderId, status) {
            // Make an API call here to update the order status on the server
            this.$inertia.post(`${this.$page.props.url}admin/orders/update-status/${orderId}`, {
                    status: status,
                });
        },
    },
    mounted() {
        // console.log(this.$page.props.orders)
    },
};
</script>
