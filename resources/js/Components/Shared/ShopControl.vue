<template>
    <div class="wrap-shop-control">
        <h1 class="shop-title">{{ category.name !== undefined ? category.name : 'Products category' }}</h1>
        <div class="wrap-right">
            <div classs="sort-item orderby">
                <select v-model="orderby" @change="orderbyUpdate($event)">
                    <option value="default">Default sorting</option>
                    <option value="date">Sort by newness</option>
                    <option value="price">Sort by price: low to high</option>
                    <option value="price-desc">Sort by price: high to low</option>
                </select>
            </div>
            <div class="sort-item product-per-page">
                <select v-model="perPage" @change="perPageUpdate($event)">
                    <option value="15">Per Page</option>
                    <option value="4">4 per page</option>
                    <option value="12">12 per page</option>
                    <option value="24">24 per page</option>
                    <option value="36">36 per page</option>
                    <option value="48">48 per page</option>
                </select>
            </div>
            <div class="change-display-mode">
                <a href="#grid" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                <a href="#list" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
            </div>
        </div>
    </div><!--end wrap shop control-->
</template>

<script>
export default {

    props: {
        orderby: {
                type: String,
                default: 'default'
            },
        perPage: {
            type: Number,
            default: 15
        },
        category: {
            type: Object,
            default: {}
        }
    },
    methods: {
        async orderbyUpdate(event, get = false) {
                let orderby = event ? event.target.value : null;
                await axios.post(`${this.$page.props.url}shop/orderby`, {orderby: orderby, get: get})
                    .then((resp) => {
                            this.$inertia.reload()
                    }).catch(() => {
                        alert('Whoops! But there was an error.');
                    });
            },
        async perPageUpdate(event, get = false) {
            let perPage =  event ? event.target.value : null;
            await axios.post(`${this.$page.props.url}shop/per-page`, {perPage: perPage, get: get})
                .then((resp) => {
                        this.$inertia.visit('shop');
                }).catch((err) => {
                    console.log(err)
                    alert('Whoops! But there was an error.');
                });
        },
    },
     mounted () {
        // console.log(this.category.name, this.category.name == undefined)
    }

}
</script>

<style>

</style>