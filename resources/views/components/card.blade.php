<div {{ $attributes->merge(['class'=> 'w-[300px] h-[130px] rounded overflow-hidden shadow-lg mt-2 mb-3 border-b rounded-b-[30px]']) }} >
    <div class="">
        @if($card_title->isEmpty())
            <div class="font-bold text-xl mb-2 text-center border border-[#2563eb] rounded-md ">Card Title</div>
        @else
            <div class="font-bold text-xl mb-2 text-center border border-[#2563eb] rounded-md ">{{ $card_title }}</div>
        @endif

        <p class="text-gray-700 text-xl px-2 text-center">
            {{ $slot }}
        </p>
    </div>
</div>
