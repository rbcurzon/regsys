@php
    use App\Models\Course;
    use Illuminate\Support\Facades\URL;
@endphp
@extends('components.layout')

@section('title', $title)

@section('student_id', $user->getStudentId())

@section('student_name', $user->getFirstNameAndLastNameAbbreviation())

@section('content')
    <div class="flex justify-center">
        <!-- Outer Container with Header Section -->
        <form action="/transactions" method="post">
            @csrf

            <div class="bg-white shadow-lg rounded-lg max-w-4xl w-auto p-4 space-y-6 transform translate-x-2">
                <!-- Header Rectangle -->
                <div class="bg-[rgb(0,0,85)] p-4 rounded-t-lg">
                    <!-- Header Section with Logos and Title -->
                    <div class="flex justify-between items-center">
                        <!-- Left Logo -->
                        <img src="{{asset('/images/ccc-logo.png')}}" alt="CCC Logo"
                             class="h-16 w-16 object-contain">

                        <!-- Center Header Title and Subtitle -->
                        <div class="text-center">
                            <h1 class="text-2xl font-bold text-white montserrat-bold">CCC College Registrar</h1>
                            <p class="text-sm text-gray-200 montserrat-regular">Document Form</p>
                        </div>

                        <!-- Right Logo -->
                        <img src="{{ asset("images/registrar-logo.png")  }}"
                             alt="Registrar Logo" class="h-16 w-16 object-contain">
                    </div>
                </div>

                <!-- User Information Section -->
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

                <!-- Transaction Information Section -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-lg space-y-4">
                    <h2 class="text-lg font-semibold text-black montserrat-bold">Transaction Information</h2>
                    <p class="text-sm text-gray-600">Use real information for your document request.</p>

                    {{-- purposes --}}
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1 col-start-1">
                            <label for="purpose_id" class="block font-semibold">Purpose</label>
                            <select id="purpose_id" name="purpose_id" autocomplete="purpose_id"
                                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm">
                                <option style="display: none" value="-1">--select an option--</option>
                                @foreach($purposes as $purpose)
                                    <option value="{{$purpose->purpose_id}}">{{ $purpose->purpose_name }}</option>
                                @endforeach
                            </select>
                            <x-error field="purpose_id" class="text-red-900 italic"/>
                        </div>

                        {{-- date needed --}}
                        <div class="sm:col-start-2 sm:col-span-1">
                            <label for="needed_date" class="block font-semibold">Date needed</label>
                            <input type="date" name="needed_date" id="needed_date" autocomplete="needed_date"
                                   class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm"
                                   value="{{ \Carbon\Carbon::now()->addDays(8)->toDateString()  }}">
                            {{--                            <x-error field="needed_date" class=" text-red-900 italic"/>--}}
                            <p class="text-sm italic text-red-900">Note: The needed date must be after 7 days
                                days</p>
                        </div>

                        {{-- documents --}}
                        <div class="col-span-1 sm:col-start-1 sm:col-span-2">
                            <fieldset>
                                <legend class="font-semibold">
                                    Documents
                                </legend>
                                <ul class="list-inside text-gray-900/90">
                                    @foreach($documents as $document)
                                        <li>
                                            <input type="checkbox"
                                                   name="documents[]"
                                                   value="{{ $document->document_id }}"
                                                   id="document{{ $document->document_name }}"
                                                   onclick="showCheckBox()"
                                            >
                                            <label for="document{{ $document->document_name }}">
                                                {{ $document->document_name }}
                                            </label>
                                            <label class="quantity{{ $document->document_id }}"
                                                   for="quantity{{ $document->document_id }}"
                                            >
                                                | Php {{ $document->cost }} x
                                            </label>
                                            <x-input id="quantity{{ $document->document_id }}" type="number"
                                                     name="quantity[]"
                                                     class=" p-1 w-20 hidden"
                                                     placeholder="copy" min=1></x-input>
                                        </li>
                                    @endforeach
                                </ul>
                                <x-error field="documents" class=" text-red-900 italic"/>
                            </fieldset>
                        </div>

                    </div>
                </div>

                <!-- Hidden Fields and Submit Button -->
                <input type="hidden" name="student_id" value="{{ $user->student_id }}">
                <input type="hidden" name="course_id" value="{{ $user->course_id }}">
                <div class="flex justify-end gap-x-6">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-600">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        function showCheckBox() {
            // Select all checked checkboxes with the name "documents[]"
            const checkboxes = document.querySelectorAll('input[name="documents[]"]:checked');

            // Collect the values of checked checkboxes
            const checkedValues = Array.from(checkboxes).map(checkbox => checkbox.value);

            // Find all quantity inputs and their associated labels
            const allInputs = document.querySelectorAll('input[name^="quantity[]"]');

            allInputs.forEach(input => {
                const parentLi = input.closest('li'); // Find the parent <li> element
                if (parentLi) {
                    const checkbox = parentLi.querySelector('input[name="documents[]"]');
                    const label = parentLi.querySelector(`label[for="${input.id}"]`); // Find the associated label
                    if (checkbox && checkedValues.includes(checkbox.value)) {
                        input.classList.remove('hidden'); // Show the input
                        if (label) label.classList.remove('hidden'); // Show the label
                    } else {
                        input.classList.add('hidden'); // Hide the input
                        if (label) label.classList.add('hidden'); // Hide the label
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', showCheckBox);
    </script>i>
@endsection
