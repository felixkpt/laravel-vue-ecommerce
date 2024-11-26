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
                                        <h4>All Categories</h4>
                                    </div>
                                    <div class="col-6 text-end">
                                        <Link :href="`${$page.props.url}admin/categories/add`" class="btn btn-success btn-sm">Add New</Link>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th><th>Category Name</th><th>Slug</th><th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(category, index) in $page.props.categories" :key="index">
                                        <td>{{ (index + 1) }}</td><td>{{ category.name }}</td><td>{{ category.slug }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDropActions" type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="btnGroupDropActions">
                                                    <li>
                                                        <Link class="dropdown-item" :href="`${$page.props.url}categories/${category.slug}`">
                                                            <span class="fa fa-eye text-dark"></span> View
                                                        </Link>
                                                    </li>
                                                    <li>
                                                        <Link class="dropdown-item" :href="`${$page.props.url}admin/categories/edit/${category.slug}`">
                                                            <span class="fa fa-edit text-info"></span> Edit
                                                        </Link>
                                                    </li>
                                                    <li>
                                                        <Link class="dropdown-item" @click.prevent="deleteItem(category.id)">
                                                            <span class="fa fa-trash text-danger"></span> Delete
                                                        </Link>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div>Section: {{ test }}</div>
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
        test: 'hug'
        }
    },
    methods: {

        deleteItem(id) {
            if (confirm('Are you sure you want to delete this category?')){
                this.$inertia.delete(`/admin/categories/delete/${id}`);
            }
        }

    }

}
</script>
