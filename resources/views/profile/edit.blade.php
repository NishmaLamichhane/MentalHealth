@extends('layouts.master')

@section('content')
    <div class="bg-gray-100 text-gray-900 flex justify-center items-center min-h-screen">
        <div class="w-full max-w-6xl mx-4 sm:mx-auto bg-white shadow-lg sm:rounded-lg flex overflow-hidden my-10">
            <!-- Image Section -->
            <div class="w-1/2 flex items-center justify-center bg-sky-100">
                <img src="{{ asset('image/Naruto.png') }}" alt="Profile Illustration" class="w-full h-full">
            </div>
            
            <!-- Form Section -->
            <div class="lg:w-1/2 xl:w-7/12 p-6 sm:p-12">
                <div class="flex flex-col mt-4">
                    <header>
                        <h2 class="text-lg font-medium text-[#eb456f]">{{ __('Profile Information') }}</h2>
                        <p class="mt-1 text-sm text-gray-600">{{ __("Update your account's profile information and email address.") }}</p>
                    </header>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <!-- Save Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="text-white bg-pink-500 rounded-lg hover:bg-pink-700">{{ __('Save') }}</x-primary-button>
                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600 dark:text-green-400">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
