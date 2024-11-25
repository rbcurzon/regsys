@php
    use App\Models\Course;
    use Illuminate\Support\Facades\URL;
@endphp

@extends('components.layout')

@section('title', 'Update')

@section('student_id', $user->student_id)

@section('content')
    <div class="flex justify-center">
        <!-- Main Container -->
        <form method="POST" action="/transactions/{{ $transaction->id }}" class="bg-white shadow-lg rounded-lg max-w-4xl w-full p-6 space-y-8 transform translate-x-2">
            @csrf
            @method('PATCH')

            <!-- Header Rectangle -->
            <div class="bg-[rgb(0,0,85)] p-4 rounded-t-lg">
                <!-- Header Section with Logos and Title -->
                <div class="flex justify-between items-center">
                    <!-- Left Logo -->
                    <img src="https://github.com/Hanzcy/Pictures/raw/main/images/CCC%20LOGO.png" alt="CCC Logo" class="h-16 w-16 object-contain">

                    <!-- Center Header Title and Subtitle -->
                    <div class="text-center">
                        <h1 class="text-2xl font-bold text-white montserrat-bold">CCC College Registrar</h1>
                        <p class="text-sm text-gray-200 montserrat-regular">Update Document Form</p>
                    </div>

                    <!-- Right Logo -->
                    <img src="https://github.com/Hanzcy/Pictures/raw/main/images/REGISTRAR%20LOGO%20UPDATED.png" alt="Registrar Logo" class="h-16 w-16 object-contain">
                </div>
            </div>

            <!-- User Information Section -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-lg space-y-6">
                <h2 class="text-2xl font-semibold text-gray-900 montserrat-bold">User Information</h2>
                <p class="text-sm text-gray-600">User information cannot be updated here.</p>

                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first_name" class="block text-sm font-medium text-gray-900">First name</label>
                        <input type="text" name="first_name" id="first_name" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm" value="{{ $user->first_name }}" readonly>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="last_name" class="block text-sm font-medium text-gray-900">Last name</label>
                        <input type="text" name="last_name" id="last_name" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm" value="{{ $user->last_name }}" readonly>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="year_level" class="block text-sm font-medium text-gray-900">Year level</label>
                        <select id="year_level" name="year_level" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm" disabled>
                            <option value="{{ $user->year_level }}">{{ $user->year_level }}</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="course" class="block text-sm font-medium text-gray-900">Course</label>
                        <input type="text" name="course" id="course" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm" value="{{ $user->course->code }}" readonly>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="section" class="block text-sm font-medium text-gray-900">Section</label>
                        <input type="text" name="section" id="section" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm" value="{{ $user->section }}" readonly>
                    </div>
                </div>
            </div>

            <!-- Transaction Information Section -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-lg space-y-6">
                <h2 class="text-2xl font-semibold text-gray-900 montserrat-bold">Transaction Information</h2>
                <p class="text-sm text-gray-600">Update transaction information.</p>

                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="purpose_id" class="block font-semibold text-gray-900">Purpose</label>
                        <select id="purpose_id" name="purpose_id" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm">
                            <option class="hidden" value="{{ $transaction->purpose->purpose_id }}">{{ $transaction->purpose->purpose_name }}</option>
                            @foreach($purposes as $purpose)
                                <option value="{{ $purpose->purpose_id }}">{{ $purpose->purpose_name }}</option>
                            @endforeach
                        </select>
                        @error('purpose_id')
                        <p class="text-red-900 italic">Select your option.</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <fieldset>
                            <legend class="font-semibold text-gray-900">
                                Documents
                            </legend>
                            <ul>
                                @foreach($documents as $document)
                                    <li>
                                        <input type="checkbox"
                                               name="documents[]"
                                               value="{{ $document->document_id }}"
                                               id="document{{ $document->document_name }}"
                                                {{ in_array($document->document_id, $transaction_document_ids) ? "checked" : "" }}
                                        >
                                        <label
                                            for="document{{ $document->document_name }}">{{ $document->document_name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                            @error('documents')
                            <p class="text-red-900 italic">{{ $message }}</p>
                            @enderror
                        </fieldset>
                    </div>

                    <div class="sm:col-span-3 sm:col-start-1">
                        <label for="needed_date" class="block font-semibold text-gray-900">Date of need</label>
                        <input type="date" name="needed_date" id="needed_date" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm" value="{{ DateTime::createFromFormat('Y-m-d', $transaction->needed_date)->format('Y-m-d') }}">
                        @error('needed_date')
                        <p class="text-red-900 italic">{{ $message }}</p>
                        @enderror
                    </div>

                    @if(Auth::user()->isAdmin())
                        <div class="sm:col-span-3">
                            <label for="status" class="block font-semibold text-gray-900">Status</label>
                            <select id="status" name="status" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm">
                                <option class="hidden" value="{{ $transaction->status }}">{{ $transaction->status }}</option>
                                @foreach($status as $s)
                                    <option value="{{ $s }}">{{ $s }}</option>
                                @endforeach
                            </select>
                            @error('status')
                            <p class="text-red-900 italic">{{ $message }}.</p>
                            @enderror
                        </div>
                    @endif
                </div>
            </div>

            <!-- Hidden Fields and Submit Button -->
            <div class="flex justify-end gap-x-6">
                <a href="{{ URL::previous() }}" class="text-sm font-semibold text-gray-900 montserrat-regular">Back</a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-600">Submit</button>
                <input type="hidden" name="is_paid" value="{{ $transaction->is_paid }}">
            </div>
        </form>
    </div>
@endsection
