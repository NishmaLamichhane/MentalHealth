<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peaceful Mind - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function validateForm(event) {
            let isValid = true;

            // Name Validation
            let name = document.getElementById("name").value.trim();
            let nameError = document.getElementById("nameError");
            if (name.length < 3) {
                nameError.innerText = "Name must be at least 3 characters long.";
                isValid = false;
            } else {
                nameError.innerText = "";
            }

            // Email Validation
            let email = document.getElementById("email").value.trim();
            let emailError = document.getElementById("emailError");
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                emailError.innerText = "Enter a valid email address.";
                isValid = false;
            } else {
                emailError.innerText = "";
            }

            // Password Validation
            let password = document.getElementById("password").value;
            let passwordError = document.getElementById("passwordError");
            if (password.length < 6) {
                passwordError.innerText = "Password must be at least 6 characters long.";
                isValid = false;
            } else {
                passwordError.innerText = "";
            }

            // Confirm Password Validation
            let confirmPassword = document.getElementById("password_confirmation").value;
            let confirmPasswordError = document.getElementById("confirmPasswordError");
            if (confirmPassword !== password) {
                confirmPasswordError.innerText = "Passwords do not match.";
                isValid = false;
            } else {
                confirmPasswordError.innerText = "";
            }

            if (!isValid) {
                event.preventDefault();
            }
        }

        function clearError(fieldId, errorId) {
            let field = document.getElementById(fieldId);
            let error = document.getElementById(errorId);
            field.addEventListener("input", function () {
                error.innerText = "";
            });
        }
        
        window.onload = function () {
            clearError("name", "nameError");
            clearError("email", "emailError");
            clearError("password", "passwordError");
            clearError("password_confirmation", "confirmPasswordError");
        };
    </script>
</head>
<body class="bg-gray-100 text-gray-900 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-6xl mx-4 sm:mx-auto bg-white shadow-lg sm:rounded-lg overflow-hidden my-10">
        <div class="w-full flex flex-col sm:flex-row">
            <div class="w-full sm:w-1/2 flex items-center justify-center bg-sky-100">
                <img src="{{ asset('image/Naruto.png') }}" alt="Registration Illustration" class="w-full h-full object-cover">
            </div>

            <div class="w-full sm:w-1/2 p-6 sm:p-12">
                <div class="flex justify-center">
                    <div class="w-full max-w-md">
                        <div class="text-indigo-900 font-semibold text-3xl font-bold text-center">
                            Mental Health<span class="text-yellow-600"> Support</span>
                        </div>

                        <div class="flex flex-col mt-4">
                            <h1 class="text-2xl xl:text-3xl font-extrabold text-center">Register</h1>
                            <div class="mt-8">
                                <form method="POST" action="{{ route('register') }}" onsubmit="validateForm(event)">
                                    @csrf
                                    <!-- Name -->
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                        <span id="nameError" class="text-red-500 text-xs mt-1"></span>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mt-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                        <span id="emailError" class="text-red-500 text-xs mt-1"></span>
                                    </div>

                                    <!-- Password -->
                                    <div class="mt-4">
                                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                        <input id="password" type="password" name="password" required autocomplete="new-password" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                        <span id="passwordError" class="text-red-500 text-xs mt-1"></span>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mt-4">
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                        <span id="confirmPasswordError" class="text-red-500 text-xs mt-1"></span>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="flex items-center justify-end mt-4">
                                        <button type="submit" class="ml-4 tracking-wide font-semibold bg-indigo-600 text-white w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                            Register
                                        </button>
                                    </div>

                                    <!-- Already Registered? -->
                                    <a href="{{ route('login') }}" class="block text-center mt-4 text-sm text-gray-600 hover:text-gray-900">
                                        Already registered?
                                    </a>

                                    <!-- Back to Home -->
                                    <div class="flex items-center justify-end mt-4">
                                        <a href="{{ route('home') }}" class="ml-4 tracking-wide font-semibold bg-gray-200 text-gray-700 w-full py-4 rounded-lg hover:bg-gray-300 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                            Back Home
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
</body>
</html>
