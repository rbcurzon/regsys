@php use App\Models\Course;use App\Models\Document;use App\Models\Purpose;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\URL; @endphp
<x-layout>
    <div class="w-2/4 m-auto">
        <form method="POST" action="/transactions/{{ $transaction->id }}">
            @csrf
            @method('PATCH')

            <div class="space-y-12">
                {{--User information start--}}
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold  leading-7 text-gray-900">User Information</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Use real information.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first-nam_" class="block text-sm font-medium leading-6 text-gray-900">
                                First name
                            </label>
                            <div class="mt-2">
                                <input type="text" name="first_name" id="first_name" autocomplete="first_name"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       value="{{ Auth::user()->first_name }}">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last
                                name</label>
                            <div class="mt-2">
                                <input type="text" name="last_name" id="last_name" autocomplete="last_name"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       value="{{ Auth::user()->last_name }}">
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
                                       value="{{ Course::find(Auth::user()->course_id)->code }}">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="section" class="block text-sm font-medium leading-6 text-gray-900">
                                Section
                            </label>
                            <div class="mt-2">
                                <input type="text" name="section" id="section" autocomplete="section"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       value="{{ Auth::user()->section }}">
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
                        {{--Purpose start--}}
                        <div class="sm:col-span-3">
                            <label for="purpose_id"
                                   class="block text-sm font-medium leading-6 text-gray-900">Purpose</label>
                            <div class="mt-2">
                                <select id="purpose_id" name="purpose_id" autocomplete="purpose_id"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                        autocomplete="purpose_id">
                                    @foreach($request_purposes as $request_purpose)
                                        <option
                                                value="{{$request_purpose->purpose_id}}">{{ $request_purpose->purpose_name }}</option>
                                    @endforeach
                                    <option selected style="display: none"
                                            value="{{ Purpose::find($transaction->purpose_id)->purpose_id }}">{{ Purpose::find($transaction->purpose_id)->purpose_name }}</option>
                                </select>
                                @error('purpose_id')
                                <p class="text-red-900 italic">Select your option.</p>
                                @enderror
                            </div>
                        </div>
                        {{--Purpose end--}}
                        <div class="sm:col-span-3">
                            <label for="type_id"
                                   class="block text-sm font-medium leading-6 text-gray-900">Request</label>
                            <div class="mt-2">
                                <select id="type_id" name="type_id"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                        autocomplete="type_id">

                                    @foreach($documents as $document)
                                        <option
                                                value="{{$document->document_id}}">{{ $document->document_name }}</option>
                                    @endforeach
                                    <option selected style="display: none"
                                            value="{{ Document::find($transaction->type_id)->document_id }}">{{ Document::find($transaction->type_id)->document_name }}</option>
                                </select>
                                @error('type_id')
                                <p class="text-red-900 italic">Select your option.</p>
                                @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-2 sm:col-start-1">
                            <label for="date_needed" class="block text-sm font-medium leading-6 text-gray-900">Date
                                needed</label>
                            <div class="mt-2">
                                <input type="date" name="date_needed" id="date_needed" autocomplete="address-level2"
                                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       value="{{ $transaction->date_needed }}">
                            </div>
                            @error('date_needed')
                            <p class="text-red-900 italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                {{--Transaction Information End--}}

            </div>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="course_id" value="{{ Auth::user()->course_id }}">
            <input type="hidden" name="date_requested" value="{{ $transaction->date_needed }}">
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a
                        class="text-sm font-semibold leading-6 text-gray-900"
                        href="{{ URL::previous() }}">Back</a>
                <button
                        type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >Update
                </button>
            </div>
        </form>
        @foreach($errors->all() as $message)
            <p class="accent-red-900">{{ $message }}</p>
        @endforeach
    </div>
</x-layout>
