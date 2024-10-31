@props(['active' => false])

<a class="flex space-x-3 w-full h-10 bg-white  cursor-pointer select-none
    active:translate-y-2  active:[box-shadow:0_0px_0_0_#1b6ff8,0_0px_0_0_#1b70f841]
    active:border-b-[0px]
    transition-all duration-150 [box-shadow:0_5px_0_0_#1b6ff8,0_10px_0_0_#1b70f841]
    rounded-[15px] border-[1px] border-blue-400 {{ $active ? 'bg-blue-900 text-white': 'text-indigo-900 hover:text-gray-600  '}} px-3 py-2 text-base font-medium"
   aria-current="{{ $active ? 'page': 'false' }}"
    {{ $attributes }}
>{{ $slot }}</a>
