<template>
    <Layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class=" main-content-area">
                        <h1>Contact Us | Quick shoppers</h1>
                        <div>
                            Write an email to: <span class="fw-bold text-decoration-underline"><a href="mailto:support@onlineserviceslab.com">Our Support</a></span>
                        </div>
                        <p>
                            Let the buying spree begin...
                        </p>
                     </div><!--end main content area-->
                </div><!--end main products area-->
                <Sidebar />
            </div><!--end row-->
        </div><!-- end .container-fluid -->
    </Layout>
</template>
<script>
import Layout from '@/Components/Shared/Layout';
import Sidebar from '@/Components/Shared/Sidebar';
export default  {
    components: {
       Layout,
       Sidebar,
    },
    data() {
        return {
        }
    }

}
</script>
