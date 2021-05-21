<template>
    <form class="flex flex-col space-y-6 w-full" @submit.prevent="submit" :class="{
        'opacity-60': component.loading,
    }">
        <h2 class="text-xl font-medium">Create User</h2>

        <form-group label="Name" :errors="component.errors.name">
            <input type="text" class="form-input" v-model.lazy="component.deferred.name">
        </form-group>

        <form-group label="Email" :errors="component.errors.email">
            <input type="email" class="form-input" v-model.lazy="component.deferred.email">
        </form-group>

        <form-group label="Password" :errors="component.errors.password">
            <input type="password" class="form-input" v-model.lazy="component.deferred.password">
        </form-group>

        <form-group label="Confirm password" :errors="component.errors.password_confirmation">
            <input type="password" class="form-input" v-model.lazy="component.deferred.password_confirmation">
        </form-group>

        <button type="submit" class="bg-blue-500 text-blue-50 px-2 py-1.5 shadow rounded">Create User</button>
    </form>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import Errors from './Errors.vue'
import FormGroup from './FormGroup.vue'
export default defineComponent({
    components: { Errors, FormGroup },

    data() {
        return {
            component: this.$airwire.component('create-user', {
                name: 'John Doe',
            }),
        }
    },

    methods: {
        submit() {
            this.component.create().then(_ => {
                window.Airwire.remount(['report-filter', 'create-report']);
            });
        }
    }
})
</script>
