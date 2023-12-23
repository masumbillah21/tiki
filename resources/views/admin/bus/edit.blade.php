<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ empty($fare) ? __('Add Bus') : __('Update Bus')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mb-5">
            <x-link-button :href="route('bus.index')" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Back</x-link-button>
        </div>
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
           
            @if(Session::has('success'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-bold">Info: </span> {{ Session::get('success') }}
                </div>
            @elseif(Session::has('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-bold">Info: </span> {{ Session::get('error') }}
                </div>
            @endif
            
            <div class="bg-white overflow-hidden p-11 shadow-sm sm:rounded-lg">
                <form action="{{ empty($bus) ? route('bus.store') : route('bus.update', $bus->id) }}" method="POSt">
                    @csrf

                    @if(!empty($bus))
                        @method('PATCH')
                    @endif
                    
                    <!-- Bus No -->
                    <div class="mb-3">
                        <x-input-label for="bus-no" :value="__('Bus No. *')" />
                        <x-text-input id="bus-no" class="block mt-1 w-full" type="text" name="bus_no" :value="old('bus_no', empty($bus) ? '' : $bus->bus_no)"  required/>
                        <x-input-error :messages="$errors->get('bus_no')" class="mt-2" />
                    </div>

                    <!-- supervisor name -->
                    <div class="mb-3">
                        <x-input-label for="supervisor-name" :value="__('Supervisor Name *')" />
                        <x-text-input id="supervisor-name" class="block mt-1 w-full" type="text" name="supervisor_name" :value="old('supervisor_name', empty($bus) ? '' : $bus->supervisor_name)"  required/>
                        <x-input-error :messages="$errors->get('supervisor_name')" class="mt-2" />
                    </div>

                    <!-- supervisor number -->
                    <div class="mb-3">
                        <x-input-label for="supervisor-number" :value="__('Supervisor Number *')" />
                        <x-text-input id="supervisor-number" class="block mt-1 w-full" type="tel" minlength="11" maxlength="11" name="supervisor_number" :value="old('supervisor_number', empty($bus) ? '' : $bus->supervisor_number)"  required/>
                        <x-input-error :messages="$errors->get('supervisor_number')" class="mt-2" />
                    </div>

                    <x-primary-button type="submt">
                        {{ empty($bus) ? __('Create Bus') : __('Update Bus')}}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
