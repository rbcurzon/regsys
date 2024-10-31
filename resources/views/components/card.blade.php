<div {{ $attributes->merge(['class'=> 'w-48 h-28 rounded overflow-hidden shadow-lg mt-2 mb-3 border-b rounded-b-[30px]']) }} >
{{--    <div class="w-52 h-28"></div>--}}
    <div class="">
        @if($card_title->isEmpty())
            <div class="font-bold text-xl mb-2 text-center border border-[#2563eb] rounded-md ">Card Title</div>
        @else
            <div class="font-bold text-xl mb-2 text-center border border-blue-400 rounded-md bg-blue-400 shadow-md">{{ $card_title }}</div>
        @endif

        <p class="text-gray-700 text-xl px-2 text-center">
            {{ $slot }}
        </p>
    </div>
</div>
