<template>
    <div class="wrap-search center-section w-100">
        <div class="wrap-search-form">
            <form
                :action="`${$page.props.url}search`"
                id="form-search-top"
                name="form-search-top"
            >
                <input
                    type="text"
                    name="search"
                    value=""
                    placeholder="Search..."
                />
                <button form="form-search-top" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
                <div class="wrap-list-cate">
                    <input
                        type="hidden"
                        name="product_cat"
                        :value="product_cat"
                        id="product-cate"
                    />
                    <input
                        type="hidden"
                        name="product_cat_id"
                        :value="product_cat_id"
                        id="product-cate-id"
                    />
                    <a href="#" class="link-control">Product nam...</a>
                    <ul class="list-cate">
                        <li
                            class="level-0"
                            @click="selectCategory(null, 'All Category')"
                        >
                            All Category
                        </li>
                        <li
                            class="level-1"
                            v-for="category in categories"
                            :key="category.id"
                            :data-id="category.id"
                            @click="selectCategory(category.id, category.name)"
                        >
                            {{ category.name }}
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            product_cat: "All Category", // Default category
            product_cat_id: null, // Default category ID
            categories: [], // Category list
        };
    },
    methods: {
        selectCategory(id, name) {
            this.product_cat_id = id;
            this.product_cat = name;
        },
    },
    mounted() {
        axios
            .get(route("categories.list"))
            .then((resp) => resp.data)
            .then((data) => {
                this.categories = data;
            })
            .catch((error) => {
                console.log("error: ", error);
            });
    },
};
</script>
