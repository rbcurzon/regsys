{{--@extends('components.layout')--}}

{{--@section('title', 'Treasure Dashboard')--}}

{{--@section('user_id', '')--}}

{{--@section('content')--}}
{{--    <x-layout-main>--}}


<div {{ $attributes->merge(['class'=>"bg-white rounded-md px-3 py-2 "]) }} >
    {{--Table--}}
    <div {{ $attributes->merge(['class'=>"flex-grow rounded-md overflow-x-auto"]) }}>
        <table {{ $attributes->merge(['class'=>"w-full border-collapse rounded-md"]) }} >
            <thead class="bg-blue-200">
            <tr>
                {{ $table_headers ?? ''}}
            </tr>
            </thead>
            <tbody>
                {{ $table_body ?? ''}}
            </tbody>
        </table>
    </div>
    <div class="my-2">
        {{ $table_links ?? '' }}
    </div>
</div>
{{--    </x-layout-main>--}}
{{--@endsection--}}
