<template>
    <Layout>
            <div class="container-fluid">

                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            Add Home Slider
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="handleFormSubmit">
                                <div class="form-group">
                                    <label for="item" class="form-label">Choose categories: </label>
                                    <select name="categories[]" id="item" v-model="form.categories" multiple="multiple">
                                        <option v-for="category in $page.props.categories" :value="category.id">{{ category.name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="noP">No of Products</label>
                                    <input type="number" id="noP" class="form-control" v-model="form.no_of_products">
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
                categories: this.$page.props.sel_categories,
                no_of_products: this.$page.props.no_of_products,
            }
        }
    },
    methods: {

        handleFormSubmit() {

            this.$inertia.post(`${this.$page.props.url}admin/home-categories`, this.form);

        }
    }

}
</script>
