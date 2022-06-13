<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <ProductsList :reload="reload" @reloaded="emitReloaded()" />
                </div>
                <Sidebar @reload="emitReload()" :reloaded="reloaded" :showPriceRange="true" />
            </div><!--end row-->
        </div><!-- end .container-fluid -->
    </Layout>
</template>
<script>
import Layout from '@/Components/Shared/Layout';
import Sidebar from '@/Components/Shared/Sidebar';
import ProductsList from '@/Components/Shared/ProductsList';
export default  {
    components: {
        Layout,
        Sidebar,
        ProductsList,
    },
    data() {
        return {
            reload: Math.random(),
            reloaded: Math.random(),
        }
    },
    methods: {
        emitReload() {
            this.reload = Math.random()
        },
        emitReloaded() {
            this.reloaded = Math.random()
        }
    }
     
}
</script>
