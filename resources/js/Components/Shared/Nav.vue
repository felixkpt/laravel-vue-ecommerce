<template>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark text-white sticky-md-top" style="z-index: 5;" aria-label="Navbar primary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-primary" aria-controls="navbar-primary" aria-expanded="false" aria-label="Toggle primary navigation">
                <span class="fa fa-align-justify"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar-primary">
                <ul class="navbar-nav me-auto mb-2 mb-md-0" id="mercado_main" data-menuname="Main menu" >
                    <li class="nav-item">
                        <Link :href="`${this.$page.props.url}`" class="nav-link"><i class="fa fa-home" aria-hidden="true"></i></Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="`${this.$page.props.url}about-us`" class="nav-link">About</Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="`${this.$page.props.url}shop`" class="nav-link">Shop</Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="`${this.$page.props.url}cart`" class="nav-link">Cart</Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="`${this.$page.props.url}checkout`" class="nav-link">Checkout</Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="`${this.$page.props.url}contact-us`" class="nav-link">Contact Us</Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
 
</template>
<script>

</script>

<style scoped>
.nav-link{
color: white!important;;
}
</style>