<x-guest-layout>
    <div class="flex sm:justify-center">
        <div class="w-full md:max-w-6xl px-6 py-2 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form class="w-full" action="{{route('search')}}" method="GET">
                <div class="flex flex-wrap items-center">
                    <div class="w-full md:w-1/5 px-3">
                        <x-input-label for="trip-date" :value="__('Trip Date *')" />
                        <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <x-text-input datepicker datepicker-autohide datepicker-format="yyyy/mm/dd" type="text" id="trip-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select Trip Date" name="trip_date" :value="old('trip_date', empty($trip) ? '' : $trip->trip_date)"  required />
                        </div>
                    </div>
                    <div class="w-full md:w-1/5 px-3">
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
                    <div class="w-full md:w-1/5 px-3-3">
                        <x-input-label for="start-from" :value="__('Start From. *')" />
                        <x-select id="start-from" name="start_from" required>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}" {{ old('start_from', empty($trip) ? '' : $trip->start_from) == $location->id ? 'selected' : '' }}>{{$location->place_name}}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('start_from')" class="mt-2" />
                    </div>

                    <!-- End To -->
                    <div class="w-full md:w-1/5 px-3">
                        <x-input-label for="end-to" :value="__('End To *')" />
                        <x-select id="end-to" name="end_to" required>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}" {{ old('end_to', empty($trip) ? '' : $trip->end_to) == $location->id ? 'selected' : '' }}>{{$location->place_name}}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('end_to')" class="mt-2" />
                    </div>
                    <div class="w-full md:w-1/5 px-3">
                        <x-primary-button class="mt-5" type="submt">
                           {{ __('Check Availability') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="flex sm:justify-center mt-10">
        <div class="w-full md:max-w-4xl px-6 py-2 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form class="w-full">
                <div class="flex flex-wrap items-center">
                    <div class="w-full md:w-1/4 px-3">
                        <x-input-label for="trip-date" :value="__('Trip Date *')" />
                        <x-text-input type="text" id="user-nmae" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select Trip Date" name="trip_date" :value="old('trip_date', empty($trip) ? '' : $trip->trip_date)"  required />
                    </div>
                    <div class="w-full md:w-1/4 px-3">
                        <x-input-label for="trip-time" :value="__('Trip Time *')" />
                        <x-text-input type="text" id="user-nmae" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select Trip Date" name="trip_date" :value="old('trip_date', empty($trip) ? '' : $trip->trip_date)"  required />
                        <x-input-error :messages="$errors->get('bus_id')" class="mt-2" />
                    </div>
                    <div class="w-full md:w-1/4 px-3">
                        <x-input-label for="trip-time" :value="__('Trip Time *')" />
                        <x-text-input type="text" id="user-nmae" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select Trip Date" name="trip_date" :value="old('trip_date', empty($trip) ? '' : $trip->trip_date)"  required />
                        <x-input-error :messages="$errors->get('bus_id')" class="mt-2" />
                    </div>
                    <div class="w-full md:w-1/4 px-3">
                        <x-primary-button class="mt-5" type="submt">
                           {{ __('Book Ticket') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>

            <div class="mt-10">
                <p class="text-center">Seat Plan will be here</p>
            </div>
        </div>
    </div>
      
</x-guest-layout>