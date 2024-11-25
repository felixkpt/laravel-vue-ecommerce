<template>
<div v-if="show_notification == 1">
        <div v-if="successMessage" class="alert alert-success">
        {{ successMessage }}
    </div>
    <div v-if="info" class="alert alert-info">
        {{ info }}
    </div>
    <div v-if="light" class="alert alert-light">
        {{ light }}
    </div>
    <div v-if="warning" class="alert alert-warning">
        {{ warning }}
    </div>
    <div v-if="danger" class="alert alert-danger">
        {{ danger }}
    </div>
    <div v-if="Object.keys(validationErrors).length > 0" class="alert alert-danger">
        <ul>
            <li v-for="error in validationErrors" :key="error.key">{{ error }}</li>
        </ul>
    </div>
</div>
</template>
<script>
export default {
    methods: {
    },
    computed: {
        successMessage(){
            return this.$page.props.successMessage
        },
        info(){
            return this.$page.props.info
        },
        light(){
            return this.$page.props.light
        },
        warning(){
            return this.$page.props.warning
        },
        danger(){
            return this.$page.props.danger
        },

        validationErrors(){
            return this.$page.props.errors
        },
        show_notification() {
            let current_url = this.$page.props.current_url;
            let suffies = ['/login', '/register'];
            if (current_url.slice(-suffies[0].length) == suffies[0] || current_url.slice(-suffies[1].length) == suffies[1]) {
                return 0;               
            }
            return 1;

        }

    },
    mounted() {
    }
}
</script>
