<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="wrap-main-slide">
                        <main-slider />
                    </div>
                    <div class="row">
                        <div class="mt-4">
                            <!--On Sale-->
                            <on-sale />
                        </div>
                    </div>
                    <!--Latest Products-->
                    <div class="mt-4">
                        <latest-products />
                    </div>
                    <div class="mt-4">
                        <product-categories />
                    </div>
                </div>
                <!--end main products area-->
                <Sidebar />
            </div>
            <!--end row-->
        </div>
        <!-- end .container-fluid -->
    </Layout>
</template>
<script>
import Layout from "@/Components/Shared/Layout";
import Sidebar from "@/Components/Shared/Sidebar";
import { VueperSlides, VueperSlide } from "vueperslides";
import ProductCategories from "../Components/ProductCategories.vue";
import OnSale from "../Components/OnSale.vue";
import LatestProducts from "../Components/LatestProducts.vue";
import MainSlider from "../Components/MainSlider.vue";
export default {
    components: {
        Layout,
        Sidebar,
        VueperSlides,
        VueperSlide,
        ProductCategories,
        OnSale,
        LatestProducts,
        MainSlider,
    },
    mounted() {
        // console.log(this.$page.props.on_sale_time)
    },
};
</script>
