<template>
    <div
        class="row style-1"
        v-if="
            $page.props.on_sale_time !== null &&
            $page.props.on_sale_time.status == 1 &&
            $page.props.on_sale_time
        "
    >
        <div class="col-12 wrap-show-advance-info-box has-countdown">
            <h3 class="title-box">Latest Products</h3>
            <div class="wrap-top-banner">
                <a href="#" class="link-banner banner-effect-2">
                    <figure>
                        <img
                            :src="`${$page.props.asset}images/digital-electronic-banner.jpg`"
                            width="1170"
                            height="240"
                            alt=""
                        />
                    </figure>
                </a>
            </div>
        </div>
        <div class="col-12 px-4">
           <MostViewedProducts :showTitle="false" />
        </div>
    </div>
</template>
<script>
import MostViewedProducts from "./MostViewedProducts.vue";
export default {
    components: {
        MostViewedProducts,
    },
};
</script>
