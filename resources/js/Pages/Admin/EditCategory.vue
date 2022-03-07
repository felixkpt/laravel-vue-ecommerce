<template>
    <Layout>
            <div class="container-fluid">

                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            Edit a Category
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
                name: this.$page.props.category.name,
                slug: this.$page.props.category.slug,
                id: this.$page.props.category.id,
            }
        }
    },
    methods: {

        handleFormSubmit() {

            this.$inertia.patch(`${this.$page.props.url}admin/categories/edit`, this.form);

        }
    }

}
</script>
