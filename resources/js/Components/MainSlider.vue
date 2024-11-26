<template>
    <vueper-slides autoplay :dragging-distance="200">
        <vueper-slide
            v-for="(product, index) in $page.props.home_sliders"
            :key="product.id"
        >
            <template #content>
                <div class="slide-carousel">
                    <img
                        :src="`${
                            $page.props.asset
                        }images/home-sliders/blog-article-${index + 1}.jpg`"
                        alt=""
                        class="w-100"
                    />
                    <div :class="`slide-info slide-${index + 1}`">
                        <h2 class="f-title">
                            {{ product.name }}
                        </h2>
                        <span class="subtitle">{{
                            product.description.length > 40
                                ? product.description.substring(0, 40) + "..."
                                : product.description
                        }}</span>
                        <p class="sale-info">
                            Only price:
                            <span class="price">{{ product.sale_price }}</span>
                        </p>
                        <Link
                            :href="`${$page.props.url}product/${product.slug}`"
                            class="btn-link"
                            @click.prevent.stop="
                                navigateToProduct(product.slug)
                            "
                        >
                            Shop Now
                        </Link>
                    </div>
                </div>
            </template>
        </vueper-slide>
    </vueper-slides>
</template>

<script>
import { VueperSlides, VueperSlide } from "vueperslides";
export default {
    components: {
        VueperSlides,
        VueperSlide,
    },
    data() {
        return {
            isDragging: false,
        };
    },
    methods: {
        navigateToProduct(slug) {
            if (!this.isDragging) {
                this.$router.push(`/product/${slug}`);
            }
        },
    },
};
</script>
