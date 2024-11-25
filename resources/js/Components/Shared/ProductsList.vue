<template>
    <ShopControl
        :reloaded="reloaded"
        @reload="getProducts()"
        @view-type-changed="setViewType()"
        :viewType="viewType"
        :title="title"
    />
    <div class="col-12">
        <div v-if="products && products?.data?.length > 0">
            <div
                class="row justify-content-center p-1 w-100 h-100"
                :class="`${
                    viewType == 'grid'
                        ? 'row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3'
                        : 'flex-column align-items-stretch'
                }`"
            >
                <div
                    class="pb-1 flex-1"
                    :class="`${
                        viewType == 'grid' ? 'col' : 'col-12 col-md-6 col-lg-4'
                    }`"
                    v-for="product in products.data"
                    :key="product.id"
                >
                    <div class="d-flex justify-content-center h-100">
                        <div
                            class="product product-style-2 m-1 d-flex justify-content-between"
                            style="flex-direction: column !important"
                        >
                            <div>
                                <div class="product-wish text-end">
                                    <a href="#"
                                        ><span
                                            class="fa fa-heart fs-4 custom-style-primary"
                                            aria-hidden="true"
                                        ></span
                                    ></a>
                                </div>
                                <div
                                    class="product-thumnail relative mx-auto d-block"
                                >
                                    <Link
                                        class="mx-auto d-block"
                                        :href="`${$page.props.url}product/${product.slug}`"
                                        :title="product.name"
                                    >
                                        <figure class="mx-auto d-block h-100">
                                            <img
                                                class="product-img mx-auto"
                                                :src="`${product.image}`"
                                                :alt="product.name"
                                            />
                                        </figure>
                                    </Link>
                                </div>
                            </div>
                            <div class="product-info">
                                <Link
                                    :href="`${$page.props.url}product/${product.slug}`"
                                    class="product-name"
                                    ><span>{{ product.name }}</span></Link
                                >
                                <div class="wrap-price">
                                    <span class="product-price"
                                        >${{ product.regular_price }}</span
                                    >
                                </div>
                                <button
                                    class="btn btn-outline-warning"
                                    @click.prevent="
                                        store(
                                            product.id,
                                            product.name,
                                            product.regular_price
                                        )
                                    "
                                >
                                    Add To Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <PaginationLinks :links="products" v-if="products?.links" />
        </div>
        <div
            v-else-if="products && products?.data?.length === 0"
            class="d-flex justify-content-center"
        >
            <div class="col-9 col-4 text-center" style="padding-top: 30px">
                No Products matching specified criteria
            </div>
        </div>
        <div v-else class="d-flex justify-content-center">
            <div class="col-9 col-4 text-center" style="padding-top: 30px">
                <InlineLoader
                    class="ms-auto"
                    styling="background:inherit;font-size:20px;color:#ff7007;"
                    text="Loading..."
                />
            </div>
        </div>
    </div>
</template>

<script>
import ShopControl from "@/Components/Shared/ShopControl";
import PaginationLinks from "@/Components/Shared/PaginationLinks";
import InlineLoader from "@/Components/Shared/InlineLoader";
import axios from "axios";
export default {
    components: {
        ShopControl,
        PaginationLinks,
        InlineLoader,
    },
    props: ["category", "reload", "productsPage"],
    data() {
        return {
            title: null,
            products: null,
            viewType: "grid",
            form: {
                id: "",
                name: "",
                price: "",
            },
            reloaded: false,
        };
    },
    methods: {
        store(id, name, price) {
            this.form.id = id;
            this.form.name = name;
            this.form.price = price;
            this.$inertia.post(`${this.$page.props.url}shop/cart`, this.form);
        },

        setViewType: function () {
            const shopControls = JSON.parse(
                localStorage.getItem("shopControls")
            );
            if (shopControls && "viewType" in shopControls) {
                this.viewType = shopControls.viewType;
            }
        },

        async getProducts() {
            let shopControls = JSON.parse(localStorage.getItem("shopControls"));
            const params = new Proxy(
                new URLSearchParams(window.location.search),
                {
                    get: (searchParams, prop) => searchParams.get(prop),
                }
            );
            let page = params.page;
            if (page) {
                shopControls = { ...shopControls, page };
            }

            let search = params.search;
            if (search) {
                shopControls = { ...shopControls, search };
            }

            let product_cat = params.product_cat;
            if (product_cat) {
                shopControls = { ...shopControls, product_cat };
            }

            let product_cat_id = params.product_cat_id;
            if (product_cat_id) {
                shopControls = { ...shopControls, product_cat_id };
            }

            if (this.category) {
                shopControls = {
                    ...shopControls,
                    category: this.category.slug,
                };
            }

            let url;
            if (this.productsPage == "search") {
                if (search) {
                    this.title = `Search results for: ${search}`;
                } else {
                    this.title = `All search results`;
                }

                // Select the search input
                const searchInput = document.querySelector(
                    '#form-search-top input[name="search"]'
                );
                if (searchInput) {
                    searchInput.value = search; // Set the value of the search input
                }

                // Select the dropdown for categories
                const categoryDropdown = document.querySelector(
                    '#form-search-top input[name="product_cat_id"]'
                );
                if (categoryDropdown) {
                    categoryDropdown.value = product_cat_id; // Set the value of the dropdown
                }

                url = new URL(`${this.$page.props.url}search/list`);
            } else {
                url = new URL(`${this.$page.props.url}products`);
            }

            url.search = new URLSearchParams(shopControls);

            this.reloaded = false;

            const resp = await axios.get(url);
            if (resp.status === 200) {
                const data = await resp.data;
                this.products = data?.products || data;
                this.reloaded = true;
                this.$emit("reloaded");
                // console.log(this.products.data.length)
            }
        },
    },
    computed: {
        linksNew() {},
    },

    watch: {
        reload: function () {
            this.getProducts();
        },
    },
    created() {
        this.getProducts();
        this.setViewType();
    },
    mounted() {
        if (this.$page.props.products) {
            this.products = this.$page.props.products;
            this.reloaded = true;
        }
    },
};
</script>

<style scoped>
.product-wish {
    /* position: absolute;
    top: 10%;
    left: 0; */
    z-index: 599;
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

.product-img {
    min-height: 140px;
    max-height: 240px;
    -o-object-fit: contain;
    object-fit: contain;
    width: 100%;
}
</style>
