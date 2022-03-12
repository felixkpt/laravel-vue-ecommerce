<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="main-content-area">
                        <div class="wrap-iten-in-cart">
                            <h3 class="box-title">Products Name</h3>
                            <div v-if="cart_data.count">

                            <ul class="products-cart">
                                <li class="pr-cart-item" v-for="item in cart_data.cart" :key='item.id'>
                                    <div class="product-image" v-if="item.model">
                                        <figure><img :src="`${$page.props.asset}uploads/${item.model.image}`" alt=""></figure>
                                    </div>
                                    <div class="product-name">
                                        <Link class="link-to-product" :href="`${$page.props.url}product/${item.model.slug}`">{{ item.name }}</Link>
                                    </div>
                                    <div class="price-field produtc-price"><p class="price">{{ item.price }}</p></div>
                                    <div class="quantity">
                                        <div class="quantity-input py-2">

                                            <input type="text" :id="`id_${item.rowId}`" :value="item.qty" data-max="120" pattern="[0-9]*">

                                            <div @click="decreaseQuantity(`id_${item.rowId}`)"
                                                        class="d-inline p-2 rounded-circle text-center m-0 mx-1 bg-light"
                                                        style="min-width: 30px!important;height: 30px;padding: 3px 3px">
                                                    <span class="fa fa-minus"></span>
                                                </div>
                                            <div @click="increaseQuantity(`id_${item.rowId}`)"
                                                    class="d-inline p-2 rounded-circle text-center m-0 mx-1 bg-light"
                                                    style="min-width: 30px!important;height: 30px;padding: 2px 8px">
                                                <span class="fa fa-plus"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-field sub-total"><p class="price">{{ item.subtotal }}</p></div>
                                    <div class="">
                                        <button class="btn btn-close" style="width: 30px; height: 30px" @click="remove(`id_${item.rowId}`)">
                                        </button>
                                    </div>
                                </li>

                            </ul>
                            
                            </div>
                            <div v-else>
                                <div class="alert alert-info">
                                    You have no items in your cart.
                                </div>
                            </div>
                        </div>

                        <div class="summary" v-if="cart_data.count">
                            <div class="order-summary">
                                <h4 class="title-box">Order Summary</h4>
                                <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{ $page.props.subtotal }}</b></p>
                                <p class="summary-info"><span class="title">Tax</span><b class="index">${{ $page.props.tax }}</b></p>
                                <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
                                <p class="summary-info total-info "><span class="title">Total</span><b class="index">${{ $page.props.total }}</b></p>
                            </div>
                            <div class="checkout-info">
                                <label class="checkbox-field">
                                    <input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
                                </label>
                                <a class="btn btn-checkout" :href="`${$page.props.url}checkout`">Check out</a>
                                <a class="link-to-shop" :href="`${$page.props.url}shop`">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                            </div>
                            <div class="update-clear">
                                <button class="btn btn-clear" @click="destroy">Clear Shopping Cart</button>
                                <button class="btn btn-update" @click="update">Update Shopping Cart</button>
                            </div>
                        </div>

                        <div class="wrap-show-advance-info-box style-1 box-in-site">
                            <h3 class="title-box">Most Viewed Products</h3>
                            <div class="wrap-products">
                                <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

                                    <div class="product product-style-2 equal-elem" v-for="product in $page.props.most_viewed" :key="product.id">
                                        <div class="product-thumnail">
                                            <a :href="`${$page.props.url}product/${product.slug}`" :title="product.name">
                                                <figure><img :src="`${$page.props.asset}uploads/${product.image}`" width="214" height="214" :alt="product.name"></figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item new-label">new</span>
                                            </div>
                                            <div class="wrap-btn">
                                                <a href="#" class="function-link">quick view</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <a :href="`${$page.props.url}product/${product.slug}`" class="product-name"><span>{{ product.name }}</span></a>
                                            <div class="wrap-price">
                                                <ins>
                                                    <span class="product-price" v-if="product.sale_price">{{ product.sale_price }}</span>
                                                    <span class="product-price" v-else>{{ product.regular_price }}</span>
                                                </ins>
                                                <del v-if="product.sale_price">
                                                    <span class="product-price regular-price">{{ product.regular_price }}</span>
                                                </del>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!--End wrap-products-->
                        </div>
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
export default  {
    components: {
       Layout,
       Sidebar,
    },
    data() {
        return {
        qty: 999,
        cart_data: this.$page.props.cart_data,
        }
    },
    methods: {
        increaseQuantity(rowId) {
            this.action(rowId, 'increase');

        },
        decreaseQuantity(rowId) {
            this.action(rowId, 'decrease');
        },
        remove(rowId) {
            this.action(rowId, 'remove')
        },
        destroy() {
            if (confirm('Are you sure you want to empty your cart?')) {
                this.$inertia.post(`${this.$page.props.url}cart/destroy`);
            }
        },
        update() {
            this.$inertia.reload();
        },
        action(rowId, behavior) {
            axios.post(`${this.$page.props.url}cart/${behavior}`, {rowId: rowId}).then(
                (response) => {
                    return response.data
                }
            ).then(
                (json) => {
                    this.cart_data = json.cart_data ?? null;
                    this.navCartCount()
                }
            )
                .catch(
                    (err) => {
                        console.log(err);
                    }
                )
        },
    },
    mounted() {
    
    }

}
</script>
