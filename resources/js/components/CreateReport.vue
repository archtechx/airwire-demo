<template>
    <form class="flex flex-col space-y-6 w-full" @submit.prevent="submit" :class="{
        'opacity-60': component.loading,
    }">
        <h2 class="text-xl font-medium">Create Report</h2>

        <form-group label="Assignee" :errors="component.errors.assignee">
            <select class="form-input" v-model.lazy="component.assignee">
                <option :value="user.id" v-for="user in component.users" :key="user.id">{{ user.name }}</option>
            </select>
        </form-group>

        <form-group label="Name" :errors="component.errors.name">
            <input type="text" class="form-input" v-model.lazy="component.name">
        </form-group>

        <form-group label="Category" :errors="component.errors.category">
            <select class="form-input" v-model.lazy="component.category">
                <option :value="category" v-for="category in categories" :key="category">{{ category }}</option>
            </select>
        </form-group>

        <button type="submit" class="bg-blue-500 text-blue-50 px-2 py-1.5 shadow rounded">Create Report</button>
    </form>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import Errors from './Errors.vue'
import FormGroup from './FormGroup.vue'
export default defineComponent({
    props: {
        categories: {
            type: Object as PropType<number[]>,
            required: true,
        },
    },

    components: { Errors, FormGroup },

    data() {
        return {
            component: this.$airwire.component('create-report', {
                name: 'Report ...',
            }),
        }
    },

    mounted() {
        this.component.mount().then(data => {
            this.component.defer(() => {
                this.component.category = this.categories[0];
                this.component.assignee = (Object.values(data.users)[0] as any).id as number;
            });
        })
    },

    methods: {
        submit() {
            this.component.create().then(_ => {
                window.Airwire.remount(['report-filter']);
            });
        }
    }
})
</script>
