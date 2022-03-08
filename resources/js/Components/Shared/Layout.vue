<template>
    <Head title="Welcome --- up" description="Some desc" />

    <Header />

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

}
</script>
