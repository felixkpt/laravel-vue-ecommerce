<template>
<hr class="border-bottom">
    <div class="mt-2 d-flex justify-content-center">
        
        <nav>
            <ul class="pagination flex-wrap">
                <!-- Prev Links -->
                <li :class="{'page-item': true, 'disabled': links.current_page == 1}" :aria-disabled="links.current_page == 1 ? true : false" aria-label="« Previous">
                    <span v-if="links.current_page == 1" class="page-link" :aria-hidden="links.current_page == 1 ? true : false">‹‹</span>
                    <a v-else class="page-link" :href="links.first_page_url" rel="first" aria-label="« First">‹‹</a>
                </li>
                <!-- Numbered Links -->
                <li v-for="(link, key) in links.links" 
                :class="{'page-item': true, 'active': key + 1 == links.current_page}" 
                :aria-current="key + 1 == links.current_page ? 'page' : 'false'" 
                :key="key">
                    <a class="page-link" :href="link.url">
                        <span class="active" v-if="key + 1 == links.current_page" v-html="link.label"></span>
                        <span v-else v-html="link.label"></span>
                    </a>
                </li>
                <!-- Next Links -->
                <li :class="{'page-item': true, 'disabled': links.current_page == links.last_page}" :aria-disabled="links.current_page == links.last_page ? true : false">
                    <span v-if="links.current_page == links.last_page" class="page-link" :aria-hidden="links.current_page == links.last_page ? true : false">›</span>
                    <a v-else class="page-link" :href="links.last_page_url" rel="last" aria-label="Last »">››</a>
                </li>
            </ul>
       </nav>
    </div>
</template>
<script>
export default {
    props: ['links'],
    mounted() {
    // console.log(this.links.current_page, '<====>',this.links.links)
    } 
}
</script>
