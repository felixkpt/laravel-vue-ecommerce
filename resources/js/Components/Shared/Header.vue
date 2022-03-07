<template>
    <!--header-->
        <header id="header" class="header header-style-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="topbar-menu-area">
                        <div class="container">
                            <div class="topbar-menu left-menu">
                                <ul>
                                    <li class="menu-item" >
                                        <Link title="Hotline: (+254) 712730908" href="#" ><span class="icon label-before fa fa-mobile"></span>Hotline: (+254) 726021426</Link>
                                    </li>
                                </ul>
                            </div>
                            <div class="topbar-menu right-menu">
                                <ul>

                                    <AuthSection />

                                    <li class="menu-item lang-menu menu-item-has-children parent">
                                        <a title="English" href="#"><span class="img label-before"><img :src="`${$page.props.asset}uploads/images/lang-en.png`" alt="lang-en"></span>English<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                        <ul class="submenu lang" >
                                            <li class="menu-item" ><Link title="hungary" href="#"><span class="img label-before"><img :src="`${$page.props.asset}uploads/images/lang-hun.png`" alt="lang-hun"></span>Hungary</Link></li>
                                            <li class="menu-item" ><Link title="german" href="#"><span class="img label-before"><img :src="`${$page.props.asset}uploads/images/lang-ger.png`" alt="lang-ger" ></span>German</Link></li>
                                            <li class="menu-item" ><Link title="french" href="#"><span class="img label-before"><img :src="`${$page.props.asset}uploads/images/lang-fra.png`" alt="lang-fre"></span>French</Link></li>
                                            <li class="menu-item" ><Link title="canada" href="#"><span class="img label-before"><img :src="`${$page.props.asset}uploads/images/lang-can.png`" alt="lang-can"></span>Canada</Link></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children parent" >
                                        <a title="Dollar (USD)" href="#">Dollar (USD)<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                        <ul class="submenu curency" >
                                            <li class="menu-item" >
                                                <Link title="Pound (GBP)" href="#">Pound (GBP)</Link>
                                            </li>
                                            <li class="menu-item" >
                                                <Link title="Euro (EUR)" href="#">Euro (EUR)</Link>
                                            </li>
                                            <li class="menu-item" >
                                                <Link title="Dollar (USD)" href="#">Dollar (USD)</Link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="mid-section main-info-area">

                            <div class="wrap-logo-top left-section">
                                <a :href="`${this.$page.props.url}`" class="link-to-home">Quick Shoppers</a>
                            </div>

                            <div class="wrap-search center-section">
                                <Search />
                            </div>

                            <div class="wrap-icon right-section">
                                <div class="wrap-icon-section wishlist">
                                    <a href="#" class="link-direction">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                        <div class="left-info">
                                            <span class="index">0 item</span>
                                            <span class="title">Wishlist</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="wrap-icon-section minicart">
                                    <Link :href="route('product.cart')" class="link-direction">
                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                        <div class="left-info" v-if="cart">
                                            <span class="index ps-1">{{ cart.count }} items</span>
                                            <span class="title">CART</span>
                                        </div>
                                    </Link>
                                </div>
                                <div class="wrap-icon-section show-up-after-1024">
                                    <a href="#" class="mobile-navigation">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="nav-section header-sticky">
                        <nav class="header-nav-section">
                            <div class="container">
                                <ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info" >
                                    <li class="menu-item"><a href="#" class="link-term">Weekly Featured</a><span class="nav-label hot-label">hot</span></li>
                                    <li class="menu-item"><a href="#" class="link-term">Hot Sale items</a><span class="nav-label hot-label">hot</span></li>
                                    <li class="menu-item"><a href="#" class="link-term">Top new items</a><span class="nav-label hot-label">hot</span></li>
                                    <li class="menu-item"><a href="#" class="link-term">Top Selling</a><span class="nav-label hot-label">hot</span></li>
                                    <li class="menu-item"><a href="#" class="link-term">Top rated items</a><span class="nav-label hot-label">hot</span></li>
                                </ul>
                            </div>
                        </nav>

                        <nav class="primary-nav-section">
                            <div class="container">
                                <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
                                    <li class="menu-item home-icon">
                                        <Link :href="`${this.$page.props.url}`" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></link>
                                    </li>
                                    <li class="menu-item">
                                        <Link :href="`${this.$page.props.url}about-us`" class="link-term mercado-item-title">About</Link>
                                    </li>
                                    <li class="menu-item">
                                        <Link :href="`${this.$page.props.url}shop`" class="link-term mercado-item-title">Shop</Link>
                                    </li>
                                    <li class="menu-item">
                                        <Link :href="`${this.$page.props.url}cart`" class="link-term mercado-item-title">Cart</Link>
                                    </li>
                                    <li class="menu-item">
                                        <Link :href="`${this.$page.props.url}checkout`" class="link-term mercado-item-title">Checkout</Link>
                                    </li>
                                    <li class="menu-item">
                                        <Link :href="`${this.$page.props.url}contact-us`" class="link-term mercado-item-title">Contact Us</Link>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
</template>
<script>
import axios from 'axios';
import AuthSection from './AuthSection';
import Search from './Search';

export default {
    components: {
        AuthSection,
        Search,
    },
    data() {
        return {
            cart: null
        }
    },
    mathods: {
        getCartContent(){

        }
    },
    computed: {

    },
    mounted(){


        axios.get(route('product.cart.json')).then(
            resp => {
                return resp.data
            }
        ).then( data => {
            // console.log(data)
            this.cart = data;
        })
        // this.cart = {data: 23, };
        console.log(this.cart)

    }
}
</script>
