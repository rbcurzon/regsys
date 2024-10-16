@php use Illuminate\Support\Facades\URL; @endphp

@extends('components.layout')


@section('content')
    <div class="flex items-center justify-center mt-36">
        <x-layout-main class="mx-auto">
            <div class="text-center">
                <h2 class="text-xl font-bold">Transaction: {{ $transaction->id }}</h2>
                <p>Proceed to WINDOW 1 to claim your request on: {{ $transaction->needed_date }} </p>
            </div>
        </x-layout-main>
    </div>
@endsection
