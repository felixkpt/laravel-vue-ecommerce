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
                                        <h4>All Home Sliders</h4>
                                    </div>
                                    <div class="col-6 text-end">
                                        <Link :href="`${$page.props.url}admin/home-sliders/add`" class="btn btn-success btn-sm">Add/Edit</Link>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Img</th>
                                        <th>Name</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th>Sale Price</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(product, index) in $page.props.products" :key="product.id">
                                            <td>{{ (index + 1) }}</td>
                                            <td><img :src="`${product.image}`" style="height:40px; width: 40px" alt=""></td>
                                            <td>{{ product.name }}</td><td>{{ product.stock_status }}</td>
                                            <td>{{ product.regular_price }}</td>
                                            <td>{{ product.sale_price }}</td>
                                            <td>
                                            <ul class="listunstyled">
                                                <li v-for="category in product.category" :key="category.id">
                                                    {{ category.name }}
                                                </li>
                                            </ul>
                                        </td>
                                            <td>{{ product.created_at }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDropActions" type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDropActions">
                                                        <li>
                                                            <Link class="dropdown-item" :href="`${$page.props.url}product/${product.slug}`">
                                                                <span class="fa fa-eye text-dark"></span> View
                                                            </Link>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </Content>
                </div><!--end row-->

            </div><!--end container-->

            <!-- end .container-fluid -->
    </Layout>
</template>


<script>
import Layout from '@/Components/Admin/Shared/Layout';
import Sidebar from '@/Components/Admin/Shared/Sidebar';
import Content from '@/Components/Admin/Shared/Content';
export default  {
    components: {
       Layout,
       Sidebar,
       Content,
    },
    data() {
        return {

        }
    },
    methods: {

        deleteItem(id) {
            if (confirm('Are you sure you want to delete this home slider?')){
                this.$inertia.delete(`/admin/home-sliders/delete/${id}`);
            }
        }

    },
    mounted() {
        // console.log(this.$page.props.products)
    }

}
</script>
