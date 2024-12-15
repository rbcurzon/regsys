@extends('components.layout')

@section('title', 'Login')

@section('content')
    <!-- Include the Montserrat font from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Include Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Custom Font Classes */
        .montserrat-light {
            font-family: 'Montserrat', serif;
            font-weight: 300;
        }

        .montserrat-regular {
            font-family: 'Montserrat', serif;
            font-weight: 400;
        }

        .montserrat-medium {
            font-family: 'Montserrat', serif;
            font-weight: 500;
        }

        .montserrat-semibold {
            font-family: 'Montserrat', serif;
            font-weight: 600;
        }

        .montserrat-bold {
            font-family: 'Montserrat', serif;
            font-weight: 700;
        }

        /* Custom input styles with icons */
        .input-icon {
            position: relative;
        }

        .input-icon input {
            padding-left: 3rem; /* Increase padding for the icon and line */
        }

        .input-icon i {
            position: absolute;
            top: 50%;
            left: 0.75rem;
            transform: translateY(-50%);
            color: #999;
        }

        /* Separator between icon and input */
        .input-icon::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 2.5rem; /* Position the separator after the icon */
            transform: translateY(-50%);
            height: 60%; /* Length of the line */
            width: 1px;
            background-color: #999;
        }

        /* Style the form container with the specified background color */
        .form-container {
            background-color: rgb(0, 0, 85); /* Dark blue background */
            width: 90%; /* Set the width to 90% of its parent container */
            max-width: 500px; /* Set a max-width for larger screens */
            padding: 2rem; /* Increase padding for the container */
        }

        .heading-size-adjustable {
            font-weight: 650;
            font-size: 1.5rem; /* Adjust this to change the size of CCC COLLEGE REGISTRAR */
            color: white; /* Change the color of the h2 */
        }

        .signin-spacing {
            margin-top: 30px; /* Adjust this value as needed */
        }

        /* Align "SIGN IN" to the left and bold */
        .signin-header {
            text-align: left;
            font-weight: bold;
            padding-left: 10px; /* Add left padding to move it away from the edge */
            font-size: 1.2rem; /* Make it a bit larger */
            color: white; /* Change the color of the h3 */
        }

        /* Style for the login button */
        .login-button {
            background-color: white; /* Change button background to white */
            color: rgb(0, 0, 85); /* Change button text color to dark blue */
        }

        /* Hover effect for the button */
        .login-button:hover {
            background-color: rgba(255, 255, 255, 0.8); /* Slightly transparent on hover */
        }

        /* Add spacing between CCC College Registrar and Sign In */
        .title-spacing {
            margin-bottom: 10px; /* Add space between title and sign in */
        }
    </style>

    <!-- Fullscreen Background with the provided image -->
    <div class="min-h-screen flex items-center justify-center" style="background-image: url({{ asset('/images/ccc-bg.jpg') }}); background-size: cover; background-position: center;">

        <!-- Login Form Container with dark blue background -->
        <div class="form-container shadow-lg rounded-3xl w-full p-8 relative">
            <!-- Logo and Title Section -->
            <div class="text-center mb-6">
                <img src="{{ asset("/images/registrar-logo.png") }}" alt="Registrar Logo" class="mx-auto mb-4" style="max-width: 100px;">
                <!-- Make the CCC COLLEGE REGISTRAR bold and add spacing class -->
                <h2 class="heading-size-adjustable text-gray-700 montserrat-bold">CCC COLLEGE REGISTRAR</h2>
                <h3 class="signin-header signin-spacing montserrat-bold text-gray-600">SIGN IN</h3>
            </div>

            <!-- Login Form -->
            <form method="POST" action="/login">
                @csrf
                <div class="space-y-4">
                    <!-- Username Field with Icon and Separator -->
                    <div class="input-icon">
                        <i class="fas fa-user"></i> <!-- Font Awesome icon for Username -->
                        <input id="email" type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 montserrat-regular" placeholder="Email" value="{{ old('email') }}" required />
                    </div>

                    <!-- Password Field with Icon and Separator -->
                    <div class="input-icon">
                        <i class="fas fa-lock"></i> <!-- Font Awesome icon for Password -->
                        <input id="password" type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 montserrat-regular" placeholder="Password" required />
                    </div>

                    <x-form-error name="email"></x-form-error>
                   <p class="text-white text-sm">Login attempts: {{ session()->get('login_attempt') ?? 3 }}</p>
                    <!-- Login Button -->
                    <div class="text-center">
                        <button type="submit" class="w-full login-button py-2 rounded-lg transition duration-200 montserrat-semibold">
                            LOGIN
                        </button>
                    </div>

                    <!-- Forgot Password -->
                    <div class="text-center mt-4">
                        <a href="/forgot-password" class="text-sm text-white hover:underline montserrat-light">Forgot Password / Reset Password</a>
                    </div>

                    <div class="text-center mt-4">
                        <a href="register" class="text-sm text-white hover:underline montserrat-light">Register here</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
