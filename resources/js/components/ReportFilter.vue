<template>
    <div class="flex flex-col space-y-6 w-full" :class="{
        'opacity-60': component.loading,
    }">
        <h2 class="text-xl font-medium">Reports</h2>

        <form-group label="Search" :errors="component.errors.search">
            <input type="text" class="form-input" v-model.lazy="component.search">
        </form-group>

        <form-group label="Assignee" :errors="component.errors.assignee">
            <select class="form-input" v-model.lazy="component.assignee">
                <option :value="null">Any</option>
                <option :value="user.id" v-for="user in component.users" :key="user.id">{{ user.name }}</option>
            </select>
        </form-group>

        <form-group label="Category" :errors="component.errors.category">
            <select class="form-input" v-model.lazy="component.category">
                <option :value="null">Any</option>
                <option :value="category" v-for="category in component.categories" :key="category">{{ category }}</option>
            </select>
        </form-group>

        <form-group label="Status" :errors="component.errors.status">
            <select class="form-input" v-model.lazy="component.status">
                <option :value="null">Any</option>
                <option :value="code" v-for="(status, code) in component.statuses" :key="code">{{ status.name }}</option>
            </select>
        </form-group>

        <div class="bg-white shadow overflow-hidden sm:rounded-md" v-if="component.reports.length">
            <ul class="divide-y divide-gray-200">
                <li v-for="report in component.reports" :key="report.id">
                    <div @click="component.changeStatus(report.id)">
                        <report :report="report" :status="statuses[report.status].name" :color="statuses[report.status].color" />
                    </div>
                </li>
            </ul>
        </div>

        <div v-else>No reports found.</div>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from '@vue/runtime-core'
import Errors from './Errors.vue'
import FormGroup from './FormGroup.vue'
import Report from './Report.vue'

export default defineComponent({
    props: {
        categories: {
            type: Object as PropType<number[]>,
            required: true,
        },
        statuses: {
            type: Object as PropType<{ [key: string]: { name: string, color: string, code: string } }>,
            required: true,
        }
    },

    components: { Errors, Report, FormGroup },

    data() {
        let storedState = JSON.parse(window.localStorage.getItem('report-filters') ?? '{}');

        return {
            component: this.$airwire.component('report-filter', {
                readonly: {
                    categories: this.categories,
                    statuses: this.statuses,
                },

                ...storedState
            }),
        };
    },

    mounted() {
        this.component.mount().then(data => {
            // Load last filters
            this.component.defer(() => {
                this.component.status = Object.keys(this.statuses)[0];
                this.component.category = this.categories[0];
                this.component.assignee = (Object.values(data.users)[0] as any).id;
            });

            // Commit the changes
            this.component.refresh();
        })

        this.component.watch(response => {
            window.localStorage.setItem('report-filters', JSON.stringify({
                search: response.data.search,
                category: response.data.category,
                assignee: response.data.assignee,
                status: response.data.status,
            }));
        })
    }
})
</script>
