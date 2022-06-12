<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <ShopControl :category="category" />
                    <ProductsList />
                </div><!--end main products area-->
                <Sidebar />
            </div><!--end row-->
        </div><!-- end .container-fluid -->
    </Layout>
</template>
<script>
import Layout from '@/Components/Shared/Layout';
import Sidebar from '@/Components/Shared/Sidebar';
import ShopControl from '@/Components/Shared/ShopControl'
import ProductsList from '@/Components/Shared/ProductsList';
export default  {
    components: {
        Layout,
        Sidebar,
        ShopControl,
        ProductsList,
    },
     props: ['category'],
}
</script>
