<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="wrap-product-detail">
                        <div class="detail-media">
                            <div class="product-gallery">
                                <ul class="slides">

                                    <li :data-thumb="`${product.image}`">
                                        <div class="mx-auto" style="max-width:300px;max-height:300px">
                                            <img class="mx-auto" style="max-width:300px;max-height:300px" :src="`${product.image}`" :alt="product.name" />
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="detail-info">
                            <div class="product-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <a href="#" class="count-review"> (5 review)</a>
                            </div>
                            <h2 class="product-name">{{ product.name }}</h2>
                            <div class="wrap-social">
                                <a class="link-socail" href="#"><img :src="`${$page.props.url}/public/assets/images/social-list.png`" alt=""></a>
                            </div>

                            <div class="wrap-price">
                                <ins>
                                    <span class="product-price" v-if="product.sale_price">{{ product.sale_price }}</span>
                                    <span class="product-price" v-else>{{ product.regular_price }}</span>
                                </ins>
                                <del v-if="product.sale_price">
                                    <span class="product-price regular-price">{{ product.regular_price }}</span>
                                </del>
                            </div>
                            <div class="stock-info in-stock">
                                <p class="availability">Availability: <b>{{ product.stock_status }}</b></p>
                            </div>
                            <div class="quantity">
                                <span>Quantity:</span>
                                <div class="quantity-input">
                                    <input type="text" v-model="form.qty" data-max="120" pattern="[0-9]*" >

                                    <a class="btn btn-reduce" href="#" @click.prevent="decreaseQuantity"></a>
                                    <a class="btn btn-increase" href="#" @click.prevent="increaseQuantity"></a>
                                </div>
                            </div>
                            <div class="wrap-butons">
                                <button class="btn add-to-cart" @click.prevent="store(product.id, product.name,product.regular_price, form.qty)">Add to Cart</button>
                                <div class="wrap-btn">
                                    <a href="#" class="btn btn-compare">Add Compare</a>
                                    <a href="#" class="btn btn-wishlist">Add Wishlist</a>
                                </div>
                            </div>
                        </div>
                        <div class="description">
                            <h3>Product Description</h3>
                            <p v-html="product.description"></p>
                        </div>
                    </div>
                </div><!--end main product area-->
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
    props: ['product'],
    data() {
        return {
            form: {
                id: '',
                name: '',
                price: '',
                qty: this.$page.props.cart_data.qty ?? 1,

            }
        }
    },
    methods: {
        store(id, name, price, qty) {
            this.form.id = id;
            this.form.name = name;
            this.form.price = price;
            this.form.quantity = qty;
            this.$inertia.post(`${this.$page.props.url}shop/cart`, this.form);
        },
        increaseQuantity() {
         this.form.qty ++;   
        },
        decreaseQuantity() {
            this.form.qty --;
            if (this.form.qty < 1){
                this.form.qty = 1;
            }
        },
    },
    mounted() {
        // console.log(this.$page.props.cart_data)
    }
}
</script>

