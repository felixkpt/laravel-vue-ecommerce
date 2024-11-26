<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="row wrap-product-detail">
                        <div class="col-12 col-md-6 detail-media">
                            <div class="product-gallery">
                                <div
                                    class="mx-auto"
                                    style="max-width: 240px;"
                                >
                                    <img
                                        class="mx-auto product-img"
                                        style="width: 100%;"
                                        :src="`${product.image}`"
                                        :alt="product.name"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 detail-info">
                            <div class="product-rating mb-2" style="cursor: default;">
                                <span class="me-2">
                                    <i
                                        v-for="n in 5"
                                        :key="n"
                                        class="fa"
                                        :class="
                                            n <= product.rating
                                                ? 'fa-star'
                                                : 'fa-star-o'
                                        "
                                        aria-hidden="true"
                                    ></i>
                                </span>
                                <span class="count-review">
                                    ({{ product.review_counts }} reviews)
                                </span>
                            </div>
                            <h2 class="product-name">{{ product.name }}</h2>

                            <div class="wrap-price">
                                <ins>
                                    <span
                                        class="product-price"
                                        v-if="product.sale_price"
                                        >{{ product.sale_price }}</span
                                    >
                                    <span class="product-price" v-else>{{
                                        product.regular_price
                                    }}</span>
                                </ins>
                                <del v-if="product.sale_price">
                                    <span class="product-price regular-price">{{
                                        product.regular_price
                                    }}</span>
                                </del>
                            </div>
                            <div class="stock-info in-stock">
                                <p class="availability">
                                    Availability:
                                    <b>{{
                                        product.stock_status.replace(/_/g, " ")
                                    }}</b>
                                </p>
                            </div>
                            <div class="quantity">
                                <span>Quantity:</span>
                                <div class="quantity-input">
                                    <input
                                        type="text"
                                        :disabled="
                                            product.stock_status != 'in_stock'
                                        "
                                        v-model="form.qty"
                                        data-max="120"
                                        pattern="[0-9]*"
                                    />

                                    <a
                                        class="btn btn-reduce"
                                        href="#"
                                        @click.prevent="
                                            product.stock_status == 'in_stock'
                                                ? decreaseQuantity()
                                                : null
                                        "
                                    ></a>
                                    <a
                                        class="btn btn-increase"
                                        href="#"
                                        @click.prevent="
                                            product.stock_status == 'in_stock'
                                                ? increaseQuantity()
                                                : null
                                        "
                                    ></a>
                                </div>
                            </div>
                            <div class="wrap-butons">
                                <button
                                    class="btn add-to-cart"
                                    @click.prevent="
                                        product.stock_status == 'in_stock'
                                            ? store(
                                                  product.id,
                                                  product.name,
                                                  product.regular_price,
                                                  form.qty
                                              )
                                            : null
                                    "
                                >
                                    Add to Cart
                                </button>
                                <div class="wrap-btn">
                                    <a href="#" class="btn btn-compare"
                                        >Add Compare</a
                                    >
                                    <a href="#" class="btn btn-wishlist"
                                        >Add Wishlist</a
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-12 description">
                            <h3>Product Description</h3>
                            <p v-html="formattedDescription"></p>
                        </div>
                    </div>
                    <!--Latest Products-->
                    <div style="margin-top: 8rem">
                        <most-viewed-products :title="$page.props.title" />
                    </div>
                </div>
                <!--end main product area-->
                <Sidebar />
            </div>
            <!--end row-->
        </div>
        <!-- end .container-fluid -->
    </Layout>
</template>
<script>
import Layout from "@/Components/Shared/Layout";
import Sidebar from "@/Components/Shared/Sidebar";
import MostViewedProducts from "../Components/MostViewedProducts.vue";
export default {
    components: {
        Layout,
        Sidebar,
        MostViewedProducts,
    },
    computed: {
        formattedDescription() {
            return this.product.description.replace(/\n\n/g, "<br>");
        },
    },
    props: ["product"],
    data() {
        return {
            form: {
                id: "",
                name: "",
                price: "",
                qty: this.$page.props.cart_data.qty ?? 1,
            },
        };
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
            this.form.qty++;
        },
        decreaseQuantity() {
            this.form.qty--;
            if (this.form.qty < 1) {
                this.form.qty = 1;
            }
        },
    },
};
</script>

<style scoped>
.product-img {
    min-height: 180px;
    max-height: 280px;
    -o-object-fit: contain;
    object-fit: contain;
    width: 100%;
}
</style>
