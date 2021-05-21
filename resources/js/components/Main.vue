<template>
    <div class="flex space-x-16 p-8 w-3/4 mx-auto">

        <div class="w-2/3">
            <report-filter :categories="categories" :statuses="statuses" />
        </div>
        <div class="w-1/3 flex flex-col">
            <create-report :categories="categories" />
            <div class="my-6"></div>
            <create-user />
        </div>

        <notification />
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import CreateReport from './CreateReport.vue'
import CreateUser from './CreateUser.vue'
import Notification from './Notification.vue'
import ReportFilter from './ReportFilter.vue'

export default defineComponent({
    components: { CreateReport, Notification, ReportFilter, CreateUser },

    data: _ => ({
        categories: [1, 2, 3],
        statuses: {
            pending: {
                code: 'pending',
                name: 'Pending',
                color: 'yellow', // bg-yellow-100 text-yellow-800
            },
            resolved: {
                code: 'resolved',
                name: 'Resolved',
                color: 'green', // bg-green-100 text-green-800
            },
            invalid: {
                code: 'invalid',
                name: 'Invalid',
                color: 'gray', // bg-gray-100 text-gray-800
            },
        }
    })
})
</script>
