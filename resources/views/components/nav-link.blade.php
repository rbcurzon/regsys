@props(['active' => false])
<a class=" {{ $active ? 'bg-primary' : 'bg-light' }} nav-link d-flex align-items-center p-3 text-dark border border-secondary rounded-end"
    {{ $attributes }}>{{ $slot }}</a>