@php use Illuminate\Support\Facades\URL; @endphp
@extends('components.layout')

@section('title', $title)

@section('user_id', $user->id)

@section('content')
    <div class="flex items-center justify-center">
        <x-layout-main class="px-3 py-2 max-w-md">
            <div class="space-y-12">
                {{--User information start--}}
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">User Information</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Your user information you used when you create
                        your
                        account.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">
                                First name
                            </label>
                            <div class="mt-2">
                                <input type="text" name="first_name" id="first_name" autocomplete="first_name"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       value="{{ $user->first_name }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last
                                name</label>
                            <div class="mt-2">
                                <input type="text" name="last_name" id="last_name" autocomplete="last_name"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       value="{{ $user->last_name }}"
                                       readonly
                                >
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="year_level"
                                   class="block text-sm font-medium leading-6 text-gray-900">Year level</label>
                            <div class="mt-2">
                                <input id="year_level" name="year_level" autocomplete="year_level"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                       value="{{ $user->year_level }}"
                                       readonly
                                >
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="course" class="block text-sm font-medium leading-6 text-gray-900">
                                Course
                            </label>
                            <div class="mt-2">
                                <input type="text" name="course" id="course" autocomplete="course"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       value="{{ $user->course->code }}"
                                       readonly
                                >
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="section" class="block text-sm font-medium leading-6 text-gray-900">
                                Section
                            </label>
                            <div class="mt-2">
                                <input type="text" name="section" id="section" autocomplete="section"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       value="{{ $user->section }}"
                                       readonly
                                >
                            </div>
                        </div>

                    </div>
                </div>
                {{--User Information End--}}

                {{--Transaction Informatlayouion Start--}}
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold  leading-7 text-gray-900">Transaction Information</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Your request details.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        {{--Purpose start--}}
                        <div class="sm:col-span-3">
                            <label for="purpose_id"
                                   class="block text-sm font-medium leading-6 text-gray-900">Purpose</label>
                            <div class="mt-2">
                                <input type="text" id="purpose_id" name="purpose_id"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                       autocomplete="purpose_id"
                                       value="{{ $transaction->purpose->purpose_name }}"
                                       readonly
                                >
                            </div>
                        </div>
                        {{--Purpose end--}}
                        <div class="sm:col-span-3">
                            <label for="document_id"
                                   class="block text-sm font-medium leading-6 text-gray-900">Document</label>
                            <div class="mt-2">
                                <input type="text" id="document_id" name="document_id"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                       value="{{ $transaction->document->document_name }}"
                                       readonly
                                >
                            </div>
                        </div>

                        {{--Date requested start--}}
                        <div class="sm:col-span-3 sm:col-start-1">
                            <label for="needed_date" class="block text-sm font-medium leading-6 text-gray-900">Requested Date</label>
                            <div class="mt-2">
                                <input type="text" name="needed_date" id="needed_date" autocomplete="needed_date"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       readonly
                                       value="{{ $transaction->created_at->format('m-d-Y H:i A') }}">
                            </div>
                        </div>
                        {{--Date requested end--}}

                        {{--Date needed start--}}
                        <div class="sm:col-span-3">
                            <label for="needed_date" class="block text-sm font-medium leading-6 text-gray-900">Needed Date</label>
                            <div class="mt-2">
                                <input type="text" name="needed_date" id="needed_date" autocomplete="needed_date"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       readonly
                                       value="{{ date('m-d-Y', strtotime($transaction->needed_date)) }}">
                            </div>
                        </div>
                        {{--Date needed end--}}

                    </div>
                </div>
                {{--Transaction Information End--}}

            </div>
        </x-layout-main>
    </div>
    {{--Transaction Information End--}}
@endsection
