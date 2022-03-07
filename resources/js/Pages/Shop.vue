<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="wrap-shop-control">
                        <h1 class="shop-title">Digital & Electronics</h1>
                        <div class="wrap-right">
                            <div classs="sort-item orderby">
                                <select v-model="orderby" @change="orderbyUpdate($event)">
                                    <option value="menu_order">Default sorting</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </div>

                            <div class="sort-item product-per-page">
                                <select v-model="postPerPage" @change="postPerPageUpdate($event)">
                                    <option value="menu_order">Per Page</option>
                                    <option value="4">4 per page</option>
                                    <option value="12">12 per page</option>
                                    <option value="24">24 per page</option>
                                    <option value="36">36 per page</option>
                                    <option value="48">48 per page</option>
                                </select>
                            </div>

                            <div class="change-display-mode">
                                <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                                <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                            </div>

                        </div>

                    </div><!--end wrap shop control-->

                    <div class="col-12">
                        <div class="row justify-content-center row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 p-1 w-100 h-100">
                            <div class="col mb-1" v-for="product in products" :key="product.id">
                                <div class="product product-style-3 equal-elem ">
                                    <div class="product-thumnail">
                                        <Link :href="`${$page.props.url}product/${product.slug}`" :title="product.name">
                                            <figure><img :src="`${$page.props.asset}uploads/${product.image}`" :alt="product.name"></figure>
                                        </Link>
                                    </div>
                                    <div class="product-info">
                                        <Link :href="`${$page.props.url}product/${product.slug}`" class="product-name"><span>{{  product.name }}</span></Link>
                                        <div class="wrap-price"><span class="product-price">${{ product.regular_price }}</span></div>
                                        <button class="btn btn-light" @click.prevent="store(product.id, product.name,product.regular_price)">Add To Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <Sidebar />
            </div><!--end row-->
        </div><!-- end .container-fluid -->
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
    props: ['products'],
    data() {
        return {
            orderby: 'menu_order',
            postPerPage: 'menu_order',
            form: {
                id: '',
                name: '',
                price: '',

            }
        }
    },
    methods: {

        store(id, name, price) {
            this.form.id = id;
            this.form.name = name;
            this.form.price = price;
            this.$inertia.post(`${this.$page.props.url}shop/cart`, this.form);
        },
        orderbyUpdate(event) {
            let orderby = event.target.value;
            this.$inertia.post(`${this.$page.props.url}shop/orderby`, {orderby: orderby})
        },
        postPerPageUpdate(event) {
         let postPerPage = event.target.value;
            this.$inertia.post(`${this.$page.props.url}shop/post-per-page`, {postPerPage: postPerPage})
        },
    }

}
</script>
