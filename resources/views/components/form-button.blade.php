{{--<input {{ $attributes->merge(["class" => "btn btn-primary", "type" => "submit" ]) }}  >--}}

@props(['active' => false])
<input type="submit" class=" {{ $active ? 'bg-primary' : 'bg-[#0661a3]' }} rounded-full  nav-link px-3 py-2 text-white font-bold"
    {{ $attributes }}>{{ $slot }}
