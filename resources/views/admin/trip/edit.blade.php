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
                        <x-text-input id="trip-date" class="block mt-1 w-full" type="date" name="trip_date" :value="old('trip_date', empty($trip) ? '' : $trip->trip_date)"  required/>
                        <x-input-error :messages="$errors->get('trip_date')" class="mt-2" />
                    </div>

                    <!-- Trip Time -->
                    <div class="mb-3">
                        <x-input-label for="trip-time" :value="__('Trip Time *')" />
                        <x-text-input id="trip-time" class="block mt-1 w-full" type="time" name="trip_time" :value="old('trip_time', empty($trip) ? '' : $trip->trip_time)"  required/>
                        <x-input-error :messages="$errors->get('trip_time')" class="mt-2" />
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
