<template>
    <div class="wrap-search center-section w-100 text-center">
        <div class="wrap-search-form">
            <form :action="`${$page.props.url}search`" id="form-search-top" name="form-search-top">
                <input type="text" name="search" value="" placeholder="Search...">
                <button form="form-search-top" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                <div class="wrap-list-cate">
                    <input type="hidden" name="product_cat" :value="product_cat" id="product-cate">
                    <input type="hidden" name="product_cat_id" :value="product_cat_id" id="product-cate-id">
                    <a href="#" class="link-control text-muted">Product nam...</a>
                    <ul class="list-cate">
                        <li class="level-0">All Category</li>
                        <li class="level-1" :data-id="category.id" v-for="category in categories" :key="category.id">{{  category.name }}</li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
      return {
          categories: null

      }
    },
    methods: {

    },
    mounted() {

            axios.post(route('product.search')).then(
                (resp) => {
                    return resp.data;
                }
            ).then( data => {
                this.categories = data;
            }).catch(
                (error) => {
                    console.log('error: ', error)
                }
            )

    }
}
</script>
