<template>
    <footer id="footer" class="bg-dark text-white my-2">
        <div class="container-fluid px-2">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-danger">Quick Shoppers</h4>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <h5 class="text-info">On Sale</h5>
                    <div class="row">
                        <div class="col">
                            <ul class="list-unstyled">
                                <li v-for="product in popular" :key="product.id"><a class="text-white-50 text-decoration-none" :href="`${$page.props.url}product/${product.slug}`" :title="product.name">{{ product.name }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <h5 class="text-info">Important Links</h5>
                    <div class="row">
                        <div class="col">
                            <ul class="list-unstyled">
                                <li><a class="text-white-50 text-decoration-none" :href="`${$page.props.url}about-us`">About us</a></li>
                                <li><a class="text-white-50 text-decoration-none" href="#contact-us">Contact us</a></li>
                                <li><a class="text-white-50 text-decoration-none" href="#privacy-policy">Privacy policy</a></li>
                                <li><a class="text-white-50 text-decoration-none" href="#terms-and-conditions">Terms &amp; Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <h5 class="text-info">Get in touch with us</h5>
                    <div class="row">
                        <div class="col">
                            <ul class="list-unstyled">
                                <li><a class="text-decoration-none fs-s text-white-50" href="https://facebook.com/onlineserviceslab" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i> Facebook</a></li>
                                <li><a class="text-decoration-none fs-s text-white-50" href="https://twitter.com/onlineserviceslab" target="_blank"><span class="fa fa-twitter-square"></span> Twitter</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <h5 class="text-info">Suggestions</h5>
                    <div class="row">
                        <div class="col">
                            <a href="https://legalpremiums.com/companies/state-farm-car-insurance" class="text-decoration-none text-muted">
                                State Farm's low complaint rate and extremely competitive vehicle insurance premiums make it worthwhile to investigate.AdvantagesPeople who have had an accident or received a speeding ticket have terrible rates. (USAA is a little less expensive, but only military families and veterans are...
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
export default {

    data() {
        return {
            popular: null,
        }
    },
    methods: {
        async getPopular() {
            const resp = await axios.get(`${this.$page.props.url}api/products/popular`)
            if (resp.status == 200) {
                const data = await resp.data
                this.popular = data.reverse()
            }
        },
    },
    mounted() {
        this.getPopular()
    },
}
</script>
