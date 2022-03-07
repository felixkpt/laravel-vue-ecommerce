<template>
    <Layout>
            <div class="container-fluid">

                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h4>All Home Sliders</h4>
                                </div>
                                <div class="col-6 text-end">
                                    <Link href="/admin/home-sliders/add" class="btn btn-success btn-sm">Add New</Link>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Img</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Price</th>
                                    <th>Link</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(home_slider, index) in $page.props.home_sliders">
                                    <td>{{ (index + 1) }}</td>
                                    <td><img :src="`/public/assets/images/home-sliders/${home_slider.image}`" sizes="30,30" alt=""></td>
                                    <td>{{ home_slider.title }}</td><td>{{ home_slider.subtitle }}</td>
                                    <td>{{ home_slider.price }}</td>
                                    <td>{{ home_slider.link }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDropActions" type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="btnGroupDropActions">
                                                <li>
                                                    <Link class="dropdown-item" :href="`${$page.props.url}home-sliders/`">
                                                        <span class="fa fa-eye text-dark"></span> View
                                                    </Link>
                                                </li>
                                                <li>
                                                    <Link class="dropdown-item" :href="`${$page.props.url}admin/home-sliders/edit/${home_slider.id}`">
                                                        <span class="fa fa-edit text-info"></span> Edit
                                                    </Link>
                                                </li>
                                                <li>
                                                    <Link class="dropdown-item" @click.prevent="deleteItem(home_slider.id)">
                                                        <span class="fa fa-trash text-danger"></span> Delete
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
                </div><!--end row-->

            </div><!--end container-->

            <!-- end .container-fluid -->
    </Layout>
</template>


<script>
import Layout from '@/Components/Shared/Layout';
import Sidebar from '@/Components/Shared/Sidebar';
export default  {
    components: {
       Layout,
       Sidebar,
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
        // console.log(this.$page.props.home_sliders)
    }

}
</script>
