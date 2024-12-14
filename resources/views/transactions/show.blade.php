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
                    <fieldset class="border border-solid border-gray-300 p-3">
                        <legend class="text-2xl leading-tight text-black montserrat-bold">
                            User Information
                        </legend>
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2 px-3">
                            <div class="grid grid-cols-2 text-gray-900">
                                <span class="font-semibold">Name:</span>
                                <div>
                                    {{ $user->first_name }}
                                    {{ $user->last_name }}
                                </div>
                            </div>

                            <div class="sm:col-span-1 sm:col-start-1 ">
                                <div class="grid grid-cols-2 text-gray-900 ">
                                <span class=" font-semibold">
                                Year level:
                                </span>
                                    {{ $user->year_level }}
                                </div>
                            </div>
                            <div class="sm:col-span-1 sm:col-start-1">
                                <div class="grid grid-cols-2 text-gray-900 ">
                                <span class="font-semibold">
                                Course:
                                </span>
                                    {{ $user->course->course_name }}
                                </div>
                            </div>

                            <div class="sm:col-span-1 sm:col-start-1">
                                <div class="grid grid-cols-2 text-gray-900 ">
                                <span class="font-semibold">
                                    Section:
                                   </span>
                                    {{ $user->section }}
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

                {{-- Transaction Information Start --}}
                <div class="bg-gray-50 p-6 rounded-lg shadow-lg space-y-6">
                    <fieldset class="border border-solid border-gray-300 p-3">
                        <legend class="text-2xl leading-tight text-black montserrat-bold">Transaction Information
                        </legend>

                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2 px-2">
                            {{-- Documenet start--}}

                            <div class="sm:col-span-1 sm:col-start-1 grid grid-cols-2 bg-">
                            <span class="font-bold text-gray-900">
                                Reference ID:
                            </span> {{ $transaction->id }}
                            </div>

                            {{-- Date of request--}}
                            <div class="sm:col-span-1 sm:col-start-2 grid grid-cols-2">
                                <span
                                    class="font-semibold text-gray-900">Date of request:</span> {{ $transaction->created_at->format('F j, Y') }}
                            </div>

                            <div class="sm:col-span-1 sm:col-start-1 grid grid-cols-2 bg-">
                            <span class="font-bold text-gray-900">
                                OR Number:
                            </span> {{ $transaction->or_number }}
                            </div>

                            {{-- Date of need --}}
                            <div class="sm:col-span-1 sm:col-start-2 grid grid-cols-2">
                                <span
                                    class="font-semibold text-gray-900">Date of need:</span> {{ date('F j, Y', strtotime($transaction->needed_date)) }}
                            </div>

                            <div class="sm:col-span-1 sm:col-start-1 bg-">
                            <span class="font-bold text-gray-900">
                                Documents:
                            </span>
                                <ul class="list-decimal pl-12">
                                    @foreach($transaction->transactionDocument as $document)
                                        <li>{{ $document->document->document_name }} x {{ $document->quantity }} copy
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- amount --}}
                            <div class="sm:col-span-1 sm:col-start-2 grid grid-cols-2">
                                <span
                                    class="font-semibold text-gray-900">Amount:</span> {{ $transaction->getTotalCost() . " Php" }}
                            </div>

                            {{-- Purpose --}}
                            <div class="sm:col-span-1 sm:col-start-1 grid grid-cols-2">
                            <span class="font-bold text-gray-900">
                                Purpose:
                            </span>{{ $transaction->purpose->purpose_name }}
                            </div>
                        </div>
                    </fieldset>
                </div>
                {{-- Transaction Information End --}}
            </div>
        </div>
    </div>
@endsection
