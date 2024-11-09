@php use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\URL; @endphp

@extends('components.layout')

@section('title', 'receipt')

@section('student_id', Auth::user()->student_id)

@section('content')
    <div class="flex items-center justify-center mt-10 sm:mt-20 px-4 sm:px-0">
        <x-layout-main class=" w-full max-w-lg">
            <!-- Header with Logo and Title -->
            <div
                class="bg-blue-900 text-white p-4 rounded-t-lg flex flex-col sm:flex-row items-center sm:justify-between">
                <!-- Left Logo -->
                <img src="https://github.com/Hanzcy/Pictures/raw/main/images/CCC%20LOGO.png" alt="CCC Logo"
                     class="h-12 w-12 sm:h-16 sm:w-16 object-contain mb-2 sm:mb-0">

                <!-- Right Title and Subtitle -->
                <div class="text-center sm:text-right ml-0 sm:ml-4">
                    <h1 class="text-lg sm:text-xl font-bold montserrat-bold">CITY COLLEGE OF CALAMBA</h1>
                    <p class="text-xs sm:text-sm font-medium montserrat-regular">Office of the College Registrar</p>
                </div>
            </div>

            <!-- Transaction ID Container -->
            <div class="bg-white shadow-lg rounded-b-lg p-4 sm:p-6 space-y-4">
                <div class="flex justify-center sm:justify-end">
                    <h2 class="text-indigo-900 text-base sm:text-lg font-bold">Transaction
                        ID: {{ $transaction->id }}</h2>
                </div>

                <!-- Main Content Section -->
                <div class="text-center">
                    <p class="text-sm sm:text-lg text-gray-700">
                        Proceed to <span class="font-semibold text-indigo-600">WINDOW 1</span> to claim your request on:
                    </p>
                    <p class="text-indigo-600 font-semibold text-base sm:text-lg mt-1">{{ $transaction->needed_date }}</p>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">Available from 8:00 AM to 5:00 PM, Monday to
                        Friday</p>
                </div>

                <!-- Bring the following section -->
                <div class="mt-6 bg-gray-100 p-4 rounded-md shadow-inner">
                    <h3 class="text-sm sm:text-lg font-bold text-gray-800">Bring the following:</h3>
                    <ul class="list-disc list-inside text-gray-700 mt-2 text-sm sm:text-base">
                        <li>School ID</li>
                        <li>Ballpen</li>
                    </ul>
                </div>
            </div>
        </x-layout-main>
    </div>

    <!-- Include Google Fonts for Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Custom Font Classes */
        .montserrat-regular {
            font-family: "Montserrat", sans-serif;
            font-weight: 400;
        }

        .montserrat-bold {
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
        }
    </style>
@endsection

