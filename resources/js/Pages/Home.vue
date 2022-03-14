<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="wrap-main-slide">
                        <!-- MAIN SLIDE -->
                        <vueper-slides autoplay>
                            <vueper-slide v-for="(product, index) in $page.props.home_sliders" :key="product.id"
                            :style="''">
                                <template #content>
                                    <div class="slide-carousel">
                                        <img :src="`${$page.props.asset}uploads/images/home-sliders/blog-article-${index + 1}.jpg`" alt="" class="img-slide">
                                        <div :class="`slide-info slide-${index + 1}`">
                                            <h2 class="f-title">{{ product.name }}</h2>
                                            <span class="subtitle">{{ product.description.length > 50 ? product.description.substring(0, 50) + '...' : product.description }}</span>
                                            <p class="sale-info">Only price: <span class="price">{{ product.sale_price }}</span></p>
                                            <Link :href="`${$page.props.url}product/${product.slug}`" class="btn-link">Shop Now</Link> 
                                        </div>
                                    </div>
                                </template>
                            </vueper-slide>
                        </vueper-slides>
                    </div>    
                    <div class="row">
                        <div class="col">
                            <!--BANNER-->
                                <div class="wrap-banner style-twin-default">
                                    <div class="banner-item">
                                        <a href="#" class="link-banner banner-effect-1">
                                            <figure><img :src="`${$page.props.asset}uploads/images/home-1-banner-1.jpg`" alt="" width="580" height="190"></figure>
                                        </a> 
                                    </div>
                                    <div class="banner-item">
                                        <a href="#" class="link-banner banner-effect-1">
                                            <figure><img :src="`${$page.props.asset}uploads/images/home-1-banner-2.jpg`" alt="" width="580" height="190"></figure>
                                        </a> 
                                    </div>
                                    </div>
                            <!--On Sale-->
                            <div class="row style-1" v-if="$page.props.on_sale_time.status == 1 && $page.props.on_sale_time">
                                <div class="col-12 wrap-show-advance-info-box has-countdown">
                                    <h3 class="title-box">On Sale</h3>
                                    <div class="px-4 wrap-countdown mercado-countdown" :data-expire="formatDate($page.props.on_sale_time.sale_date)">
                                    </div>
                                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" :data-items="$page.props.on_sale.length" data-loop="false" data-nav="true" data-dots="false" data-responsive=''>
                                    </div>
                                </div>
                                <div class="col-12 px-4">
                                    <vueper-slides class="no-shadow" 
                                    :visible-slides="5"
                                    slide-multiple
                                    :gap="1"
                                    :slide-ratio="1 / 3"
                                    fixed-height="true"
                                    autoplay
                                    :dragging-distance="200"
                                    :breakpoints="{ 920: { visibleSlides: 2, slideMultiple: 2 } }">

                                        <vueper-slide class=""  v-for="product in $page.props.on_sale" :key="product.id" :title="product.name.toString()">
                                            <template #content>
                                                <div class="product product-style-2 px-1 mb-2 h-100">
                                                    <div class="product-thumnail">
                                                        <Link :href="`${$page.props.url}product/${product.slug}`" :title="product.name">
                                                            <figure><img :src="`${$page.props.asset}uploads/${product.image}`" width="214" height="214" :alt="product.name"></figure>
                                                        </Link> 
                                                        <div class="group-flash">
                                                            <span class="flash-item sale-label">Sale</span>
                                                        </div>
                                                        <div class="wrap-btn">
                                                            <a href="#" class="function-link">quick view</a> 
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        <Link :href="`${$page.props.url}product/${product.slug}`" class="product-name"><span>{{ product.name }}</span></Link> 
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
                                            </template>
                                        </vueper-slide>
                                    </vueper-slides>
                                </div>
                            </div>
                            <!-- End On Sale -->
                        </div>
                    </div>
                    <!--Latest Products-->
                   <div class="row style-1" v-if="$page.props.on_sale_time.status == 1 && $page.props.on_sale_time">
                        <div class="col-12 wrap-show-advance-info-box has-countdown">
                            <h3 class="title-box">Latest Products</h3>
                            <div class="wrap-top-banner">
                                <a href="#" class="link-banner banner-effect-2">
                                    <figure><img :src="`${$page.props.asset}uploads/images/digital-electronic-banner.jpg`" width="1170" height="240" alt=""></figure>
                                </a> 
                            </div>
                        </div>
                        <div class="col-12 px-4">
                            <vueper-slides class="no-shadow" 
                            :visible-slides="5"
                            slide-multiple
                            :gap="1"
                            :slide-ratio="1 / 3"
                            fixed-height="true"
                            fade
                            autoplay
                            :dragging-distance="200"
                            :breakpoints="{ 920: { visibleSlides: 2, slideMultiple: 2 } }">

                                <vueper-slide class="" v-for="product in $page.props.latest_products" :key="product.id">
                                    <template #content>
                                        <div class="product product-style-2 px-1 mb-2 h-100">
                                            <div class="product-thumnail">
                                                <Link :href="`${$page.props.url}product/${product.slug}`" :title="product.name">
                                                    <figure><img :src="`${$page.props.asset}uploads/${product.image}`" width="214" height="214" :alt="product.name"></figure>
                                                </Link> 
                                                <div class="group-flash">
                                                    <span class="flash-item new-label">New</span>
                                                </div>
                                                <div class="wrap-btn">
                                                    <a href="#" class="function-link">quick view</a> 
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <Link :href="`${$page.props.url}product/${product.slug}`" class="product-name"><span>{{ product.name }}</span></Link> 
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
                                    </template>
                                </vueper-slide>
                            </vueper-slides>
                        </div>
                    </div>

                    <!--Product Categories-->
                    <div class="wrap-show-advance-info-box style-1">
                        <h3 class="title-box">Product Categories</h3>
                        <div class="wrap-top-banner">
                        <a href="#" class="link-banner banner-effect-2">
                            <figure><img :src="`${$page.props.asset}uploads/images/fashion-accesories-banner.jpg`" width="1170" height="240" alt=""></figure>
                        </a> 
                        </div>
                    </div>
                    <div class="wrap-products">
                        <div class="wrap-product-tab tab-style-1">
                        <div class="tab-control">
                            <a :href="`#section_${index + 1}a`" :class="{'tab-control-item': true, 'active': index == 0}" v-for="(category, index) in $page.props.categories" :key="category.id">{{ category.name }}</a> 
                        </div>
                        <div class="tab-contents">
                            <div :id="`section_${index + 1}a`" :class="{'tab-content-item': true, 'active': index == 0}" v-for="(category, index) in $page.props.categories" :key="category.id">
                                <div class="row">
                                    
                                    <div class="col-12 px-4">
                                        <vueper-slides class="no-shadow" 
                                        :visible-slides="5"
                                        slide-multiple
                                        :gap="1"
                                        :slide-ratio="1 / 3"
                                        fixed-height="true"
                                        :dragging-distance="200"
                                        :breakpoints="{ 920: { visibleSlides: 2, slideMultiple: 2 } }">

                                            <vueper-slide v-for="product in $page.props.categories[index].products" :key="product.id">
                                                <template #content>
                                                    <div class="product product-style-2 px-1 mb-2 h-100">
                                                        <div class="product-thumnail">
                                                            <Link :href="`${$page.props.url}product/${product.slug}`" :title="product.name">
                                                                <figure><img :src="`${$page.props.asset}uploads/${product.image}`" width="214" height="214" :alt="product.name"></figure>
                                                            </Link> 
                                                            <div class="group-flash">
                                                                <!-- <span class="flash-item new-label">New</span> -->
                                                            </div>
                                                            <div class="wrap-btn">
                                                                <a href="#" class="function-link">quick view</a> 
                                                            </div>
                                                        </div>
                                                        <div class="product-info">
                                                            <Link :href="`${$page.props.url}product/${product.slug}`" class="product-name"><span>{{ product.name }}</span></Link> 
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
                                                </template>
                                            </vueper-slide>
                                        </vueper-slides>
                                    </div>

                                </div>
                            </div>
                        </div>
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
import { VueperSlides, VueperSlide } from 'vueperslides'
export default  {
    components: {
       Layout,
       Sidebar,
       VueperSlides, VueperSlide
    },
    data() {
        return {
            
        }
    },
    methods: {
        formatDate(date) {
    var d = new Date(date),
        seconds = '' + d.getSeconds(),
        minutes = '' + d.getMinutes(),
        hour = '' + d.getHours(),
        day = '' + d.getDate(),
        month = '' + (d.getMonth() + 1),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

// console.log([year, month, day].join('/') + ' ' + hour + ':' + minutes + ':' + seconds)
    return [year, month, day].join('/') + ' ' + hour + ':' + minutes + ':' + seconds;
}
 
    },
    mounted() {
        // console.log(this.$page.props.on_sale_time)
    }

}
</script>
