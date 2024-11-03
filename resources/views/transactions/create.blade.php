@php
    use App\Models\Course;
    use Illuminate\Support\Facades\URL;
@endphp
@extends('components.layout')

@section('title', $title)

@section('student_id', $user->student_id)

@section('content')
    <div class="flex justify-center">
        <!-- Outer Container with Header Section -->
        <form action="/transactions" method="post">
            @csrf

            <div class="bg-white shadow-lg rounded-lg max-w-4xl w-full p-6 space-y-8 transform translate-x-2">
                <!-- Header Rectangle -->
                <div class="bg-[rgb(0,0,85)] p-4 rounded-t-lg">
                    <!-- Header Section with Logos and Title -->
                    <div class="flex justify-between items-center">
                        <!-- Left Logo -->
                        <img src="https://github.com/Hanzcy/Pictures/raw/main/images/CCC%20LOGO.png" alt="CCC Logo" class="h-16 w-16 object-contain">

                        <!-- Center Header Title and Subtitle -->
                        <div class="text-center">
                            <h1 class="text-2xl font-bold text-white montserrat-bold">CCC College Registrar</h1>
                            <p class="text-sm text-gray-200 montserrat-regular">Document Form</p>
                        </div>

                        <!-- Right Logo -->
                        <img src="https://github.com/Hanzcy/Pictures/raw/main/images/REGISTRAR%20LOGO%20UPDATED.png" alt="Registrar Logo" class="h-16 w-16 object-contain">
                    </div>
                </div>

                <!-- User Information Section -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-lg space-y-6">
                    <h2 class="text-lg font-semibold text-black montserrat-bold">User Information</h2>
                    <p class="text-sm text-gray-600">Your user information as used when you created your account.</p>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first_name" class="block text-sm font-medium text-gray-900">First name</label>
                            <input type="text" name="first_name" id="first_name" autocomplete="first_name"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ $user->first_name }}">
                            <p class="text-xs text-gray-500 mt-1 ml-1">Ex. Ronald</p>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="last_name" class="block text-sm font-medium text-gray-900">Last name</label>
                            <input type="text" name="last_name" id="last_name" autocomplete="last_name"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ $user->last_name }}">
                            <p class="text-xs text-gray-500 mt-1 ml-1">Ex. Salcedo</p>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="year_level" class="block text-sm font-medium text-gray-900">Year level</label>
                            <select id="year_level" name="year_level" autocomplete="year_level"
                                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="course" class="block text-sm font-medium text-gray-900">Course</label>
                            <input type="text" name="course" id="course" autocomplete="course"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ $user->course->code }}">
                            <p class="text-xs text-gray-500 mt-1">Ex. BSCS, BSIT</p>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="section" class="block text-sm font-medium text-gray-900">Section</label>
                            <input type="text" name="section" id="section" autocomplete="section"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ $user->section }}">
                            <p class="text-xs text-gray-500 mt-1">Ex. CS3</p>
                        </div>
                    </div>
                </div>

                <!-- Transaction Information Section -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-lg space-y-6">
                    <h2 class="text-lg font-semibold text-black montserrat-bold">Transaction Information</h2>
                    <p class="text-sm text-gray-600">Use real information for your document request.</p>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="purpose_id" class="block text-sm font-medium text-gray-900">Purpose</label>
                            <select id="purpose_id" name="purpose_id" autocomplete="purpose_id"
                                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm">
                                <option style="display: none" value="-1">--select an option--</option>
                                @foreach($purposes as $purpose)
                                    <option value="{{$purpose->purpose_id}}">{{ $purpose->purpose_name }}</option>
                                @endforeach
                            </select>
                            @error('purpose_id')
                            <p class="text-red-900 italic">Select your option.</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="document_id" class="block text-sm font-medium text-gray-900">Document</label>
                            <select id="document_id" name="document_id"
                                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm">
                                <option style="display: none" value="-1">--select an option--</option>
                                @foreach($documents as $document)
                                    <option value="{{$document->document_id}}">{{ $document->document_name }}</option>
                                @endforeach
                            </select>
                            @error('document_id')
                            <p class="text-red-900 italic">Select your option.</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3 sm:col-start-1">
                            <label for="needed_date" class="block text-sm font-medium text-gray-900">Date needed</label>
                            <input type="date" name="needed_date" id="needed_date" autocomplete="needed_date"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ old('needed_date') }}">
                            @error('needed_date')
                            <p class="text-red-900 italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Hidden Fields and Submit Button -->
                <input type="hidden" name="student_id" value="{{ $user->student_id }}">
                <input type="hidden" name="course_id" value="{{ $user->course_id }}">
                <div class="flex justify-end gap-x-6">
                    <a href="{{ URL::previous() }}" class="text-sm font-semibold text-gray-900 montserrat-regular"></a>
                    <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-600">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        /* Custom Font Classes */
        .montserrat-regular {
            font-family: "Montserrat", sans-serif;
            font-weight: 400;
        }

        .montserrat-bold {
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
        }
    </style>
@endsection
