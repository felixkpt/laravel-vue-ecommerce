<template>
        <!--header-->
    <header class="mb-2 border-bottom">
      <nav class="navbar navbar-expand-sm navbar-light bg-light" aria-label="Third navbar example">
        <div class="container-fluid px-0">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                  <a title="Hotline: (+254) 712730908" href="#" class="nav-link ps-1"><span class="fa fa-mobile text-danger"></span> Hotline: (+254) 726021426</a>
              </li>
          </ul>
          <ul class="navbar-nav mb-2 mb-sm-0">
              <AuthSection />
              <li class="nav-item dropdown">
                  <a title="English" class="nav-link dropdown-toggle" href="#" id="dropdown-language" data-bs-toggle="dropdown" aria-expanded="false">
                  <span><img :src="`${$page.props.asset}uploads/images/lang-en.png`" alt="lang-en"></span>English
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdown-language">
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
                  <ul class="dropdown-menu" aria-labelledby="dropdown-curreny">
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
      </nav>
      <div class="container-fluid px-0">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-1">
          <a :href="`${$page.props.url}`" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-decoration-none">
              <h3 class="text-danger ps-2">Quick Shoppers</h3>
          </a>
          <div class="col-12 col-lg-6 mb-2 mb-md-0 me-lg-3">
          <div class="d-flex justify-content-center">
              <Search />
          </div>
          </div>
          
          <div class="text-end">
              <div class="d-flex">
                <ul class="nav ms-auto me-1">
                    <li class="nav-item">
                        <a class="nav-link text-white bg-dark d-flex flex-nowrap" href="#">
                            <i class="fa fa-heart fs-5" aria-hidden="true"></i>
                            <div class="d-inline-block">
                                <span class="index px-1">0 items</span>
                                <span class="title"> Wishlist</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <Link :href="route('product.cart')" class="nav-link text-white bg-danger d-flex flex-nowrap">
                            <i class="fa fa-shopping-cart fs-5" aria-hidden="true"></i>
                            <div class="left-info" v-if="cart">
                                <span class="index px-1"> {{ cart.count }} item<span v-if="cart.count > 1">s</span></span>
                                <span class="title">CART</span>
                            </div>
                        </Link>
                    </li>
                </ul>
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

export default {
    components: {
        Nav,
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
