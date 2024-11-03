@extends('components.layout')

@section('title', $title)

@section('student_id', $user->student_id)

@section('content')
    <x-layout-main>
        <x-search>

        </x-search>
        <div class="flex justify-center mt-5">
            <div class="max-w-full sm:max-w-lg md:max-w-2xl lg:max-w-4xl xl:max-w-6xl mx-auto p-4"
                 style="background-color: rgba(0, 0, 85, 0.9); box-shadow: 0px 10px 20px rgba(0, 0, 0, .7); border-radius: 15px;">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <a href="/search?q=on process">
                        <x-card class="text-black" style="background-color: white;">
                            <x-slot:card_title>On Process</x-slot:card_title>
                            {{ $on_process_count }}
                        </x-card>
                    </a>
                    @cannot('view-treasury')
                        <a href="/search?q=pending">
                            <x-card class="text-black" style="background-color: white;">
                                <x-slot:card_title>Pending</x-slot:card_title>
                                {{ $pending_count }}
                            </x-card>
                        </a>
                        <a href="/search?q=released">
                            <x-card class="text-black" style="background-color: white;">
                                <x-slot:card_title>Released</x-slot:card_title>
                                {{ $released_count }}
                            </x-card>
                        </a>
                    @endcannot
                    @can('view-treasury')
                        <a href="/search?q=paid">
                            <x-card class="text-black" style="background-color: white;">
                                <x-slot:card_title>Released</x-slot:card_title>
                                {{ $revenue }}
                            </x-card>
                        </a>
                        <a href="/search?q=paid">
                            <x-card class="text-black" style="background-color: white;">
                                <x-slot:card_title>Paid</x-slot:card_titleu>
                                {{ $paid_transactions_count }}
                            </x-card>
                        </a>

                    @endcan
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-10">
            <div class="max-w-full sm:max-w-lg md:max-w-2xl lg:max-w-4xl xl:max-w-6xl mx-auto p-4 overflow-hidden"
                 style="background-color: rgba(0, 0, 85, 0.9); box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.7); border-radius: 15px;">
                <x-table class="w-full border-collapse border border-gray-300 rounded-lg text-black">
                    <x-slot:table_headers>
                        <tr class="bg-gray-700 text-black font-semibold">
                            <x-table-header>Transaction ID</x-table-header>
                            @if(!Auth::user()->isNormalUser())
                                <x-table-header>Student ID</x-table-header>
                                <x-table-header>First name</x-table-header>
                                <x-table-header>Last name</x-table-header>
                            @endif
                            @cannot('view-treasury')
                                <x-table-header>Date of need</x-table-header>
                                <x-table-header>Type</x-table-header>
                            @endcannot
                            <x-table-header>Cost</x-table-header>
                            <x-table-header>Paid</x-table-header>
                            <x-table-header>Status</x-table-header>
                            <x-table-header>Action</x-table-header>
                        </tr>
                    </x-slot:table_headers>

                    <x-slot:table_body>
                        @foreach ($transactions as $transaction)
                            <tr class="hover:bg-blue-200 border-b border-gray-300 text-black text-center">
                                <x-table-data>{{ $transaction->id }}</x-table-data>
                                @if(!Auth::user()->isNormalUser())
                                    <x-table-data>{{ $transaction->student_id }}</x-table-data>
                                    <x-table-data>{{ $transaction->user->first_name }}</x-table-data>
                                    <x-table-data>{{ $transaction->user->last_name }}</x-table-data>
                                @endif
                                @cannot('view-treasury')
                                    <x-table-data>{{ date('m-d-Y', strtotime($transaction->needed_date)) }}</x-table-data>
                                    <x-table-data>{{ $transaction->document->document_name }}</x-table-data>
                                @endcannot
                                <x-table-data>{{ $transaction->document->cost }}</x-table-data>
                                <x-table-data>{{ $transaction->is_paid == "0" ? "No" : "Yes" }}</x-table-data>
                                <x-table-data>{{ $transaction->status }}</x-table-data>
                                <x-table-data class="flex space-x-2 justify-center">
                                    @can("delete", $transaction)
                                        <form method="POST" action="/transactions/{{ $transaction->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-white bg-red-600 hover:bg-red-700 rounded-md px-3 py-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                    @can('update', $transaction)
                                        <a href="/transactions/{{ $transaction->id }}/edit"
                                           class="text-white bg-blue-600 hover:bg-blue-700 rounded-md px-3 py-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487ZM16.863 4.487L19.5 7.125"/>
                                            </svg>
                                        </a>
                                    @endcan
                                    <a href="/transactions/{{ $transaction->id }}/show"
                                       class="text-white bg-green-600 hover:bg-green-700 rounded-md px-3 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M18 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        </svg>
                                    </a>
                                    @can('view-treasury')
                                        @if(!$transaction->is_paid)
                                            <form action="/journals" method="post">
                                                @csrf
                                                <x-form-input type="submit"
                                                              class="border-2 border-green-400 bg-green-200 rounded-full font-semibold px-2 py-1 text-black"
                                                              value="Mark as paid"/>
                                                <input type="hidden" name="transaction_id"
                                                       value="{{ $transaction->id }}">
                                                <input type="hidden" name="student_id"
                                                       value="{{ $transaction->student_id }}">
                                                <input type="hidden" name="cost"
                                                       value="{{ $transaction->document->cost }}">
                                            </form>
                                        @else
                                            <p class="border-2 border-green-400 bg-green-200 rounded-full font-semibold px-2 py-1 text-black">
                                                Paid</p>
                                        @endif
                                    @endcan
                                </x-table-data>
                            </tr>
                        @endforeach
                    </x-slot:table_body>

                    <x-slot:table_links>{{ $transactions->links() }}</x-slot:table_links>
                </x-table>
            </div>
        </div>
    </x-layout-main>
@endsection
