<template>
    <div class="col-12 col-md-4 col-lg-3 mt-4 mt-md-0">
        <div class="widget mercado-widget categories-widget">
            <h2 class="widget-title">All Categories</h2>
            <div class="widget-content">
                <ul class="list-category">
                    <li class="category-item has-child-cate" v-for="category in categories" :key="category.id">
                        <Link :href="`${$page.props.url}product-category/${category.slug}`" class="cate-link">{{  category.name }}</Link>
                        <span class="toggle-control">+</span>
                        <ul class="sub-cate">
                            <li class="category-item"><a href="#" class="cate-link">Batteries (22)</a></li>
                            <li class="category-item"><a href="#" class="cate-link">Headsets (16)</a></li>
                            <li class="category-item"><a href="#" class="cate-link">Screen (28)</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div><!-- Categories widget-->

        <div class="widget mercado-widget filter-widget price-filter" v-if="showPriceRange">
            <h2 class="widget-title">Price Range</h2>
            <div class="widget-content">
                <RangeSlider @reload="reload()" :reloaded="reloaded" />
            </div>
        </div><!-- Price-->

        <div class="widget mercado-widget filter-widget">
            <h2 class="widget-title">Size</h2>
            <div class="widget-content">
                <ul class="list-style inline-round ">
                    <li class="list-item"><a class="filter-link active" href="#">s</a></li>
                    <li class="list-item"><a class="filter-link " href="#">M</a></li>
                    <li class="list-item"><a class="filter-link " href="#">l</a></li>
                    <li class="list-item"><a class="filter-link " href="#">xl</a></li>
                </ul>
                <div class="widget-banner">
                    <figure><img :src="`${$page.props.asset}images/size-banner-widget.jpg`" width="270" height="331" alt=""></figure>
                </div>
            </div>
        </div><!-- Size -->

        <div class="widget mercado-widget widget-product">
            <h2 class="widget-title">Popular Products</h2>
            <div class="widget-content">
                <ul class="products">
                    <li class="product-item" v-for="product in popular" :key="product.id">
                        <div class="product product-widget-style">
                            <div class="thumbnnail">
                                <Link :href="`${$page.props.url}product/${product.slug}`" :title="product.name">
                                    <figure><img :src="product.image" alt=""></figure>
                                </Link>
                            </div>
                            <div class="product-info">
                                <Link :href="`${$page.props.url}product/${product.slug}`" class="product-name"><span>{{ product.name }}</span></Link>
                                <div class="wrap-price"><span class="product-price">{{ product.price }}</span></div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div><!-- brand widget-->

    </div><!--end sidebar-->
</template>
<script>
import RangeSlider from '@/Components/Shared/RangeSlider'
import axios from 'axios';
export default {
    components: {
        RangeSlider
    },
    props: ['showPriceRange', 'reloaded'],
    data() {
        return {
            popular: null,
            categories: null,
        }
    },
    created() {
        this.getPopular()
        this.getCategories()
    },
    methods: {
        async getCategories() {
            const resp = await axios.get(`${this.$page.props.url}categories/list`)
            if (resp.status == 200) {
                const data = await resp.data
                this.categories = data
            }
        },
        async getPopular() {
            const resp = await axios.get(`${this.$page.props.url}products/popular`)
            if (resp.status == 200) {
                const data = await resp.data
                this.popular = data
            }
        },
        reload() {
            this.$emit('reload')
        }
    }
}
</script>