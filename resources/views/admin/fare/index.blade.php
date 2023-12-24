<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fares') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <x-link-button :href="route('fare.create')" active="true">Add New</x-link-button>
        </div>
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
                                    Base Location
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Start From
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Destination
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fare Amount
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Effective Date
                                </th>
                                
                                <th scope="col" class="px-6 py-3">
                                    Created At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fares as $fare)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $fare->baseLocation->place_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $fare->startFrom->place_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $fare->destinationLocation->place_name }}
                                </td>
                                <td class="px-6 py-4">
                                    Tk. {{ $fare->fare_amt }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $fare->effect_from }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($fare->created_at)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <x-link-button :href="route('fare.edit', $fare->id)" active="true">Edit</x-link-button>
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
