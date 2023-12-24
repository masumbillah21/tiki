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
                            <x-text-input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text" id="trip-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select Trip Date" name="trip_date" :value="old('trip_date', empty($search) ? date('Y-m-d') : $search->trip_date)"  required />
                        </div>
                    </div>
                    <div class="w-full md:w-1/5 px-3">
                        <x-input-label for="trip-time" :value="__('Trip Time *')" />
                        <x-select id="trip-time" name="trip_time" required>
                            <option value="7.00 AM" {{ old('trip_time', empty($search) ? '' : $search->trip_time) == '7.00 AM' ? 'selected' : '' }}>7.00 AM</option>
                            <option value="8.00 AM" {{ old('trip_time', empty($search) ? '' : $search->trip_time) == '8.00 AM' ? 'selected' : '' }}>8.00 AM</option>
                            <option value="8.00 AM" {{ old('trip_time', empty($search) ? '' : $search->trip_time) == '9.00 AM' ? 'selected' : '' }}>9.00 AM</option>
                            <option value="7.00 PM" {{ old('trip_time', empty($search) ? '' : $search->trip_time) == '7.00 PM' ? 'selected' : '' }}>7.00 PM</option>
                            <option value="8.00 PM" {{ old('trip_time', empty($search) ? '' : $search->trip_time) == '8.00 PM' ? 'selected' : '' }}>8.00 PM</option>
                            <option value="9.00 PM" {{ old('trip_time', empty($search) ? '' : $search->trip_time) == '9.00 PM' ? 'selected' : '' }}>9.00 PM</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('trip_time')" class="mt-2" />
                    </div>
                    <!-- Start From -->
                    <div class="w-full md:w-1/5 px-3-3">
                        <x-input-label for="start-from" :value="__('Start From. *')" />
                        <x-select id="start-from" name="start_from" required>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}" {{ old('start_from', empty($search) ? '' : $search->start_from) == $location->id ? 'selected' : '' }}>{{$location->place_name}}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('start_from')" class="mt-2" />
                    </div>

                    <!-- End To -->
                    <div class="w-full md:w-1/5 px-3">
                        <x-input-label for="end-to" :value="__('End To *')" />
                        <x-select id="end-to" name="end_to" required>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}" {{ old('end_to', empty($search) ? '' : $search->end_to) == $location->id ? 'selected' : '' }}>{{$location->place_name}}</option>
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


    <!-- Visible if Availabile -->
    @if(isset($trip))
    <div class="flex sm:justify-center mt-10">
        <div class="w-full md:max-w-4xl px-6 py-2 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @if(isset($trip->message))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <p class="text-center text-3xl font-bold"><span class="font-extrabold">Info: </span> {{ $trip->message }}</p>
                </div>
            @else

            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                <p class="text-center text-3xl font-bold"><span class="font-extrabold">Route: </span> {{ $trip->startLocation->place_name }} = TO = {{ $trip->endLocation->place_name }}</p>
            </div>
            
            
            @if(Session::has('success'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-bold">Info: </span> {{ Session::get('success') }}
                </div>
            @elseif(Session::has('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-bold">Info: </span> {{ Session::get('error') }}
                </div>
            @endif
            
            <form action="{{route('book.store')}}" method="POST">
                @csrf
                <x-text-input type="hidden" name="trip_id" :value="$trip->id" />
                <x-text-input type="hidden" name="trip_from" :value="$fare->start_from" />
                <x-text-input type="hidden" name="trip_to" :value="$fare->destination" />
                <x-text-input type="hidden" name="fare_per_seat" :value="$fare->fare_amt" />

                @php 
                    $seatGroup = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
                @endphp
                @auth
                    <div class="text-center mt-10">
                        <x-primary-button type="submt">
                            {{__('Book Your Seat')}}
                        </x-primary-button>
                    </div>
                @else 
                <div class="text-center mt-10">
                    <x-primary-button type="submt">
                        {{__('Login To Book Your Seat')}}
                    </x-primary-button>
                </div>
                @endauth
                <div class="checkbox-group required">
                    <div class="mt-10">
                        <div class="relative overflow-x-auto">
                            <table class="w-full border-collapse border border-slate-400 text-sm text-center text-gray-500 dark:text-gray-400">
                                <tbody>
                                    @foreach($seatGroup as $group)
                                        <tr>
                                            <td scope="row" class="w-52 py-3 border border-slate-300">
                                                @if(in_array($group.'1', $seatArray))
                                                    <strong class="text-green-900 uppercase">Booked</strong>
                                                @else
                                                <x-input-label :for="$group.'1'" :value="__($group.'1')"/>
                                                <x-text-input :id="$group.'1'" type="checkbox" name="seat_no[]" :value="$group.'1'"/>
                                                @endif
                                            </td>
                                            <td class="w-52 py-3 border border-slate-300">
                                                @if(in_array($group.'2', $seatArray))
                                                    <strong class="text-green-900 uppercase">Booked</strong>
                                                @else
                                                    <x-input-label :for="$group.'2'" :value="__($group.'2')"/>
                                                    <x-text-input :id="$group.'2'" type="checkbox" name="seat_no[]" :value="$group.'2'"/>
                                                @endif
                                            </td>
                                            <td class="w-28 py-3"></td>
                                            <td class="w-52 py-3 border border-slate-300">
                                                @if(in_array($group.'3', $seatArray))
                                                    <span class="text-green-900 text-xs uppercase">Booked</span>
                                                @else
                                                    <x-input-label :for="$group.'3'" :value="__($group.'3')"/>
                                                    <x-text-input :id="$group.'3'" type="checkbox" name="seat_no[]" :value="$group.'3'"/>
                                                @endif
                                            </td>
                                            <td class="w-52 py-3 border border-slate-300">
                                                @if(in_array($group.'4', $seatArray))
                                                    <span class="text-green-900 text-xs uppercase">Booked</span>
                                                @else
                                                    <x-input-label :for="$group.'4'" :value="__($group.'4')"/>
                                                    <x-text-input :id="$group.'4'" type="checkbox" name="seat_no[]" :value="$group.'4'"/>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @php 
                    $seatGroup = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
                @endphp
                @auth
                    <div class="text-center mt-10">
                        <x-primary-button type="submt">
                            {{__('Book Your Seat')}}
                        </x-primary-button>
                    </div>
                @else 
                    <div class="text-center mt-10">
                        <x-primary-button type="submt">
                            {{__('Login To Book Your Seat')}}
                        </x-primary-button>
                    </div>
                @endauth
            </form>
            @endif
        </div>
    </div>
    @endif;
      
</x-guest-layout>