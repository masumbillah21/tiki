@props([
    'active' => false
])

@php 
    $classes = ($active) 
    ? "text-white bg-gray-800 hover:bg-gray-800 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 focus:outline-none focus:ring-4 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2"
    : "text-white bg-gray-500 hover:bg-gray-800 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 focus:outline-none focus:ring-4 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 mb-2"
@endphp
<a {{ $attributes->merge([
    "href" => "#",
    "class" => $classes,
    ]) }}>
    {{$slot}}
</a>