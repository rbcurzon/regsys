@php use Illuminate\Support\Facades\URL; @endphp
@extends('components.layout')

@section('title', $title)

@section('user_id', $user->student_id)

@section('content')
    <div class="flex justify-center">
        <div class="bg-white shadow-lg rounded-lg max-w-4xl w-full p-6 space-y-8">
            <!-- Header Section -->
            <div class="bg-[rgb(0,0,85)] p-4 rounded-t-lg flex items-center justify-between">
                <img src="https://github.com/Hanzcy/Pictures/raw/main/images/REGISTRAR%20LOGO%20UPDATED.png" alt="Registrar Logo" class="h-12">
                <div class="text-center flex-grow">
                    <h1 class="text-2xl font-bold text-white montserrat-bold">CCC College Registrar</h1>
                    <p class="text-sm text-gray-200 montserrat-regular">View Only Of The Document Form.</p>
                </div>
                <img src="https://github.com/Hanzcy/Pictures/raw/main/images/CCC%20LOGO.png" alt="CCC Logo" class="h-12">
            </div>

            <div class="space-y-12">
                {{-- User Information Start --}}
                <div class="bg-gray-50 p-6 rounded-lg shadow-lg space-y-6">
                    <h2 class="text-lg font-semibold leading-7 text-black montserrat-bold">User Information</h2>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first_name" class="block text-sm font-medium text-gray-900">First name</label>
                            <input type="text" name="first_name" id="first_name" autocomplete="first_name"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ $user->first_name }}" readonly>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="last_name" class="block text-sm font-medium text-gray-900">Last name</label>
                            <input type="text" name="last_name" id="last_name" autocomplete="last_name"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ $user->last_name }}" readonly>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="year_level" class="block text-sm font-medium text-gray-900">Year level</label>
                            <input id="year_level" name="year_level" autocomplete="year_level"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ $user->year_level }}" readonly>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="course" class="block text-sm font-medium text-gray-900">Course</label>
                            <input type="text" name="course" id="course" autocomplete="course"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ $user->course->code }}" readonly>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="section" class="block text-sm font-medium text-gray-900">Section</label>
                            <input type="text" name="section" id="section" autocomplete="section"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ $user->section }}" readonly>
                        </div>
                    </div>
                </div>
                {{-- User Information End --}}

                {{-- Transaction Information Start --}}
                <div class="bg-gray-50 p-6 rounded-lg shadow-lg space-y-6">
                    <h2 class="text-lg font-semibold leading-7 text-black montserrat-bold">Transaction Information</h2>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        {{-- Purpose start --}}
                        <div class="sm:col-span-3">
                            <label for="purpose_id" class="block text-sm font-medium text-gray-900">Purpose</label>
                            <input type="text" id="purpose_id" name="purpose_id"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ $transaction->purpose->purpose_name }}" readonly>
                        </div>
                        {{-- Purpose end --}}

                        <div class="sm:col-span-3">
                            <label for="document_id" class="block text-sm font-medium text-gray-900">Document</label>
                            <input type="text" id="document_id" name="document_id"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ $transaction->document->document_name }}" readonly>
                        </div>

                        {{-- Date requested start --}}
                        <div class="sm:col-span-3 sm:col-start-1">
                            <label for="needed_date" class="block text-sm font-medium text-gray-900">Requested Date</label>
                            <input type="text" name="needed_date" id="needed_date" autocomplete="needed_date"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ $transaction->created_at->format('m-d-Y H:i A') }}" readonly>
                        </div>
                        {{-- Date requested end --}}

                        {{-- Date needed start --}}
                        <div class="sm:col-span-3">
                            <label for="needed_date" class="block text-sm font-medium text-gray-900">Needed Date</label>
                            <input type="text" name="needed_date" id="needed_date" autocomplete="needed_date"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ date('m-d-Y', strtotime($transaction->needed_date)) }}" readonly>
                        </div>
                        {{-- Date needed end --}}

                    </div>
                </div>
                {{-- Transaction Information End --}}
            </div>
        </div>
    </div>
@endsection
