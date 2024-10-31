{{--<input {{ $attributes->merge(["class" => "btn btn-primary", "type" => "submit" ]) }}  >--}}

@props(['active' => false])

<input type="submit" {{ $attributes->merge(['class' => 'rounded-full bg-blue-600 nav-link px-4 py-2 text-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500'])}}>
