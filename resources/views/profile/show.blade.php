@php use Illuminate\Support\Facades\URL; @endphp
@extends('components.layout')

@section('title', $title)

@section('student_id', $user->student_id)

@section('content')
    <div class="flex items-center justify-center">
        <x-layout-main class="px-3 py-2 max-w-md">
            <div class="space-y-12">
                {{--User information start--}}
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Personal information.</p>

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
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    {{--                    <a--}}
                    {{--                        class="text-sm font-semibold leading-6 text-gray-900"--}}
                    {{--                        href="{{ URL::previous() }}">Back</a>--}}
                    <a href="/profile/edit"
                       class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Edit
                    </a>


                    {{--User Information End--}}
                </div>
            </div>
        </x-layout-main>
@endsection
