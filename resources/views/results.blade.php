@php use App\Models\Transaction; @endphp
@php
    //remove this
@endphp

@extends('components.layout')

@section('title', $title ?? "")

@section('student_id', $user->student_id ?? "")

@section('content')
    <x-layout-main>
        <div class="mb-2 flex justify-end">
            <form action="/search">
                <label class="relative block">
                    <input
                        class="w-full bg-white placeholder:font-italic border border-slate-400 drop-shadow-md py-2 pl-3 pr-10 focus:outline-none rounded-full"
                        name="q"
                        id="q"
                        type="text"
                    />
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                <svg class="h-5 w-5 fill-black" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30"
                     height="30" viewBox="0 0 30 30"><path
                        d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z">
                    </path>
                </svg>
            </span>
                </label>
            </form>
        </div>
        <hr class="border border-gray-900/10 shadow-md">

        @can('viewAny', Transaction::class)
            {{--admin dashboard start--}}
            <x-table>
                <x-slot:table_headers>
                    <x-table-header>Reference ID</x-table-header>
                    <x-table-header>OR Number</x-table-header>
                    @if(!Auth::user()->isNormalUser())
                        <x-table-header>Student ID</x-table-header>
                        <x-table-header>First name</x-table-header>
                        <x-table-header>Last name</x-table-header>
                    @endif
                    @cannot('view-treasury')
                        <x-table-header>Date of need</x-table-header>
                    @endcannot
                    <x-table-header>Amount</x-table-header>
                    <x-table-header>Paid</x-table-header>
                    <x-table-header>Status</x-table-header>
                    <x-table-header>Action</x-table-header>

                </x-slot:table_headers>
                <x-slot:table_body>
                    @foreach ($transactions as $transaction)
                        <tr class="hover:bg-blue-200">
                            <x-table-data class="text-center">{{ $transaction->id }}</x-table-data>
                            <x-table-data class="text-center">{{ $transaction->or_number}}</x-table-data>
                            @if(!Auth::user()->isNormalUser())
                                <x-table-data>{{ $transaction->student_id }}</x-table-data>
                                <x-table-data>{{ $transaction->user->first_name }}</x-table-data>
                                <x-table-data>{{ $transaction->user->last_name }}</x-table-data>
                            @endif
                            @cannot('view-treasury')
                                <x-table-data>{{ date('m-d-Y', strtotime( $transaction->needed_date )) }}</x-table-data>
                            @endcannot
                            <x-table-data>{{ $transaction->getTotalCost() }}</x-table-data>
                            <x-table-data>{{ $transaction->is_paid  == "0" ? "no" : "yes" }}</x-table-data>
                            <x-table-data>{{ $transaction->status }}</x-table-data>
                            <x-table-data class="flex space-x-2">
                                @can("delete", $transaction)
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
                                @endcan
                                @can('update', $transaction)
                                    <a href="/transactions/{{ $transaction->id }}/edit"
                                       class="text-white bg-blue-600 hover:bg-blue-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                        </svg>
                                    </a>
                                @endcan
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
                                    @can('view-treasury')
                                        @if(!$transaction->is_paid)
                                            {{--                                                                                        <form action="/journals" method="post">--}}
                                            {{--                                                                                            @csrf--}}
                                            {{--                                                                                            <x-form-input type="submit"--}}
                                            {{--                                                                                                          class="border-2 border-green-400 bg-green-200 rounded-full font-semibold px-2 py-1 text-black "--}}
                                            {{--                                                                                                          value="Mark as paid"--}}
                                            {{--                                                                                            />--}}
                                            {{--                                                                                            <input type="hidden" name="transaction_id"--}}
                                            {{--                                                                                                   value="{{ $transaction->id }}">--}}
                                            {{--                                                                                            <input type="hidden" name="student_id"--}}
                                            {{--                                                                                                   value="{{ $transaction->student_id }}">--}}
                                            {{--                                                                                            <input type="hidden" name="cost"--}}
                                            {{--                                                                                                   value="{{ $transaction->getTotalCost()}}">--}}
                                            {{--                                                                                        </form>--}}
                                            <x-form-input
                                                data-modal-target="authentication-modal"
                                                data-modal-toggle="authentication-modal"
                                                type="button"
                                                class="border-2 border-green-400 bg-green-200 rounded-full font-semibold px-2 py-1 text-black w-16"
                                                value="Mark as paid">Mark as paid
                                            </x-form-input>
                                            <input type="hidden" name="transaction_id"
                                                   value="{{ $transaction->id }}">
                                            <input type="hidden" name="student_id"
                                                   value="{{ $transaction->student_id }}">
                                            <input type="hidden" name="cost"
                                                   value="{{ $transaction->getTotalCost()}}">
                                            <!-- Main modal -->
                                            <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                                                 class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div
                                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Official Receipt
                                                            </h3>
                                                            <button type="button"
                                                                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                    data-modal-hide="authentication-modal">
                                                                <svg class="w-3 h-3" aria-hidden="true"
                                                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                     viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                          stroke-linejoin="round" stroke-width="2"
                                                                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="p-4 md:p-5">
                                                            <form action="/journals" method="post" class="space-y-4">
                                                                @csrf

                                                                <div>
                                                                    <label for="or_number"
                                                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                                        OR Number</label>
                                                                    <input type="text" name="or_number" id="or_number"
                                                                           placeholder="0123-1232"
                                                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                                           required/>
                                                                </div>
                                                                <input type="hidden" name="transaction_id"
                                                                       value="{{ $transaction->id }}">
                                                                <input type="hidden" name="student_id"
                                                                       value="{{ $transaction->student_id }}">
                                                                <input type="hidden" name="cost"
                                                                       value="{{ $transaction->getTotalCost()}}">
                                                                <button type="submit"
                                                                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                                    Submit
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @else
                                            <p class="border-2 border-green-400 bg-green-200 rounded-full font-semibold px-2 py-1 text-black">
                                                Paid</p>
                                        @endif
                                        {{--                                            <!-- Modal toggle -->--}}
                                        {{--                                            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">--}}
                                        {{--                                                Toggle modal--}}
                                        {{--                                            </button>--}}

                                    @endcan
                            </x-table-data>
                        </tr>
                    @endforeach
                </x-slot:table_body>
{{--                <x-slot:table_links>{{ $transactions->links() }}</x-slot:table_links>--}}
            </x-table>
        @endcan
        {{--admin dashboard end--}}
    </x-layout-main>
@endsection
