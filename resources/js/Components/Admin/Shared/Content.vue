<template>
    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <Notification />
    <slot />
    </div>
</template>
<script>

import Notification from './Notification';

export default {
    components: {
      Notification,
    }
}
</script>
