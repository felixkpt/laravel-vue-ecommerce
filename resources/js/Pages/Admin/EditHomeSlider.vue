<template>
    <Layout>
            <div class="container-fluid">

                <div class="row">
                    <Sidebar />
                    <Content>
                        <div class="card">
                            <div class="card-header">
                                Edit a Home Slider
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
            form: {
                id: this.$page.props.home_slider.id,
                title: this.$page.props.home_slider.title,
                subtitle: this.$page.props.home_slider.subtitle,
                price: this.$page.props.home_slider.price,
                link: this.$page.props.home_slider.link,
                image: this.$page.props.home_slider.image,
                status: this.$page.props.home_slider.status,
            }
        }
    },
    methods: {

        handleFormSubmit() {

            this.$inertia.patch(`${this.$page.props.url}admin/home-sliders/edit`, this.form);

        }
    }

}
</script>
