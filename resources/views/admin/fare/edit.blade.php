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
                    <!-- Base Location -->
                    <div class="mb-3">
                        <x-input-label for="base-location" :value="__('Base Location *')" />
                        <x-select id="base-location" name="base_location" required>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}" {{ old('base_location', empty($fare) ? '' : $fare->base_location) == $location->id ? 'selected' : '' }}>{{$location->place_name}}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('base_location')" class="mt-2" />
                    </div>

                    <!-- Start From -->
                    <div class="mb-3">
                        <x-input-label for="start-from" :value="__('Start From. *')" />
                        <x-select id="start-from" name="start_from" required>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}" {{ old('start_from', empty($fare) ? '' : $fare->start_from) == $location->id ? 'selected' : '' }}>{{$location->place_name}}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('start_from')" class="mt-2" />
                    </div>

                    <!-- Destination -->
                    <div class="mb-3">
                        <x-input-label for="destination" :value="__('Destination *')" />
                        <x-select id="destination" name="destination" required>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}" {{ old('destination', empty($fare) ? '' : $fare->destination) == $location->id ? 'selected' : '' }}>{{$location->place_name}}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('destination')" class="mt-2" />
                    </div>
                    
                    <!-- Fare Amt -->
                    <div class="mb-3">
                        <x-input-label for="fare-amt" :value="__('Fare Amount *')" />
                        <x-text-input id="fare-amt" class="block mt-1 w-full" type="number" min="1" step="0.01" name="fare_amt" :value="old('fare_amt', empty($fare) ? '' : $fare->fare_amt)"  required/>
                        <x-input-error :messages="$errors->get('fare_amt')" class="mt-2" />
                    </div>

                    <!-- Effective Date -->
                    <div class="mb-3">
                        <x-input-label for="effect-from" :value="__('Effect From *')" />
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <x-text-input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd"  id="effect-from" class="block mt-1 w-full ps-10" type="text" name="effect_from" :value="old('effect_from', empty($fare) ? date('Y-m-d') : $fare->effect_from)"  required/>
                        </div>
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
