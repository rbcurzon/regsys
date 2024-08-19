<x-layout>
    <form method="POST" action="/transactions/{{ $transaction->id }}">
        @csrf
        @method("PATCH")

        <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Transaction# {{ $transaction->id }}</h2>
        <div class="row">
            <div class="row">
                <div class="col">
                    <label for="user_id" class="col-sm-2 col-form-label">Id</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="user_id" name="user_id" placeholder="user_id" value="{{ $transaction->id }}">
                    </div>
                </div>

                <div class="col">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{ $transaction->name }}"
                            >
                    </div>
                </div>
                <div class="col">
                    <label for="year_level" class="col-sm-2 col-form-label">Year</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="year_level" name="year_level" placeholder="year_level"
                            value="{{ $transaction->year_level }}" >
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class="col">
                    <label for="course_id" class="col-sm-2 col-form-label">Course</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="course_id" name="course_id" placeholder="course_id" value="{{ $transaction->course_id }}" >
                    </div>
                </div>

                <div class="col">
                    <label for="section_id" class="col-sm-2 col-form-label">Section_id</label>
                    <div class="col-sm">
                        <input type="text" class="form-control" id="section_id" name="section_id" placeholder="section_id" value="{{ $transaction->section_id }}"
                            >
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <label for="date_needed" class="col-sm-3 col-form-label">Date Needed</label>
                <div class="col-sm">
                    <input type="date" class="form-control" id="date_needed" name="date_needed" value="{{ $transaction->date_needed }}"
                        placeholder="date needed">
                </div>

            @error('date_needed')
            <p class="text-danger fst-italic mt-4" role="alert"> {{ $message }}</p>
        @enderror
            </div>
            <div class="col">
                <label for="date_requested" class="col-sm-3 col-form-label">Date Requested</label>
                <div class="col-sm">
                    <input type="date" class="form-control" id="date_requested" name="date_requested" placeholder="date" value="{{ $transaction->date_requested }}">
                </div>

            @error('date_requested')
            <p class="text-danger fst-italic mt-4" role="alert"> {{ $message }}</p>
        @enderror
            </div>
        </div>
        <div class="row">
            <fieldset class="mb-3 col-sm">
                <legend class="col-form-label col-sm-2 pt-0 ">Purpose</legend>
                <select class="form-select" name="purpose_id">
                    @foreach ($request_purposes as $item)
                        @if ($item->id == $transaction->purpose_id)
                            <option value="{{ $item->id }}" selected>{{ $item->name }} </option>
                        @endif
                        <option value="{{ $item->id }}">{{ $item->name }} </option>

                    @endforeach
                </select>
            </fieldset>
            <fieldset class="mb-3 col-sm">
                <legend class="col-form-label c5l-sm-2 pt-0">Type</legend>
                <select class="form-select" id="type_id" name="type_id">
                    @foreach ($documents as $item)
                        @if ($item->id == $transaction->type_id)
                            <option value="{{ $item->id }}" selected>{{ $item->name }} </option>
                        @endif
                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                    @endforeach
                </select>
            </fieldset>
        </div>
        @if($errors->any())
            {{ $error->$message }}
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="d-flex justify-content-end">
            <input type="submit" class="btn btn-primary" value="Update">
        </div>
    </form>
</x-layout>
