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
                                            ${{ order.total_amount.toFixed(2) }}
                                        </td>
                                        <td>{{ order.status }}</td>
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
            <!--end row-->
        </div>
        <!--end container-->

        <!-- end .container-fluid -->
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
    methods: {},
    mounted() {
        // console.log(this.$page.props.orders)
    },
};
</script>
