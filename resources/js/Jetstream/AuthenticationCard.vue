<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-100 mt-2 px-2 py-1 shadow-md rounded-lg">
            <slot />
        </div>
    </div>
</template>
