<x-layout>
    <div class="row mb-3">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Id</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="colFormLabel" placeholder="col-form-label">
        </div>
    </div>
    <div class="row mb-3">
        <label for="colFormLabel" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="colFormLabel" placeholder="col-form-label">
        </div>
    </div>
    <div class="row mb-3">
        <div class="row col-md-5">
            <label for="colFormLabel" class="col-sm-2 col-form-label">Year</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="colFormLabel" placeholder="col-form-label">
            </div>
        </div>
        <div class="row col-md-5">
            <label for="colFormLabel" class="col-sm-2 col-form-label">Section</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="colFormLabel" placeholder="col-form-label">
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="row col">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Date Needed</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" id="colFormLabel" placeholder="col-form-label">
            </div>
        </div>
        <div class="row col">
            <label for="colFormLabel" class="col-sm-3 col-form-label">Date Requested</label>
            <div class="col-sm-5">
                <input type="date" class="form-control" id="colFormLabel" placeholder="col-form-label">
            </div>
        </div>
    </div>
    <fieldset class="row mb-3">
        <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
        <select class="form-select col">
            @foreach ($request_purposes as $item)
            <option value="{{ $item->id }}">{{ $item->name }} </option>
            @endforeach
        </select>
    </fieldset>
    <fieldset class="row mb-3">
        <legend class="col-form-label col-sm-2 pt-0">Purpose</legend>
        <select class="form-select form-select col">
            @foreach ($documents as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </fieldset>
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-primary">Submit</button>
    </div>
</x-layout>