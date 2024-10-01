@php
    use App\Models\Document;use Illuminate\Support\Facades\Auth; //remove this
@endphp

@extends('components.layout')

@section('title', 'Dashboard')

@section('user_id', $user->id)

@section('content')
    <x-layout-main>

        <div class="mb-2 flex justify-center">
            <form action="/search">
                <input class="rounded-s-full py-2 px-3 text-sm" type="text" name="q" id="q">
                <input class="border rounded-e-full py-2 px-3 bg-[#2563eb] text-white text-sm" type="submit"
                       value="Search_logo">
            </form>
        </div>
        <hr class="border border-gray-900/10 shadow-md">
        <div class="bg-white rounded-md px-3 py-2">
            <div class="flex-grow overflow-y-auto rounded-md">
                @if(Auth::user()->is_treasurer)
                    <x-card-group>
                        <x-card>
                            <x-slot:card_title>
                                Request
                            </x-slot>
                            0
                        </x-card>
                        <x-card>
                            <x-slot:card_title>
                                Status
                            </x-slot>
                            0
                        </x-card>

                        <x-card>
                            <x-slot:card_title>
                                Received
                            </x-slot>
                            0
                        </x-card>
                    </x-card-group>
                    {{--Table--}}
                    <table class="w-full border-collapse rounded-md">
                        <thead>
                        <x-table-header>
                            Date
                        </x-table-header>

                        <x-table-header>
                            Transaction id
                        </x-table-header>

                        <x-table-header>
                            Debit
                        </x-table-header>

                        <x-table-header>
                            Credit
                        </x-table-header>

                        <x-table-header>
                            Action
                        </x-table-header>
                        </thead>
                        <tbody>
                        <tr class="hover:bg-blue-200">
                            <x-table-data>
                                0
                            </x-table-data>

                            <x-table-data>
                                0
                            </x-table-data>

                            <x-table-data>
                                0
                            </x-table-data>

                            <x-table-data>
                                0
                            </x-table-data>

                            <x-table-data>
                                0
                            </x-table-data>

                        </tr>
                        </tbody>
                    </table>
                @elseif(Auth::user()->is_admin)

                    <div class="flex flex-wrap justify-around my-2">
                        <x-card>
                            <x-slot:card_title>
                                Request
                            </x-slot>
                            0
                        </x-card>

                        <x-card>
                            <x-slot:card_title>
                                Status
                            </x-slot>
                            0
                        </x-card>

                        <x-card>
                            <x-slot:card_title>
                                Received
                            </x-slot>
                            0
                        </x-card>
                    </div>
                    <table class="w-full">
                        <thead>
                        <tr>
                            <x-table-header>
                                transaction_id
                            </x-table-header>
                            <x-table-header>
                                user_id
                            </x-table-header>
                            <x-table-header>
                                course_code
                            </x-table-header>
                            <x-table-header>
                                date_requested
                            </x-table-header>
                            <x-table-header>
                                type
                            </x-table-header>
                            <x-table-header>
                                status
                            </x-table-header>
                            <x-table-header>
                                action
                            </x-table-header>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($transactions as $transaction)
                            @can("edit-transactions", $transaction)
                                <tr class="hover:bg-blue-200">
                                    <x-table-data>{{ $transaction->id }}</x-table-data>
                                    <x-table-data>{{ $transaction->user_id }}</x-table-data>
                                    <x-table-data>{{ $transaction->course }}</x-table-data>
                                    <x-table-data>{{ $transaction->requested_date }}</x-table-data>
                                    <x-table-data>{{ Document::find($transaction->doc_type_id)->document_name }}</x-table-data>
                                    <x-table-data>{{ $transaction->status }}</x-table-data>
                                    <x-table-data class="flex space-x-2">
                                        <form method="POST" action="/transactions/{{ $transaction->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="text-white bg-red-600 hover:bg-red-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                </svg>
                                            </button>
                                        </form>
                                        <a href="/transactions/{{ $transaction->id }}/edit"
                                           class="text-white bg-blue-600 hover:bg-blue-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                            </svg>
                                        </a>
                                        <a href="/transactions/{{ $transaction->id }}/show"
                                           class=" text-white bg-green-600 hover:bg-green-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                            </svg>
                                        </a>
                                    </x-table-data>
                                </tr>
                            @endcan
                        @endforeach
                        </tbody>
                    </table>

                @else
                    <x-card-group>
                        <x-card>
                            <x-slot:card_title>
                                Pending
                            </x-slot>
                            0
                        </x-card>

                        <x-card>
                            <x-slot:card_title>
                                Income
                            </x-slot>
                            0
                        </x-card>
                    </x-card-group>
                    <table class="w-full">
                        <thead>
                        <tr>
                            <x-table-header>
                                transaction_id
                            </x-table-header>
                            <x-table-header>
                                user_id
                            </x-table-header>
                            <x-table-header>
                                course_code
                            </x-table-header>
                            <x-table-header>
                                date_requested
                            </x-table-header>
                            <x-table-header>
                                type
                            </x-table-header>
                            <x-table-header>
                                status
                            </x-table-header>
                            <x-table-header>
                                action
                            </x-table-header>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($transactions as $transaction)
                            @can("edit-transaction", $transaction)
                                <tr class="hover:bg-blue-200">
                                    <x-table-data>{{ $transaction->id }}</x-table-data>
                                    <x-table-data>{{ $transaction->user_id }}</x-table-data>
                                    <x-table-data>{{ $transaction->course }}</x-table-data>
                                    <x-table-data>{{ $transaction->date_requested }}</x-table-data>
                                    <x-table-data>{{ Document::find($transaction->doc_type_id)->document_name }}</x-table-data>
                                    <x-table-data>{{ $transaction->status }}</x-table-data>
                                    <x-table-data class="flex space-x-2">
                                        <form method="POST" action="/transactions/{{ $transaction->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="text-white bg-red-600 hover:bg-red-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                </svg>
                                            </button>
                                        </form>
                                        <a href="/transactions/{{ $transaction->id }}/edit"
                                           class="text-white bg-blue-600 hover:bg-blue-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                            </svg>
                                        </a>
                                        <a href="/transactions/{{ $transaction->id }}/show"
                                           class=" text-white bg-green-600 hover:bg-green-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                            </svg>
                                        </a>
                                    </x-table-data>
                                </tr>
                            @endcan
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="my-2">
                {{ $transactions->links() }}
            </div>
        </div>
    </x-layout-main>
@endsection
