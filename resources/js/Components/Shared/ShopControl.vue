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
                <a href="#grid" @click.prevent="viewTypeUpdate('grid')" class="grid-mode display-mode" :class="`${viewType == 'grid' && 'active'}`"><i class="fa fa-th"></i>Grid</a>
                <a href="#list" @click.prevent="viewTypeUpdate('list')" class="list-mode display-mode" :class="`${viewType == 'list' && 'active'}`"><i class="fa fa-th-list"></i>List</a>
            </div>
        </div>
    </div><!--end wrap shop control-->
</template>

<script>
export default {

    props: {
        category: {
            type: Object,
            default: {}
        }
    },
    data() {
      
      return {
        orderby: this.$page.props.orderby,
        perPage: this.$page.props.perPage,
        viewType: this.$page.props.viewType,
      }
    },
    methods: {
        async orderbyUpdate(event, get = false) {
                let orderby = event ? event.target.value : null;
                await axios.post(`${this.$page.props.url}shop/orderby`, {orderby: orderby, get: get})
                    .then(() => {
                            this.$inertia.reload()
                    }).catch(() => {
                        alert('Whoops! But there was an error.');
                    });
            },
        async perPageUpdate(event, get = false) {
            let perPage =  event ? event.target.value : null;
            await axios.post(`${this.$page.props.url}shop/per-page`, {perPage: perPage, get: get})
                .then(() => {
                        this.$inertia.reload()
                }).catch((err) => {
                    console.log(err)
                    alert('Whoops! But there was an error.');
                });
        },
        async viewTypeUpdate(event, get = false) {
            let viewType =  event ? event : null;
            await axios.post(`${this.$page.props.url}shop/viewType`, {viewType: viewType, get: get})
                .then(() => {
                        this.$inertia.reload();
                }).catch((err) => {
                    console.log(err)
                    alert('Whoops! But there was an error.');
                });
        },
    },
     mounted () {
        console.log(this.perPage)
    }

}
</script>

<style>

</style>