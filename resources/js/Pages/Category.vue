<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <ProductsList :reload="reload" :category="category" />
                </div>
                <Sidebar @reload="emitReload()" />
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
    props: ['category'],
    data() {
        return {
            reload: Math.random()
        }
    },
    methods: {
        emitReload() {
            this.reload = Math.random()
        }
    }
     
}
</script>

