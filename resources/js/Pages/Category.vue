<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <ShopControl :category="category" />

                    <div class="col-12">
                        <div class="row justify-content-center row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 p-1 w-100 h-100">
                            <div class="col mb-1" v-for="product in products" :key="product.id">
                                <div class="product product-style-3 equal-elem ">
                                    <div class="product-thumnail">
                                        <Link :href="`${$page.props.url}product/${product.slug}`" :title="product.name">
                                            <figure><img :src="`${product.image}`" :alt="product.name"></figure>
                                        </Link>
                                    </div>
                                    <div class="product-info">
                                        <Link :href="`${$page.props.url}product/${product.slug}`" class="product-name"><span>{{  product.name }}</span></Link>
                                        <div class="wrap-price">
                                        <ins>
                                            <span class="product-price" v-if="product.sale_price">{{ product.sale_price }}</span>
                                            <span class="product-price" v-else>{{ product.regular_price }}</span>
                                        </ins>
                                        <del v-if="product.sale_price">
                                            <span class="product-price regular-price">{{ product.regular_price }}</span>
                                        </del>
                                    </div>
                                    <button class="btn btn-light" @click.prevent="store(product.id, product.name,product.regular_price)">Add To Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wrap-pagination-info">
                        <ul class="page-numbers">
                            <li><span class="page-number-item current" >1</span></li>
                            <li><a class="page-number-item" href="#" >2</a></li>
                            <li><a class="page-number-item" href="#" >3</a></li>
                            <li><a class="page-number-item next-link" href="#" >Next</a></li>
                        </ul>
                        <p class="result-count">Showing 1-8 of 12 result</p>
                    </div>
                </div><!--end main products area-->
                <Sidebar />
            </div><!--end row-->
        </div><!-- end .container-fluid -->
    </Layout>
</template>
<script>
import Layout from '@/Components/Shared/Layout';
import Sidebar from '@/Components/Shared/Sidebar';
import ShopControl from '@/Components/Shared/ShopControl'
export default  {
    components: {
        Layout,
        Sidebar,
        ShopControl,
    },
    props: ['products', 'category'],
    data() {
        return {
            orderby: 'menu_order',
            postPerPage: 'menu_order',
            form: {
                id: '',
                name: '',
                price: '',

            },
            redirect: 'back',
        }
    },
    methods: {

        store(id, name, price) {
            this.form.id = id;
            this.form.name = name;
            this.form.price = price;
            this.$inertia.post(`${this.$page.props.url}shop/cart`, this.form);
        },
    },
   
}
</script>
