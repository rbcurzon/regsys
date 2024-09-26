@php use App\Models\Course;
@endphp

<x-layout>
    <div class="w-5/6 ms-auto me-0 px-4">
        <div class="mb-2 flex justify-center">
            <form action="/search">
                <input class="rounded-s-full" type="text" name="q" id="q">
                <input class="border rounded-e-full p-2 px-4 bg-[#2563eb] text-white" type="submit" value="Search" >
            </form>
        </div>
        <div class="flex-grow overflow-y-auto">
            <table class="w-full">
                <thead>
                <tr>
                    <th class="sticky top-0 px-3 py-2 text-primary bg-blue-100 border-b border-gray-200">transaction_id</th>
                    <th class="sticky top-0 px-3 py-2 text-primary bg-blue-100 border-b border-gray-200">user_id</th>
                    <th class="sticky top-0 px-3 py-2 text-primary bg-blue-100 border-b border-gray-200">course_code</th>
                    <th class="sticky top-0 px-3 py-2 text-primary bg-blue-100 border-b border-gray-200">date_requested</th>
                    <th class="sticky top-0 px-3 py-2 text-primary bg-blue-100 border-b border-gray-200">type</th>
                    <th class="sticky top-0 px-3 py-2 text-primary bg-blue-100 border-b border-gray-200">status</th>
                    <th class="sticky top-0 px-3 py-2 text-primary bg-blue-100 border-b border-gray-200">action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($transactions as $transaction)
                    @can("edit-transactions", $transaction)
                        <tr  class="hover:bg-blue-200">
                            <td class="border border-gray-200 px-3 py-2">{{ $transaction->id }}</td>
                            <td class="border border-gray-200 px-3 py-2">{{ $transaction->user_id }}</td>
                            <td class="border border-gray-200 px-3 py-2">{{ Course::find($transaction->course_id)->code }}</td>
                            <td class="border border-gray-200 px-3 py-2">{{ $transaction->date_requested }}</td>
                            <td class="border border-gray-200 px-3 py-2">{{ \App\Models\Document::find($transaction->type_id)->document_name }}</td>
                            <td class="border border-gray-200 px-3 py-2">{{ $transaction->status }}</td>
                            <td class="border border-gray-200 px-3 py-2 flex space-x-2">
                                <form method="POST" action="/transactions/{{ $transaction->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-white bg-red-600 hover:bg-red-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                                <a href="/transactions/{{ $transaction->id }}/edit" class="text-white bg-blue-600 hover:bg-blue-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                                <a href="/transactions/{{ $transaction->id }}/show" class="text-white bg-green-600 hover:bg-green-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endcan
                @endforeach
                </tbody>
            </table>
            <div>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-layout>
