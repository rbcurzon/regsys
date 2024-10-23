@php use App\Models\Course;
use Illuminate\Support\Facades\URL; @endphp
@extends('components.layout')

@section('title', 'Update')

@section('student_id', $user->student_id)

@section('content')
    <div class="flex items-center justify-center">
        <x-layout-main class="px-3 py-2 max-w-md">
            <form method="POST" action="/transactions/ {{ $transaction->id }}">
                @csrf
                @method('PATCH')

                <div class="space-y-12">
                    {{--User information start--}}
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">User Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">User information cannot be updated here.</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">
                                    First name
                                </label>
                                <div class="mt-2">
                                    <input type="text" name="first_name" id="first_name" autocomplete="first_name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                           value="{{ $user->first_name }}">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last
                                    name</label>
                                <div class="mt-2">
                                    <input type="text" name="last_name" id="last_name" autocomplete="last_name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                           value="{{ $user->last_name }}">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="year_level"
                                       class="block text-sm font-medium leading-6 text-gray-900">Year level</label>
                                <div class="mt-2">
                                    <select id="year_level" name="year_level" autocomplete="year_level"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>

                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="course" class="block text-sm font-medium leading-6 text-gray-900">
                                    Course
                                </label>
                                <div class="mt-2">
                                    <input type="text" name="course" id="course" autocomplete="course"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                           value="{{ $user->course->code }}">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="section" class="block text-sm font-medium leading-6 text-gray-900">
                                    Section
                                </label>
                                <div class="mt-2">
                                    <input type="text" name="section" id="section" autocomplete="section"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                           value="{{ $user->section }}">
                                </div>
                            </div>

                        </div>
                    </div>
                    {{--User Information End--}}

                    {{--Transaction Informatlayouion Start--}}
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold  leading-7 text-gray-900">Transaction Information</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Update transaction information.</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            {{--Purpose start--}}
                            <div class="sm:col-span-3">
                                <label for="purpose_id"
                                       class="block text-sm font-medium leading-6 text-gray-900">Purpose</label>
                                <div class="mt-2">
                                    <select id="purpose_id" name="purpose_id" autocomplete="purpose_id"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                            autocomplete="purpose_id">
                                        <option class="hidden"
                                                value="{{ $transaction->purpose->purpose_id }}">{{ $transaction->purpose->purpose_name }}
                                        @foreach($purposes as $purpose)
                                            <option
                                                value="{{$purpose->purpose_id}}">{{ $purpose->purpose_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('purpose_id')
                                    <p class="text-red-900 italic">Select your option.</p>
                                    @enderror
                                </div>
                            </div>
                            {{--Purpose end--}}
                            {{--Document start--}}
                            <div class="sm:col-span-3">
                                <label for="document_id"
                                       class="block text-sm font-medium leading-6 text-gray-900">Document</label>
                                <div class="mt-2">
                                    <select id="document_id" name="document_id"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                            autocomplete="type_id">
                                        <option class="hidden"
                                                value="{{ $transaction->document->document_id }}">{{ $transaction->document->document_name }}
                                        @foreach($documents as $document)
                                            <option
                                                value="{{$document->document_id}}">{{ $document->document_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('document_id')
                                    <p class="text-red-900 italic">Select your option.</p>
                                    @enderror
                                </div>
                            </div>
                            {{--Document end--}}
                            {{--Date needed start--}}
                            <div class="sm:col-span-3 sm:col-start-1">
                                <label for="needed_date" class="block text-sm font-medium leading-6 text-gray-900">Date
                                    of need</label>
                                <div class="mt-2">
                                    <input type="date" name="needed_date" id="needed_date" autocomplete="needed_date"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                           value="{{ DateTime::createFromFormat('Y-m-d', $transaction->needed_date)->format('Y-m-d')  }}">
                                </div>
                                @error('needed_date')
                                <p class="text-red-900 italic">{{ $message }}</p>
                                @enderror
                            </div>
                            {{--Date needed end--}}
                            {{--Status start--}}
                            <div class="sm:col-span-3">
                                @if(Auth::user()->isAdmin())
                                    <label for="status"
                                           class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                                    <div class="mt-2">
                                        <select id="status" name="status"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                                autocomplete="type_id">
                                            <option class="hidden"
                                                    value="{{ $transaction->status }}">{{ $transaction->status }}</option>
                                            @foreach($status as $s)
                                                <option
                                                    value="{{ $s }}">{{ $s }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                        <p class="text-red-900 italic">{{ $message }}.</p>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                            {{--Status end--}}
                        </div>
                    </div>
                    {{--Transaction Information End--}}
                </div>
                <input type="hidden" name="student_id" value="{{ $user->student_id }}">
                <input type="hidden" name="course_id" value="{{ $user->course_id }}">
                <input type="hidden" name="is_paid" value="{{ $transaction->is_paid }}">
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    {{--<a class="text-sm font-semibold leading-6 text-gray-900" href="{{ URL::previous() }}">Back</a>--}}
                    <button
                        type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >Submit
                    </button>
                </div>
            </form>
        </x-layout-main>
    </div>
@endsection()
