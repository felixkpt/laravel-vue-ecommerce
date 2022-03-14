<template>
        <!--header-->
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" :href="`${$page.props.url}`">Quick Shoppers</a>
  <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="text-right">
    <AuthSection />
  </div>
</header>
</template>
<script>
import axios from 'axios';
import AuthSection from '@/Components/Shared/AuthSection';
import 'vueperslides/dist/vueperslides.css'

export default {
    components: {
        AuthSection,
    },
    data() {
        return {
            cart_data: null
        }
    },
    mathods: {
        getCartContent(){

        }
    },
    computed: {

    },
    mounted(){

        // this.navCartCount()
 
    }

}
</script>
