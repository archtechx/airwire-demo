@props([
    // For how long should a notification be displayed before it's removed.
    'duration' => 1750,
    // Display stored notifications after 150ms, to give the rest of the page time to load, making things feel smoother.
    'loadDelay' => 150,
])

<div
    x-data='{
        messages: {},
        pendingRemovals: {},
        add(message) {
            if (typeof message === "string") {
                message = {
                    title: message,
                    body: "",
                    link: "",
                }
            }
            let indices = Object.keys(this.messages).sort();
            let lastIndex = parseInt(indices[indices.length - 1]) || 0;
            let index = lastIndex + 1;
            this.messages[index] = message;
            this.scheduleRemoval(index);
        },
        scheduleRemoval(messageIndex) {
            // For loops we use integers
            messageIndex = parseInt(messageIndex);
            // Schedule removals for the object and all of the following ones of they dont have a removal scheduled yet.
            for (let i = messageIndex; i >= 0; i--) {
                // For object keys we use strings
                let index = i.toString();
                if (! Object.keys(this.pendingRemovals).includes(index)) {
                    this.pendingRemovals[index] = setTimeout(() => { this.remove(index) }, {!! $duration !!});
                }
            }
        },
        cancelRemoval(messageIndex) {
            // For loops we use integers
            messageIndex = parseInt(messageIndex);
            // When we cancel the removal of a message, we also want to cancel the removal of all
            // messages above it, to prevent the messages from changing position on the screen.
            for (let i = 0; i <= messageIndex; i++) {
                // For object keys we use strings
                let index = i.toString();
                clearTimeout(this.pendingRemovals[index]);
                delete this.pendingRemovals[index];
            }
        },
        remove(messageIndex) {
            delete this.messages[messageIndex];
            delete this.pendingRemovals[messageIndex];
        },
    }'
    x-init="window.notify = (...args) => add(...args)"
    class="
    fixed inset-0 px-4 py-6 pointer-events-none sm:p-6
    flex flex-col {{-- Stack notifications below each other --}}
    items-center justify-start {{-- Mobile: top center --}}
    sm:items-end sm:justify-start {{-- Desktop: top right corner --}}
    space-y-3 {{-- Space between individual notifications --}}
    "
>
    <template x-for="[index, message] of Object.entries(messages)" :key="index" hidden>
        <div
            x-transition:enter="transform ease-out duration-200 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-10"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="max-w-sm w-full bg-white hover:bg-purple-50 shadow rounded-md overflow-hidden pointer-events-auto"
            @mouseenter="cancelRemoval(index)"
            @mouseleave="scheduleRemoval(index)"
        >
            <div class="rounded-lg shadow-xs overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            @svg('heroicon-o-information-circle', ['class' => 'h-6 w-6 text-purple-500'])
                        </div>
                        <template x-if="message.link">
                            <a :href="message.link" class="ml-3 w-0 flex-1 pt-0.5">
                                <p x-text="message.title" class="text-sm leading-5 font-medium text-gray-700"></p>
                                <p x-text="message.body" class="mt-1 text-sm text-gray-500"></p>
                            </a>
                        </template>
                        <template x-if="! message.link">
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p x-text="message.title" class="text-sm leading-5 font-medium text-gray-700"></p>
                                <p x-text="message.body" class="mt-1 text-sm text-gray-500"></p>
                            </div>
                        </template>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button
                                @click="remove(index)"
                                class="rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
                            >
                                <span class="sr-only">Close notification</span>
                                @svg('heroicon-o-x', ['class' => 'h-5 w-5'])
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
