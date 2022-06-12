<template>
    <div class="wrap-shop-control">
        <h1 class="shop-title">{{ category.name !== undefined ? category.name : 'Products category' }}</h1>
        <div class="wrap-right">
            <div classs="sort-item orderby">
                <div class="d-flex">
                    <div class="col px-2" v-if="loading">
                        <InlineLoader class="ms-auto" styling="background:inherit;font-size:12px;color:#ff7007;" text="" />
                    </div>
                    <div class="col">
                        <select v-model="orderby" @change="orderbyUpdate($event)">
                            <option value="default">Default sorting</option>
                            <option value="date">Sort by newness</option>
                            <option value="price">Sort by price: low to high</option>
                            <option value="price-desc">Sort by price: high to low</option>
                        </select>    
                    </div>
                </div>
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
    import InlineLoader from '@/Components/Shared/InlineLoader'
export default {
    components: {
        InlineLoader,
    },
    props: {
        category: {
            type: Object,
            default: {}
        },
        viewType: {
            type: String
        },
    },
    data() {
      
      return {
        loading: false,
        orderby: this.$page.props.orderby,
        perPage: this.$page.props.perPage,
      }
    },
    methods: {
        shopControls(item) {
            this.loading = true
            setTimeout( () => {
                this.loading = false
            }, 1500)

            let shopControls = JSON.parse(localStorage.getItem('shopControls'))
            if (shopControls) {
                shopControls = {...shopControls, ...item}
            }else {
                shopControls = item
            }

            localStorage.setItem('shopControls', JSON.stringify(shopControls))
            this.$emit('reload')
            
        },
        orderbyUpdate(event) {
            const item = event ? event.target.value : null;
            this.shopControls({orderby: item})
        },
        perPageUpdate(event) {
            const item = event ? event.target.value : null;
            this.shopControls({perPage: item})
        },
        viewTypeUpdate(event) {
            const item = event ? event : null;
            this.shopControls({viewType: item})
            this.$emit('view-type-changed')
        },
    },
     mounted () {
        // console.log(this.perPage)
    }

}
</script>

<style>

</style>