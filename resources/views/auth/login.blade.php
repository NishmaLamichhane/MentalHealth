@extends('layouts.master')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-r from-green-300 to-blue-500 px-4">
        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg border">
            <!-- Header -->
            <h1 class="text-3xl font-bold text-center text-blue-900">Welcome Back</h1>
            <p class="text-center text-gray-600 mt-2">Login to access your account</p>

            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="mt-6">
                @csrf

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Enter your email" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Enter your password" required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me Checkbox -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-sm text-gray-600">Remember Me</label>
                </div>

                <!-- Forgot Password -->
                <div class="text-right mb-4">
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:text-blue-700">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-green-400 text-white rounded-lg px-4 py-2 text-lg font-semibold hover:from-blue-700 hover:to-green-600 focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Login
                </button>
            </form>

            <!-- Sign Up -->
            <p class="text-sm text-gray-500 mt-6 text-center">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700 font-semibold">Sign Up</a>
            </p>
        </div>
    </div>
@endsection
