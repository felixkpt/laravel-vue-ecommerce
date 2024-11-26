<template>
    <div>
        <h3 class="title-box" v-if="showTitle">
            {{ title || "Most Viewed Products" }}
        </h3>
        <div class="col px-2">
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
                        <div
                            class="product product-style-2 px-1 mb-2 h-100 d-flex flex-column"
                        >
                            <div
                                class="product-thumnail relative mx-auto d-block w-100"
                            >
                                <Link
                                    class="mx-auto d-block h-100"
                                    :href="`${$page.props.url}product/${product.slug}`"
                                    :title="product.name"
                                >
                                    <figure class="mx-auto d-block h-100">
                                        <img
                                            class="product-img img-fluid mx-auto"
                                            :src="`${product.image}`"
                                            width="214"
                                            :alt="product.name"
                                        />
                                    </figure>
                                    <div class="group-flash">
                                        <span class="flash-item new-label"
                                            >new</span
                                        >
                                    </div>
                                    <div class="wrap-btn">
                                        <span class="function-link"
                                            >quick view</span
                                        >
                                    </div>
                                </Link>
                            </div>
                            <div class="product-info">
                                <Link
                                    :href="`${$page.props.url}product/${product.slug}`"
                                    class="product-name"
                                    ><span>{{ product.name }}</span></Link
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
    props: {
        showTitle: {
            type: Boolean,
            default: true,
        },
        title: {
            type: String,
            default: null,
        },
    },
};
</script>

<style scoped>
.product-thumnail {
    min-height: 100px;
}
.product-img {
    min-height: 100px;
    max-height: 180px;
    -o-object-fit: contain;
    object-fit: contain;
    width: 100%;
}
</style>
