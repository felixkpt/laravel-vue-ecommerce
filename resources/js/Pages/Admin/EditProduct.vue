<template>
    <Layout>
            <div class="container-fluid">

                <div class="row">
                    <Sidebar />
                    <Content>
                        <div class="card">
                            <div class="card-header">
                                Add a Product
                            </div>
                            <div class="card-body">
                                <form @submit.prevent="handleFormSubmit">
                                    <div class="form-group">
                                        <label for="item" class="form-label">Product</label>
                                        <input class="form-control" type="text" id="item" v-model="form.name">
                                    </div>
                                    <div class="form-group">
                                        <label for="itemSlug" class="form-label">Product Slug</label>
                                        <input class="form-control" type="text" id="itemSlug" v-model="form.slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="shortD" class="form-label">Short Description</label>
                                        <textarea class="form-control" id="shortD" v-model="form.short_description">
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" v-model="form.description">
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="regularP" class="form-label">Regular Price</label>
                                        <input class="form-control" type="text" id="regularP" v-model="form.regular_price">
                                    </div>
                                    <div class="form-group">
                                        <label for="saleP" class="form-label">Sale Price</label>
                                        <input class="form-control" type="text" id="saleP" v-model="form.sale_price">
                                    </div>
                                    <div class="form-group">
                                        <label for="SKU" class="form-label">SKU</label>
                                        <input class="form-control" type="text" id="SKU" v-model="form.SKU">
                                    </div>
                                    <div class="form-group">
                                        <label for="inStock" class="form-label">In Stock</label>
                                        <select class="form-select" id="inStock" v-model="form.stock_status">
                                            <option value="0">--Select--</option>
                                            <option value="instock">Yes</option>
                                            <option value="outstock">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input class="form-control" type="number" id="quantity" v-model="form.quantity">
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="form-label">Product Image</label>
                                        <input class="form-control" @change="previewImage" ref="photo" type="file" id="image">
                                        <img v-if="form.image_url" :src="form.image_url" class="image-responsive" style="height: 200px; width: 200px">
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-select" id="category_id" v-model="form.category_id">
                                            <option value="0">--Select--</option>
                                            <option v-for="item in $page.props.categories" :value="item.id" :selected="item.id == category_id" :key="item.id">{{ item.name }}</option>
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
                id: this.$page.props.product.id,
                name: this.$page.props.product.name,
                slug: this.$page.props.product.slug,
                short_description: this.$page.props.product.short_description,
                description: this.$page.props.product.description,
                regular_price: this.$page.props.product.regular_price,
                sale_price: this.$page.props.product.sale_price,
                SKU: this.$page.props.product.SKU,
                stock_status: this.$page.props.product.stock_status,
                quantity: this.$page.props.product.quantity,
                image: null,
                image_url: this.$page.props.asset + 'uploads/' + this.$page.props.product.image,
                category_id: this.$page.props.product.category_id,
            }
        }
    },
    methods: {

        handleFormSubmit() {
            // console.log(this.form.image);
            this.$inertia.post(`${this.$page.props.url}admin/products/edit`, this.form);
        },
        previewImage(e) {
            let file = e.target.files[0];
            this.form.image_url = URL.createObjectURL(file);
            this.form.image = this.$refs.photo.files[0];
        }
    },
    mounted() {
        // this.$refs.photo.files[0] = URL.read(this.form.image_url);
    }

}
</script>
