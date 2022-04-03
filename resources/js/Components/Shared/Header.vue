<template>
    <!--header-->
    <header class="mb-2 border-bottom">
        <nav class="navbar navbar-expand-sm navbar-light bg-light" aria-label="Third navbar example">
            <div class="container-fluid px-2">
                <a title="Hotline: (+254) 712730908" href="#" class="nav-link ps-1"><span class="fa fa-mobile text-danger"></span> Hotline: (+254) 726021426</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-header" aria-controls="navbar-primary" aria-expanded="false" aria-label="Toggle primary navigation">
                    <span class="fa fa-align-justify"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbar-header" style="">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="flex-direction: row!important">
                        <AuthSection />
                        <li class="nav-item dropdown">
                            <a title="English" class="nav-link dropdown-toggle" href="#" id="dropdown-language" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><img :src="`${$page.props.asset}uploads/images/lang-en.png`" alt="lang-en"></span>English
                            </a>
                            <ul class="dropdown-menu position-absolute" aria-labelledby="dropdown-language">
                                <li class="dropdown-item"><a title="hungary" href="#"><span class="img label-before"><img :src="`${$page.props.asset}uploads/images/lang-hun.png`" alt="lang-hun"></span>Hungary</a></li>
                                <li class="dropdown-item"><a title="german" href="#"><span class="img label-before"><img :src="`${$page.props.asset}uploads/images/lang-ger.png`" alt="lang-ger" ></span>German</a></li>
                                <li class="dropdown-item"><a title="french" href="#"><span class="img label-before"><img :src="`${$page.props.asset}uploads/images/lang-fra.png`" alt="lang-fre"></span>French</a></li>
                                <li class="dropdown-item"><a title="canada" href="#"><span class="img label-before"><img :src="`${$page.props.asset}uploads/images/lang-can.png`" alt="lang-can"></span>Canada</a></li>
                            </ul>
                        </li>      
                        <li class="nav-item dropdown">
                            <a title="Dollar (USD)" class="nav-link dropdown-toggle" href="#" id="dropdown-curreny" data-bs-toggle="dropdown" aria-expanded="false">
                                Dollar (USD)
                            </a>
                            <ul class="dropdown-menu position-absolute" aria-labelledby="dropdown-curreny">
                                <li class="nav-item" >
                                    <a title="Pound (GBP)" href="#">Pound (GBP)</a>
                                </li>
                                <li class="nav-item" >
                                    <a title="Euro (EUR)" href="#">Euro (EUR)</a>
                                </li>
                                <li class="nav-item" >
                                    <a title="Dollar (USD)" href="#">Dollar (USD)</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid px-0">
            <div class="row py-1">
                <a :href="`${$page.props.url}`" class="col-12 col-md-3 mb-2 mb-md-0 text-decoration-none">
                    <h4 class="text-danger ps-1">Quick Shoppers</h4>
                </a>
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                    <div class="row justify-content-center">
                        <div class="ms-1 ms-md-auto col-12 col-md-9 col-lg px-md-0">
                            <Search />
                        </div>
                        <div class="ms-1 ms-md-auto col-12 col-md-3 col-lg px-md-0">
                            <ul class="nav ms-auto me-1 justify-content-md-end">
                            <li class="nav-item">
                                <a class="nav-link text-white bg-dark d-flex flex-nowrap" href="#">
                                    <i class="fa fa-heart fs-5" aria-hidden="true"></i>
                                    <div class="d-inline-block">
                                        <span class="index px-1">0</span>
                                        <span class="d-md-none d-lg-inline">items <span class="title">Wishlist</span></span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <Link :href="route('shop.cart')" class="nav-link text-white bg-danger d-flex flex-nowrap">
                                    <i class="fa fa-shopping-cart fs-5" aria-hidden="true"></i>
                                    <div class="left-info">
                                        <span class="index px-1" id="navCartCount"></span>
                                        <span class="d-md-none d-lg-inline"> items CART</span>
                                    </div>
                                </Link>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <Nav /> 
</template>
<script>
import axios from 'axios';
import Nav from './Nav';
import AuthSection from './AuthSection';
import Search from './Search';
import 'vueperslides/dist/vueperslides.css'
export default {
    components: {
        Nav,
        AuthSection,
        Search,
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

        this.navCartCount()
 
    }

}
</script>
