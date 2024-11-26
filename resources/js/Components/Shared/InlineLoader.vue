<template>
    <div style="display:inline" :style="styling" class="fw-b col-12 rounded py-0 mb-1">
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        {{ text }}
    </div>
</template>
<script>
export default {
    props: {
        text: {
            type: String,
            default: 'Loading...',
        },
        styling: {
            type: String,
            default: 'background:#F5F6F7',
        }
    }
}
</script>