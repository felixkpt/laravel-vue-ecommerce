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
                                    <label for="item" class="form-label">Title: </label>
                                    <input class="form-control" type="text" id="item" v-model="form.title">
                                </div>
                                <div class="form-group">
                                    <label for="subitem" class="form-label">Subtitle: </label>
                                    <input class="form-control" type="text" id="subitem" v-model="form.subtitle">
                                </div>
                                <div class="form-group">
                                    <label for="price" class="form-label">Price: </label>
                                    <input class="form-control" type="number" id="price" v-model="form.price">
                                </div>
                                <div class="form-group">
                                    <label for="link" class="form-label">Link: </label>
                                    <input class="form-control" type="url" id="link" v-model="form.link">
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <label for="image" class="form-label">Image: </label>-->
<!--                                    <input class="form-control" type="file" id="image" v-model="form.image">-->
<!--                                </div>-->
                                <div class="form-group">
                                    <label for="status" class="form-label">Status: </label>
                                    <select class="form-select" id="status" v-model="form.status">
                                        <option value="0">Active</option>
                                        <option value="1">In active</option>
                                    </select>
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
                title: null,
                subtitle: null,
                price: null,
                link: null,
                image: null,
                status: null,
            }
        }
    },
    methods: {

        handleFormSubmit() {

            this.$inertia.post(`${this.$page.props.url}admin/home-sliders/add`, this.form);

        }
    }

}
</script>
