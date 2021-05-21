<template>
    <label class="flex flex-col space-y-1" :key="label">
        <span class="text-sm font-semibold text-gray-600">{{ label }}</span>
        <slot />
        <errors :errors="errors" :key="label" />
    </label>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import Errors from './Errors.vue'
export default defineComponent({
  components: { Errors },
    props: ['label', 'errors']
})
</script>
