<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <!-- MAIN SLIDE -->
                                    <div class="wrap-main-slide">
                                        <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
                                            <div class="item-slide" v-for="(home_slider, index) in $page.props.home_sliders" :key="home_slider.id">
                                                <img :src="`${$page.props.asset}uploads/images/home-sliders/blog-article-${index + 1}.jpg`" alt="" class="img-slide">
                                                <div :class="`slide-info slide-${index + 1}`">
                                                <h2 class="f-title">{{ home_slider.title }} <b>Watches</b></h2>
                                                <span class="subtitle">{{ home_slider.subtitle }}</span>
                                                <p class="sale-info">Only price: <span class="price">{{ home_slider.price }}</span></p>
                                                <a :href="home_slider.link" class="btn-link">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                            
                            </div>
                        </div>
                        </div>
                    <div class="col-3">
                        Sidebar
                    </div>
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
                        <div class="wrap-show-advance-info-box style-1 has-countdown" v-if="$page.props.on_sale_time > 0">
                            <div v-if="$page.props.on_sale_time.status == 1">
                                    <h3 class="title-box">On Sale</h3>
                                <div class="wrap-countdown mercado-countdown" :data-expire="formatDate($page.props.on_sale_time.sale_date)"></div>
                                <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" :data-items="$page.props.on_sale.length" data-loop="false" data-nav="true" data-dots="false" data-responsive=''>

                                    <div class="product product-style-2 equal-elem" v-for="product in $page.props.on_sale" :key="product.id">
                                        <div class="product-thumnail">
                                            <a :href="`${$page.props.url}product/${product.slug}`" :title="`${product.name}`">
                                                <figure><img :src="`${$page.props.asset}uploads/${product.image}`" width="800" height="800" :alt="`${product.name}`"></figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item sale-label">sale</span>
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
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--Latest Products-->
                    <div class="row">
                        <div class="col">
                            <div class="wrap-show-advance-info-box style-1">
                            <h3 class="title-box">Latest Products</h3>
                            <div class="wrap-top-banner">
                                <a href="#" class="link-banner banner-effect-2">
                                    <figure><img :src="`${$page.props.asset}uploads/images/digital-electronic-banner.jpg`" width="1170" height="240" alt=""></figure>
                                </a>
                            </div>
                            <div class="wrap-products">
                                <div class="wrap-product-tab tab-style-1">
                                    <div class="tab-contents">
                                        <div class="tab-content-item active" id="digital_1a">
                                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >


                                                <div class="product product-style-2 equal-elem" v-for="product in $page.props.latest_products" :key="product.id">
                                                    <div class="product-thumnail">
                                                        <a :href="`${$page.props.url}product/${product.slug}`" :title="product.name">
                                                            <figure><img :src="`${$page.props.asset}uploads/${product.image}`" width="300" height="auto" :alt="product.name"></figure>
                                                        </a>
                                                        <div class="group-flash">
                                                            <span class="flash-item sale-label">sale</span>
                                                        </div>
                                                        <div class="wrap-btn">
                                                            <a href="#" class="function-link">quick view</a>
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="#" class="product-name"><span>{{ product.name }}</span></a>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" :data-items="$page.props.categories[index].products.length" data-loop="false" data-nav="true" data-dots="false" data-responsive=''>
                                    <div v-for="product in $page.props.categories[index].products" class="product product-style-2 equal-elem" :key="product.id">
                                        <div class="product-thumnail">
                                            <a :href="`${$page.props.url}product/${product.slug}`" :title="product.name">
                                                <figure><img :src="`${$page.props.asset}uploads/${product.image}`" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
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
export default  {
    components: {
       Layout,
       Sidebar,
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
