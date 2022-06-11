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
                                    <option value="default">Default sorting</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </div>

                            <div class="sort-item product-per-page">
                                <select v-model="perPage" @change="perPageUpdate($event)">
                                    <option value="15">Per Page</option>
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
                            <div class="col pb-1" v-for="product in products.data" :key="product.id">
                                <div class="product product-style-2 m-1">
                                    <div class="product-wish text-end">
                                            <a href="#"><span class="fa fa-heart fs-4 custom-style-primary" aria-hidden="true"></span></a>
                                        </div>
                                    <div class="product-thumnail">
                                        <Link :href="`${$page.props.url}product/${product.slug}`" :title="product.name">
                                            <figure><img :src="`${product.image}`" :alt="product.name"></figure>
                                        </Link>
                                    </div>
                                    <div class="product-info">
                                        <Link :href="`${$page.props.url}product/${product.slug}`" class="product-name"><span>{{  product.name }}</span></Link>
                                        <div class="wrap-price"><span class="product-price">${{ product.regular_price }}</span></div>
                                        <button class="btn btn-outline-warning" @click.prevent="store(product.id, product.name,product.regular_price)">Add To Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <PaginationLinks :links="links" v-if="links.links" />
                    </div>
                </div>
                <Sidebar />
            </div><!--end row-->
        </div><!-- end .container-fluid -->
    </Layout>
</template>
<script>
import axios from 'axios';
import Layout from '@/Components/Shared/Layout';
import Sidebar from '@/Components/Shared/Sidebar';
import PaginationLinks from '@/Components/Shared/PaginationLinks';
export default  {
    components: {
       Layout,
       Sidebar,
       PaginationLinks,
    },
    props: {
        products: {
            type: Object,
            default: {},
        }, 
        orderby: {
            type: String,
            default: 'default'
        },
        perPage: {
            type: Number,
            default: 15
        },
        },
    data() {
        return {
            form: {
                id: '',
                name: '',
                price: '',

            },
        }
    },
    methods: {

        store(id, name, price) {
            this.form.id = id;
            this.form.name = name;
            this.form.price = price;
            this.$inertia.post(`${this.$page.props.url}shop/cart`, this.form);
        },
        async orderbyUpdate(event, get = false) {
            let orderby = event ? event.target.value : null;
            await axios.post(`${this.$page.props.url}shop/orderby`, {orderby: orderby, get: get})
                .then((resp) => {
                        this.$inertia.reload()
                }).catch(() => {
                    alert('Whoops! But there was an error.');
                });
        },
        async perPageUpdate(event, get = false) {
            let perPage =  event ? event.target.value : null;
            await axios.post(`${this.$page.props.url}shop/per-page`, {perPage: perPage, get: get})
                .then((resp) => {
                        this.$inertia.visit('shop');
                }).catch((err) => {
                    console.log(err)
                    alert('Whoops! But there was an error.');
                });
        },
    },
    computed: {
        links() {
            return {...this.products, data:{}}
        }
    },
    
}
</script>
<style scoped>
.product-wish{
    /* position: absolute;
    top: 10%;
    left: 0; */
    z-index:599;
    /* right: 30px;
    text-align: right;
    padding-top: 0; */
}
.custom-style-primary {
color: #cbcbcb;
}

.custom-style-primary:hover {
    color: #ff7007;
}
</style>