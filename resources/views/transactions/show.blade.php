<x-layout>
    <div class="w-2/4 m-auto">
        @csrf
        <div class="space-y-12">
            {{--User information start--}}
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold  leading-7 text-gray-900">User Information</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Use real information.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-full">
                        <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">
                            Name</label>
                        <div class="mt-2">
                            <input type="text" name="last-name" id="last-name" autocomplete="last-name"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   value="{{ $transaction->name }}">

                        </div>
                    </div>


                    <div class="sm:col-span-2 sm:col-start-1">
                        <label for="year_level" class="block text-sm font-medium leading-6 text-gray-900">
                            Year level
                        </label>
                        <div class="mt-2">
                            <input type="text" name="year_level" id="year_level" autocomplete="year_level"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   value="{{ $transaction->year_level }}">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="course" class="block text-sm font-medium leading-6 text-gray-900">
                            Course
                        </label>
                        <div class="mt-2">
                            <input type="text" name="course" id="course" autocomplete="course"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   value="{{ $transaction->program_code }}">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="section" class="block text-sm font-medium leading-6 text-gray-900">
                            Section
                        </label>
                        <div class="mt-2">
                            <input type="text" name="section" id="section" autocomplete="section"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   value="{{ $transaction->section }}">
                        </div>
                    </div>

                </div>
            </div>
            {{--User Information End--}}

            {{--Transaction Information Start--}}
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold  leading-7 text-gray-900">Transaction Information</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Use real information.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-3">
                        <label for="purpose" class="block text-sm font-medium leading-6 text-gray-900">
                            Purpose
                        </label>
                        <div class="mt-2">
                            <input type="text" name="purpose" id="purpose" autocomplete="purpose"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   value="{{ $transaction->purpose }}">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="Request" class="block text-sm font-medium leading-6 text-gray-900">
                            Request
                        </label>
                        <div class="mt-2">
                            <input type="text" name="Request" id="Request" autocomplete="Request"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   value="{{ $transaction->type}}">
                        </div>
                    </div>

                    {{--Date needed start--}}
                    <div class="sm:col-span-3        sm:col-start-1">
                        <label for="date_needed" class="block text-sm font-medium leading-6 text-gray-900">
                            Date needed
                        </label>
                        <div class="mt-2">
                            <input type="text" name="date_needed" id="date_needed" autocomplete="date_needed"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   value="{{ date("d-m-Y", strtotime($transaction->date_needed)) }}">
                        </div>
                    </div>
                    {{--Date needed end--}}

                    {{--Date requested start--}}
                    <div class="sm:col-span-3">
                        <label for="date_needed" class="block text-sm font-medium leading-6 text-gray-900">
                            Date requested
                        </label>
                        <div class="mt-2">
                            <input type="text" name="date_needed" id="date_needed" autocomplete="date_needed"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   value="{{ date("d-m-Y", strtotime($transaction->date_requested)) }}">
                        </div>
                    </div>
                    {{--Date requested end--}}

                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a
                        class="text-sm font-semibold leading-6 text-gray-900"
                        href="{{ \Illuminate\Support\Facades\URL::previous() }}">Back</a>
                </div>
            </div>

        </div>
    </div>
    {{--Transaction Information End--}}
</x-layout>
