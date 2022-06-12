<template>
    <div class="col-12">
        <div class="row justify-content-center p-1 w-100 h-100" :class="`${$page.props.viewType == 'grid' ? 'row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3' : 'flex-column align-items-center'}`">
            <div class="pb-1" :class="`${$page.props.viewType == 'grid' ? 'col' : 'col-12 col-md-6 col-lg-4'}`"  v-for="product in products.data" :key="product.id">
                <div class="d-flex justify-content-center">
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
        </div>
        <PaginationLinks :links="links" v-if="links.links" />
    </div>
</template>

<script>
import PaginationLinks from '@/Components/Shared/PaginationLinks';
export default {
    components: {
        PaginationLinks,
    },
    data() {
        return {
            products: this.$page.props.products,
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