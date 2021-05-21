<template>
    <ul class="flex flex-col list-style-none gap-2 text-red-400 text-sm font-bold">
        <li v-for="error in errors" :key="error">{{ error }}</li>
    </ul>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    props: ['errors'],
})
</script>
