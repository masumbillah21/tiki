<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <x-link-button :href="route('bus.create')" active="true">Add New</x-link-button>
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
                                    Bus No.
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Supervisor Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Supervisor Phone Numbe
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
                            @foreach($buses as $bus)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $bus->bus_no }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $bus->supervisor_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $bus->supervisor_number }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($bus->created_at)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <x-link-button :href="route('bus.edit', $bus->id)" active="true">Edit</x-link-button>
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
