<template>
    <Head :title="$page.props.title" description="Some desc" />

    <Header />
    
    <main :id="mainKey">
        <div class="container-fluid px-1 pt-2" style="min-height: 400px;">
            <div class="row">
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
import Footer from './Footer';
export default {
    components: {
        Header,
        Footer,
    },
    data() {
        return {
            mainKey: (Math.random() * 1000000)
        }
    }

}
</script>
