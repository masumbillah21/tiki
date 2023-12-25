<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    SL
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Trip Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Trip Time
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    From
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Destination
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Seat(s) No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fare
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Booking Time
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trips as $trip)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($trip->trip->trip_date)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $trip->trip->trip_time }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $trip->tripFrom->place_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $trip->tripTo->place_name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ implode(', ', $trip->seat_no ) }}
                                </td>
                                <td class="px-6 py-4">
                                    Tk. {{ number_format($trip->total_fare, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($trip->created_at)->format('d M Y, h:s A') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
