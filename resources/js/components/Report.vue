<template>
    <a href="#" class="block hover:bg-gray-50">
        <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-indigo-600 truncate">
                    {{ report.name }}
                </p>
                <div class="ml-2 flex-shrink-0 flex">
                    <p :class="`px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-${color}-100 text-${color}-800`">
                        {{ status }}
                    </p>
                </div>
            </div>
            <div class="mt-2 sm:flex sm:justify-between">
                <div class="sm:flex">
                    <p class="flex items-center text-sm text-gray-500">
                        <UsersIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                        {{ report.assignee.name }}
                    </p>
                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                        <LocationMarkerIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                        {{ report.category }}
                    </p>
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                    <CalendarIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                    <p>
                        Reported on
                        {{ ' ' }}
                        {{ report.created_at }}
                    </p>
                </div>
            </div>
        </div>
    </a>
</template>

<script lang="ts">
import { CalendarIcon, LocationMarkerIcon, UsersIcon } from '@heroicons/vue/solid'
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    components: { CalendarIcon, LocationMarkerIcon, UsersIcon },

    props: {
        report: {
            type: Object as PropType<Report>,
            required: true,
        },

        status: {
            type: String,
            required: true,
        },

        color: {
            type: String,
            required: true,
        },
    }
})
</script>
