<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ empty($trip) ? __('Add Trip') : __('Update Trip')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mb-5">
            <x-link-button :href="route('trip.index')" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Back</x-link-button>
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
                <form action="{{ empty($trip) ? route('trip.store') : route('trip.update', $trip->id) }}" method="POSt">
                    @csrf

                    @if(!empty($trip))
                        @method('PATCH')
                    @endif
                    
                    <!-- Bus -->
                    <div class="mb-3">
                        <x-input-label for="bus-no" :value="__('Bus No. *')" />
                        <x-select id="bus-no" name="bus_id" required>
                            @foreach($buses as $bus)
                                <option value="{{$bus->id}}" {{ old('bus_id', empty($trip) ? '' : $trip->bus_id) == $bus->id ? 'selected' : '' }}>{{$bus->bus_no}}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('bus_id')" class="mt-2" />
                    </div>

                    <!-- Trip Date -->
                    <div class="mb-3">
                        <x-input-label for="trip-date" :value="__('Trip Date *')" />
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <x-text-input datepicker type="text" id="trip-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" name="trip_date" :value="old('trip_date', empty($trip) ? '' : $trip->trip_date)"  required />
                        </div>
                        <x-input-error :messages="$errors->get('trip_date')" class="mt-2" />
                    </div>


  

                    <!-- Trip Time -->
                    <div class="mb-3">
                        <x-input-label for="trip-time" :value="__('Trip Time *')" />
                        <x-select id="trip-time" name="trip_time" required>
                            <option value="7.00 AM" {{ old('trip_time', empty($trip) ? '' : $trip->trip_time) == '7.00 AM' ? 'selected' : '' }}>7.00 AM</option>
                            <option value="8.00 AM" {{ old('trip_time', empty($trip) ? '' : $trip->trip_time) == '8.00 AM' ? 'selected' : '' }}>8.00 AM</option>
                            <option value="8.00 AM" {{ old('trip_time', empty($trip) ? '' : $trip->trip_time) == '9.00 AM' ? 'selected' : '' }}>9.00 AM</option>
                            <option value="7.00 PM" {{ old('trip_time', empty($trip) ? '' : $trip->trip_time) == '7.00 PM' ? 'selected' : '' }}>7.00 PM</option>
                            <option value="8.00 PM" {{ old('trip_time', empty($trip) ? '' : $trip->trip_time) == '8.00 PM' ? 'selected' : '' }}>8.00 PM</option>
                            <option value="9.00 PM" {{ old('trip_time', empty($trip) ? '' : $trip->trip_time) == '9.00 PM' ? 'selected' : '' }}>9.00 PM</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('bus_id')" class="mt-2" />
                    </div>

                    <!-- Start From -->
                    <div class="mb-3">
                        <x-input-label for="start-from" :value="__('Start From. *')" />
                        <x-select id="start-from" name="start_from" required>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}" {{ old('start_from', empty($trip) ? '' : $trip->start_from) == $location->id ? 'selected' : '' }}>{{$location->place_name}}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('start_from')" class="mt-2" />
                    </div>

                    <!-- End To -->
                    <div class="mb-3">
                        <x-input-label for="end-to" :value="__('End To *')" />
                        <x-select id="end-to" name="end_to" required>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}" {{ old('end_to', empty($trip) ? '' : $trip->end_to) == $location->id ? 'selected' : '' }}>{{$location->place_name}}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('end_to')" class="mt-2" />
                    </div>

                    <x-primary-button type="submt">
                        {{ empty($trip) ? __('Create Trip') : __('Update Trip')}}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
