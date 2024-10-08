
<div {{ $attributes->merge(['class' => '']) }}>
{{--    <label {{ $attributes->class('text-sm text-white uppercase')->merge() }}>{{ $label ?? "" }}</label>--}}
    {{ $slot }}
</div>
