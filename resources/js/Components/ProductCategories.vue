<template>
    <!--Product Categories-->
    <div class="wrap-show-advance-info-box style-1">
        <h3 class="title-box">Product Categories</h3>
        <div class="wrap-top-banner">
            <a href="#" class="link-banner banner-effect-2">
                <figure>
                    <img
                        :src="`${$page.props.asset}images/fashion-accesories-banner.jpg`"
                        width="1170"
                        height="240"
                        alt=""
                    />
                </figure>
            </a>
        </div>
    </div>
    <div class="wrap-products">
        <div class="wrap-product-tab tab-style-1">
            <div class="tab-control">
                <span
                    :href="`#section_${index + 1}a`"
                    class="cursor-point"
                    :class="{
                        'tab-control-item': true,
                        active: index == 0,
                    }"
                    v-for="(category, index) in $page.props.categories"
                    :key="category.id"
                >
                    {{ category.name }}
                </span>
            </div>
            <div class="tab-contents">
                <div
                    :id="`section_${index + 1}a`"
                    :class="{
                        'tab-content-item': true,
                        active: index == 0,
                    }"
                    v-for="(category, index) in $page.props.categories"
                    :key="category.id"
                >
                    <div class="row">
                        <div class="col-11 px-4 mx-auto">
                            <vueper-slides
                                class="no-shadow text-center"
                                :visible-slides="5"
                                slide-multiple
                                :gap="1"
                                :slide-ratio="1 / 3"
                                fixed-height="true"
                                :dragging-distance="200"
                                :breakpoints="{
                                    992: {
                                        visibleSlides: 3,
                                        slideMultiple: 1,
                                    },
                                    768: {
                                        visibleSlides: 2,
                                        slideMultiple: 1,
                                    },
                                    574: {
                                        visibleSlides: 1,
                                        slideMultiple: 1,
                                    },
                                }"
                            >
                                <vueper-slide
                                    v-for="product in $page.props.categories[
                                        index
                                    ].products"
                                    :key="product.id"
                                >
                                    <template #content>
                                        <div
                                            class="product product-style-2 px-1 mb-2 h-100 d-flex flex-column"
                                        >
                                            <div
                                                class="product-thumnail relative mx-auto d-block w-100"
                                            >
                                                <Link
                                                    class="mx-auto d-block"
                                                    :href="`${$page.props.url}product/${product.slug}`"
                                                    :title="product.name"
                                                >
                                                    <figure
                                                        class="mx-auto d-block"
                                                    >
                                                        <img
                                                            class="product-img mx-auto"
                                                            :src="`${product.image}`"
                                                            width="214"
                                                            :alt="product.name"
                                                        />
                                                    </figure>
                                                    <div class="group-flash">
                                                        <!-- <span class="flash-item new-label">New</span> -->
                                                    </div>
                                                    <div class="wrap-btn">
                                                        <span
                                                            class="function-link"
                                                            >quick view</span
                                                        >
                                                    </div>
                                                </Link>
                                            </div>
                                            <div class="product-info">
                                                <Link
                                                    :href="`${$page.props.url}product/${product.slug}`"
                                                    class="product-name"
                                                    ><span>{{
                                                        product.name
                                                    }}</span></Link
                                                >
                                                <div class="wrap-price">
                                                    <ins>
                                                        <span
                                                            class="product-price"
                                                            v-if="
                                                                product.sale_price
                                                            "
                                                            >{{
                                                                product.sale_price
                                                            }}</span
                                                        >
                                                        <span
                                                            class="product-price"
                                                            v-else
                                                            >{{
                                                                product.regular_price
                                                            }}</span
                                                        >
                                                    </ins>
                                                    <del
                                                        v-if="
                                                            product.sale_price
                                                        "
                                                    >
                                                        <span
                                                            class="product-price regular-price"
                                                            >{{
                                                                product.regular_price
                                                            }}</span
                                                        >
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
</template>
<script>
import { VueperSlides, VueperSlide } from "vueperslides";
export default {
    components: {
        VueperSlides,
        VueperSlide,
    },
};
</script>
<style scoped>
.product-img {
    min-height: 100px;
    max-height: 180px;
    -o-object-fit: contain;
    object-fit: contain;
    width: 100%;
}
.cursor-point{
    cursor: pointer;
}
</style>
