<template>
    <Layout>
            <div class="container-fluid">

                <div class="wrap-breadcrumb">
                    <ul>
                        <li class="item-link"><a href="#" class="link">home</a></li>
                        <li class="item-link"><span>Digital & Electronics</span></li>
                    </ul>
                </div>
                <Notification />
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            Add Category
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="handleFormSubmit">
                                <div class="form-group">
                                    <label for="item">Category: </label>
                                    <input class="form-control" type="text" id="item" v-model="form.name">
                                </div>
                                <div class="form-group">
                                    <label for="itemSlug">Category Slug (optional): </label>
                                    <input class="form-control" type="text" id="itemSlug" v-model="form.slug">
                                </div>
                                <button type="submit" class="mt-3 btn btn-primary">Submit</button>
                            </form>

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
            form: {
                name: null,
                slug: null
            }
        }
    },
    methods: {

        handleFormSubmit() {

            this.$inertia.post(`${this.$page.props.url}admin/categories/add`, this.form);

        }
    }

}
</script>
