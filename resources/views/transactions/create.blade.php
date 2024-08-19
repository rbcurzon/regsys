<x-layout>
    <form method="POST" action="/transactions">
        @csrf
        <h2 class="text-base font-semibold leading-7 text-gray-900">Create a Transaction</h2>
        <div class="row">
            <div class="row">
                <x-form-field>
                    <label for="user_id" class="col-sm-2 col-form-label">Id</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="user_id" name="user_id" placeholder="user_id"
                               value= {{ Auth::id() }} readonly>
                    </div>
                </x-form-field>

                <x-form-field>
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{ \Illuminate\Support\Facades\Auth::user()->last_name }}"
                               readonly>
                    </div>
                </x-form-field>
                <div class="col">
                    <label for="year_level" class="col-sm-2 col-form-label">Year</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="year_level" name="year_level"
                               placeholder="year_level"
                               value="1" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <x-form-field>
                    <label for="course_id" class="col-sm-2 col-form-label">Course</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="course_id" name="course_id" placeholder="course_id"
                               value="1" readonly>
                    </div>
                </x-form-field>

                <x-form-field >
                    <label for="section_id" class="col-sm-2 col-form-label">Section</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="section_id" name="section_id"
                               placeholder="section_id"
                               value="1"
                               readonly>
                    </div>
                </x-form-field>
            </div>
        </div>


        <div class="row">
            <x-form-field>
                <label for="date_needed" class="col-sm-3 col-form-label">Date Needed</label>
                <x-form-input type="date" id="date_needed" name="date_needed"
                              placeholder="date needed"/>

                <x-form-error name="date_needed"/>
            </x-form-field>
            <x-form-field>
                <label for="date_requested" class="col-sm-3 col-form-label">Date Requested</label>

                <x-form-input type="date" id="date_requested" name="date_requested"
                              placeholder="date"/>

                <x-form-error name="date_requested"/>
            </x-form-field>
        </div>
        <div class="row">
            <fieldset class="mb-3 col-sm">
                <legend class="col-form-label col-sm-2 pt-0 ">Purpose</legend>
                <select class="form-select" name="type_id">
                    @foreach ($request_purposes as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="mb-3 col-sm">
                <legend class="col-form-label c5l-sm-2 pt-0">Type</legend>
                <select class="form-select" id="purpose_id" name="purpose_id">
                    @foreach ($documents as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </fieldset>
        </div>
        <div class="d-flex justify-content-end">
            <x-form-button type="submit" value="Submit"/>
        </div>
    </form>
</x-layout>
