<template>
    <div>
        <h3 class="title-box">Most Viewed Products</h3>
        <div class="col px-4">
            <vueper-slides
                class="no-shadow"
                :visible-slides="5"
                slide-multiple
                :gap="1"
                :slide-ratio="1 / 3"
                fixed-height="true"
                autoplay
                :dragging-distance="200"
                :breakpoints="{
                    920: {
                        visibleSlides: 2,
                        slideMultiple: 2,
                    },
                }"
            >
                <vueper-slide
                    class=""
                    v-for="product in $page.props.most_viewed"
                    :key="product.id"
                    :title="product.name.toString()"
                >
                    <template #content>
                        <div class="product product-style-2 px-1 mb-2 h-100">
                            <div class="product-thumnail">
                                <a
                                    :href="`${$page.props.url}product/${product.slug}`"
                                    :title="product.name"
                                >
                                    <figure>
                                        <img
                                            :src="`${product.image}`"
                                            width="214"
                                            height="214"
                                            :alt="product.name"
                                        />
                                    </figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item new-label"
                                        >new</span
                                    >
                                </div>
                                <div class="wrap-btn">
                                    <a href="#" class="function-link"
                                        >quick view</a
                                    >
                                </div>
                            </div>
                            <div class="product-info">
                                <a
                                    :href="`${$page.props.url}product/${product.slug}`"
                                    class="product-name"
                                    ><span>{{ product.name }}</span></a
                                >
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
                                        <span
                                            class="product-price regular-price"
                                            >{{ product.regular_price }}</span
                                        >
                                    </del>
                                </div>
                            </div>
                        </div>
                    </template>
                </vueper-slide>
            </vueper-slides>
        </div>
        <!--End wrap-products-->
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
