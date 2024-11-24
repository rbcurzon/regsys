@php@endphp
@extends('components.layout')

@section('title', $title)

@section('student_id', $user->student_id)

@section('content')
    <div class="flex justify-center">
        <div class="bg-white shadow-lg rounded-lg max-w-4xl w-full p-6 space-y-8">
            <!-- Header Section -->
            <div class="bg-[rgb(0,0,85)] p-4 rounded-t-lg flex items-center justify-between">
                <img src="{{asset("/images/registrar-logo.png")}}"
                     alt="Registrar Logo" class="h-12">
                <div class="text-center flex-grow">
                    <h1 class="text-2xl font-bold text-white montserrat-bold">CCC College Registrar</h1>
                    <p class="text-sm text-gray-200 montserrat-regular">View Only Of The Document Form.</p>
                </div>
                <img src="{{asset("/images/ccc-logo.png")}}" alt="CCC Logo" class="h-12">
            </div>

            <div class="space-y-12">
                {{-- User Information Start --}}
                <div class="bg-gray-50 p-6 rounded-lg shadow-lg space-y-6">
                    <h2 class="text-lg leading-7 text-black montserrat-bold">User Information</h2>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-3 px-3">
                        <div class="sm:col-span-1 ">
                            <div class="flex justify-between text-gray-900 ml-">
                                Name:
                                <span class="">
                            {{ $user->first_name }}
                                    {{ $user->last_name }}
                            </span>
                            </div>
                        </div>

                        <div class="sm:col-span-1 sm:col-start-1 ">
                            <div class="flex justify-between text-gray-900 ">
                                Year level: <span class="">{{ $user->year_level }}</span>
                            </div>
                        </div>
                        <div class="sm:col-span-1 sm:col-start-1">
                            <div class="flex justify-between text-gray-900 ">
                                Course: <span class=" "> {{ $user->course->code }}</span>
                            </div>
                        </div>

                        <div class="sm:col-span-1 sm:col-start-1">
                            <div class="flex justify-between text-gray-900 ">
                                Section: <span class=" ">
                                   {{ $user->section }}
                                   </span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- User Information End --}}

                {{-- Transaction Information Start --}}
                <div class="bg-gray-50 p-6 rounded-lg shadow-lg space-y-6">
                    <h2 class="text-lg leading-7 text-black montserrat-bold">Transaction Information</h2>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 px-2">
                        <div class="sm:col-span-3">
                            <h2 class="font-bold text-gray-900">
                                Purpose
                            </h2>
                            <ul class="list-disc mx-4 font-light">
                                <li>{{ $transaction->purpose->purpose_name }}</li>
                            </ul>
                        </div>


                        {{-- Documenet start--}}
                        <div class="sm:col-span-3">
                            <h2 class="text font-bold text-gray-900">
                                Documents
                            </h2>
                            <ul class="list-disc mx-4 font-light">
                                @foreach($transaction->transactionDocument as $document)
                                    <li>{{ $document->document->document_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- Document end--}}

                        {{-- Date requested start --}}
                        <div class="sm:col-span-3 sm:col-start-1">
                            <p>
                                <span
                                    class="font-semibold">Date of request:</span> {{ $transaction->created_at->format('F j, Y') }}
                            </p>
                        </div>
                        {{-- Date requested end --}}

                        {{-- Date needed start --}}
                        <div class="sm:col-span-3">
                            <p>
                                <span
                                    class="font-bold">Date of need:</span> {{ date('F j, Y', strtotime($transaction->needed_date)) }}
                            </p>
                        </div>
                        {{-- Date needed end --}}

                        {{-- amount --}}
                        <div class="sm:col-span-3">
                            <p>
                                <span
                                    class="font-bold">Amount:</span> {{ $transaction->cost . " Php" }}
                            </p>
                        </div>
                    </div>
                </div>
                {{-- Transaction Information End --}}
            </div>
        </div>
    </div>
@endsection
