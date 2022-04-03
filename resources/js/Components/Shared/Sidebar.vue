<template>
    <div class="col-12 col-md-4 col-lg-3 mt-4 mt-md-0">
        <div class="widget mercado-widget categories-widget">
            <h2 class="widget-title">All Categories</h2>
            <div class="widget-content">
                <ul class="list-category">
                    <li class="category-item has-child-cate" v-for="category in $page.props.categories" :key="category.id">
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

        <div class="widget mercado-widget filter-widget brand-widget">
            <h2 class="widget-title">Brand</h2>
            <div class="widget-content">
                <ul class="list-style vertical-list list-limited" data-show="6">
                    <li class="list-item"><a class="filter-link active" href="#">Fashion Clothings</a></li>
                    <li class="list-item"><a class="filter-link " href="#">Laptop Batteries</a></li>
                    <li class="list-item"><a class="filter-link " href="#">Printer & Ink</a></li>
                    <li class="list-item"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                    <li class="list-item"><a class="filter-link " href="#">Sound & Speaker</a></li>
                    <li class="list-item"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
                    <li class="list-item default-hiden"><a class="filter-link " href="#">Printer & Ink</a></li>
                    <li class="list-item default-hiden"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                    <li class="list-item default-hiden"><a class="filter-link " href="#">Sound & Speaker</a></li>
                    <li class="list-item default-hiden"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
                    <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div><!-- brand widget-->

        <div class="widget mercado-widget filter-widget price-filter">
            <h2 class="widget-title">Price Range</h2>
            <div class="widget-content">
                <RangeSlider />
            </div>
        </div><!-- Price-->

        <div class="widget mercado-widget filter-widget">
            <h2 class="widget-title">Color</h2>
            <div class="widget-content">
                <ul class="list-style vertical-list has-count-index">
                    <li class="list-item"><a class="filter-link " href="#">Red <span>(217)</span></a></li>
                    <li class="list-item"><a class="filter-link " href="#">Yellow <span>(179)</span></a></li>
                    <li class="list-item"><a class="filter-link " href="#">Black <span>(79)</span></a></li>
                    <li class="list-item"><a class="filter-link " href="#">Blue <span>(283)</span></a></li>
                    <li class="list-item"><a class="filter-link " href="#">Grey <span>(116)</span></a></li>
                    <li class="list-item"><a class="filter-link " href="#">Pink <span>(29)</span></a></li>
                </ul>
            </div>
        </div><!-- Color -->

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
                    <figure><img :src="`${$page.props.asset}uploads/images/size-banner-widget.jpg`" width="270" height="331" alt=""></figure>
                </div>
            </div>
        </div><!-- Size -->

        <div class="widget mercado-widget widget-product">
            <h2 class="widget-title">Popular Products</h2>
            <div class="widget-content">
                <ul class="products">
                    <li class="product-item">
                        <div class="product product-widget-style">
                            <div class="thumbnnail">
                                <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                    <figure><img :src="`${$page.props.asset}uploads/images/products/digital_1.jpg`" alt=""></figure>
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                <div class="wrap-price"><span class="product-price">$168.00</span></div>
                            </div>
                        </div>
                    </li>

                    <li class="product-item">
                        <div class="product product-widget-style">
                            <div class="thumbnnail">
                                <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                    <figure><img :src="`${$page.props.asset}uploads/images/products/digital_17.jpg`" alt=""></figure>
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                <div class="wrap-price"><span class="product-price">$168.00</span></div>
                            </div>
                        </div>
                    </li>

                    <li class="product-item">
                        <div class="product product-widget-style">
                            <div class="thumbnnail">
                                <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                    <figure><img :src="`${$page.props.asset}uploads/images/products/digital_18.jpg`" alt=""></figure>
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                <div class="wrap-price"><span class="product-price">$168.00</span></div>
                            </div>
                        </div>
                    </li>

                    <li class="product-item">
                        <div class="product product-widget-style">
                            <div class="thumbnnail">
                                <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                    <figure><img :src="`${$page.props.asset}uploads/images/products/digital_20.jpg`" alt=""></figure>
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                <div class="wrap-price"><span class="product-price">$168.00</span></div>
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
export default {
    components: {
        RangeSlider
    }
}
</script>