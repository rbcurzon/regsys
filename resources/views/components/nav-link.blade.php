@props(['active' => false])

<a class="flex gap-x-1 {{ $active ? 'bg-indigo-900 text-white': 'text-indigo-900 hover:text-gray-600  '}} rounded-md px-3 py-2 text-base font-medium"
   aria-current="{{ $active ? 'page': 'false' }}"
    {{ $attributes }}
>{{ $slot }}</a>
