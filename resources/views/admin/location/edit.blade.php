<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ empty($location) ? __('Add Location') : __('Update Location')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mb-5">
            <x-link-button :href="route('location.index')" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Back</x-link-button>
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
                <form action="{{ empty($location) ? route('location.store') : route('location.update', $location->id) }}" method="POSt" enctype="multipart/form-data">
                    @csrf

                    @if(!empty($location))
                        @method('PATCH')
                        <!-- <input name="_method" type="hidden" value="PATCH"> -->
                        <x-text-input type="hidden" name="location_id"  value="{{ $location->id }}" />
                    @endif
                    
                    <!-- Location Name -->
                    <div class="mb-3">
                        <x-input-label for="place-name" :value="__('Place Name *')" />
                        <x-text-input id="place-name" class="block mt-1 w-full" type="text" name="place_name" :value="old('place_name', empty($location) ? '' : $location->place_name)"  required/>
                        <x-input-error :messages="$errors->get('place_name')" class="mt-2" />
                    </div>

                    <!-- Location Distance -->
                    <div class="mb-3">
                        <x-input-label for="distance-km" :value="__('Distance in KM *')" />
                        <x-text-input id="distance-km" class="block mt-1 w-full" type="number" step="0.01" min="0" name="distance_km" :value="old('distance_km', empty($location) ? '' : $location->distance_km)"  required/>
                        <x-input-error :messages="$errors->get('distance_km')" class="mt-2" />
                    </div>

                    <!-- Location Distance -->
                    <div class="mb-3">
                        <x-input-label for="stopage-order" :value="__('Stopage Order *')" />
                        <x-text-input id="stopage-order" class="block mt-1 w-full" type="number" min="1" name="stopage_order" :value="old('stopage_order', empty($location) ? '' : $location->stopage_order)"  required/>
                        <x-input-error :messages="$errors->get('stopage_order')" class="mt-2" />
                    </div>

                    <x-primary-button type="submt">
                        {{ empty($location) ? __('Create Location') : __('Update Location')}}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
