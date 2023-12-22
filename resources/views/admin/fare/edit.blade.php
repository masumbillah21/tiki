<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ empty($fare) ? __('Add Fare') : __('Update Fare')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mb-5">
            <x-link-button :href="route('fare.index')" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Back</x-link-button>
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
                <form action="{{ empty($fare) ? route('fare.store') : route('fare.update', $fare->id) }}" method="POSt">
                    @csrf

                    @if(!empty($fare))
                        @method('PATCH')
                    @endif
                    
                    <!-- Fare Per KM -->
                    <div class="mb-3">
                        <x-input-label for="fare-km" :value="__('Fare Per KM. *')" />
                        <x-text-input id="fare-km" class="block mt-1 w-full" type="number" min="1" step="0.01" name="fare_per_km" :value="old('fare_per_km', empty($fare) ? '' : $fare->fare_per_km)"  required/>
                        <x-input-error :messages="$errors->get('fare_per_km')" class="mt-2" />
                    </div>

                    <!-- Effective Date -->
                    <div class="mb-3">
                        <x-input-label for="effect-from" :value="__('Effect From *')" />
                        <x-text-input id="effect-from" class="block mt-1 w-full" type="text" name="effect_from" :value="old('effect_from', empty($fare) ? '' : $fare->effect_from)"  required/>
                        <x-input-error :messages="$errors->get('effect_from')" class="mt-2" />
                    </div>

                    <x-primary-button type="submt">
                        {{ empty($fare) ? __('Create Fare') : __('Update Fare')}}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
