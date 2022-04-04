<template>
    <Head :title="$page.props.title" description="Some desc" />
    <Header :cartUpdated="cartUpdated"/>
    <main>
        <div class="container-fluid px-1" style="min-height: 400px;">
            <div class="row">
                <div class="col-12">
                    <Breadcrumb />
                    <Notification />
                </div>
                <div class="col-12">
                    <slot />
                </div>
            </div>
        </div>
        <Footer />
    </main>
</template>
<script>
import Header from './Header';
import Breadcrumb from './Breadcrumb';
import Notification from './Notification';
import Footer from './Footer';
export default {
    components: {
        Header,
        Breadcrumb,
        Notification,
        Footer,
    },
    props: {
        cartUpdated: {type: Number}
    },
    
}
</script>
