<template>
    <Layout>
            <div class="container-fluid">

                <div class="row">
                    <Sidebar />
                    <Content>
                        <div class="card">
                            <div class="card-header">
                                Add Product
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="handleFormSubmit">
                                    <div class="form-group">
                                        <label for="date" class="form-label">Sale Date: </label>
                                        <input class="form-control" type="date-time" id="date" v-model="form.sale_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="stat" class="form-label">Status: </label>
                                        <select class="form-select" v-model="form.status" id="stat">
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
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
                status: null,
                sale_date: null,
            }
        }
    },
    methods: {

        handleFormSubmit() {
            // console.log(this.form.image);
            this.$inertia.post(`${this.$page.props.url}admin/on-sale`, this.form);
        },
    }

}
</script>
