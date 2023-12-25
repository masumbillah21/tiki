@props(
    ['title' => 'Today', 'sales' => '0']
)

<div class="flex-1 mx-2">
    <div class="bg-white max-w-sm rounded overflow-hidden shadow-sm">
        <div class="px-6 py-4">
          <div class="font-bold text-xl mb-2">{{$title}}</div>
          <hr>
          <p class="text-gray-700 text-base mt-3">
           Tk. {{$sales}}
          </p>
        </div>
    </div>
</div>