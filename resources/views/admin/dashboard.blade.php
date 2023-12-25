<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6 text-gray-900">
                    <div class="flex mb-4">
                        <x-sales-summary title="Today Sales" :sales="number_format($today, 2)"/>
                        <x-sales-summary title="Yesterday Sales" :sales="number_format($yesterday, 2)"/>
                        <x-sales-summary title="This Month Sales" :sales="number_format($thisMonth, 2)"/>
                        <x-sales-summary title="Last Month Sales" :sales="number_format($lastMonth, 2)"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>