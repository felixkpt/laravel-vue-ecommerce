<template>
    <div
        class="row style-1 justify-content-center mt-4"
        v-if="
            $page.props.on_sale_time !== null &&
            $page.props.on_sale_time.status == 1 &&
            $page.props.on_sale_time
        "
    >
        <div class="col-12 wrap-show-advance-info-box has-countdown">
            <h3 class="title-box">On Sale</h3>
            <div
                class="px-4 wrap-countdown mercado-countdown position-relative mb-4 top-0"
                :data-expire="formatDate($page.props.on_sale_time.sale_date)"
            ></div>
        </div>
        <div class="col-11 px-4">
            <vueper-slides
                class="no-shadow text-center"
                :visible-slides="5"
                slide-multiple
                :gap="1"
                :slide-ratio="1 / 3"
                fixed-height="true"
                autoplay
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
                    class=""
                    v-for="product in $page.props.on_sale"
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
                                            class="product-img mx-auto"
                                            :src="`${product.image}`"
                                            width="214"
                                            :alt="product.name"
                                        />
                                    </figure>
                                    <div class="group-flash">
                                        <span class="flash-item sale-label"
                                            >Sale</span
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
    </div>
</template>

<script>
import { VueperSlides, VueperSlide } from "vueperslides";
export default {
    components: {
        VueperSlides,
        VueperSlide,
    },
    methods: {
        formatDate(date) {
            var d = new Date(date),
                seconds = "" + d.getSeconds(),
                minutes = "" + d.getMinutes(),
                hour = "" + d.getHours(),
                day = "" + d.getDate(),
                month = "" + (d.getMonth() + 1),
                year = d.getFullYear();

            if (month.length < 2) month = "0" + month;
            if (day.length < 2) day = "0" + day;

            return (
                [year, month, day].join("/") +
                " " +
                hour +
                ":" +
                minutes +
                ":" +
                seconds
            );
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
