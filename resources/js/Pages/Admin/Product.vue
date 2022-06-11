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
                                        <h4>All Products</h4>
                                    </div>
                                    <div class="col-6 text-end">
                                        <Link :href="`${$page.props.url}admin/products/add`" class="btn btn-success btn-sm">Add New</Link>
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
                                    <tr v-for="(product, index) in $page.props.products.data" :key="product.id">
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
                                                    <li>
                                                        <Link class="dropdown-item" :href="`${$page.props.url}admin/products/edit/${product.slug}`">
                                                            <span class="fa fa-edit text-info"></span> Edit
                                                        </Link>
                                                    </li>
                                                    <li>
                                                        <Link class="dropdown-item" @click.prevent="deleteItem(product.id)">
                                                            <span class="fa fa-trash text-danger"></span> Delete
                                                        </Link>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <PaginationLinks :links="links" />

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
import PaginationLinks from '@/Components/Shared/PaginationLinks';
export default  {
    components: {
        Layout,
        Sidebar,
        Content,
        PaginationLinks,
    },
    data() {
        return {
          links: this.$page.props.products,
            }
    },
    methods: {

        deleteItem(id) {
            if (confirm('Are you sure you want to delete this product?')){
                this.$inertia.delete(`/admin/products/delete/${id}`);
            }
        }

    },
    mounted() {
        // console.log(this.$page.props.products)
    }

}
</script>
