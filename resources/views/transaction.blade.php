<x-layout>
    <div class="border border-amber-50 self-end w-4/5 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-4">
            <div class="flex items-center">
                <label for="colFormLabel" class="text-sm font-medium text-gray-700">Id</label>
                <input type="text" id="colFormLabel" placeholder="col-form-label" class="ml-3 w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600">
            </div>
            <div class="flex items-center">
                <label for="colFormLabel" class="text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="colFormLabel" placeholder="col-form-label" class="ml-3 w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center">
                    <label for="colFormLabel" class="text-sm font-medium text-gray-700">Year</label>
                    <input type="text" id="colFormLabel" placeholder="col-form-label" class="ml-3 w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="flex items-center">
                    <label for="colFormLabel" class="text-sm font-medium text-gray-700">Section</label>
                    <input type="text" id="colFormLabel" placeholder="col-form-label" class="ml-3 w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center">
                    <label for="colFormLabel" class="text-sm font-medium text-gray-700">Date Needed</label>
                    <input type="date" id="colFormLabel" placeholder="col-form-label" class="ml-3 w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="flex items-center">
                    <label for="colFormLabel" class="text-sm font-medium text-gray-700">Date Requested</label>
                    <input type="date" id="colFormLabel" placeholder="col-form-label" class="ml-3 w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
            </div>
            <div class="flex items-center">
                <label for="radios" class="text-sm font-medium text-gray-700">Radios</label>
                <select id="radios" class="ml-3 w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600">
                    @foreach ($request_purposes as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center">
                <label for="purpose" class="text-sm font-medium text-gray-700">Purpose</label>
                <select id="purpose" class="ml-3 w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-600">
                    @foreach ($documents as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-center">
                <button type="button" class="px-4 py-2 rounded-md bg-blue-600 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Submit</button>
            </div>
        </div>
    </div>
</x-layout>
