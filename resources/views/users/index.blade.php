@extends('layouts.app')
@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="page-title-wrap">
        <div class="page-label text-gray-500 dark:text-gray-400">
            Management
        </div>

        <h1 class="page-title text-gray-900 dark:text-white">
            <i class="ri-user-line"></i>
            Users List
        </h1>
    </div>
</div>

@if(session('success'))
<div class="flash-msg flex items-center gap-2">
    <i class="ri-check-circle-line text-green-500 text-lg"></i>
    <span class="text-gray-700 dark:text-gray-200">
        {{ session('success') }}
    </span>
</div>
@endif

<!-- Table Card -->
<div class="table-card bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700">

    <div class="tbl-scroll">
        <table class="tbl w-full">

            <!-- Header -->
            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                <tr class="text-sm">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="text-sm">

                @forelse($users as $user)

                <tr class="border-b border-gray-100 dark:border-gray-700">

                    <!-- ID -->
                    <td>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg
                                     bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300
                                     font-bold text-xs">
                            {{ $user->id }}
                        </span>
                    </td>

                    <!-- Name -->
                    <td class="font-semibold text-gray-900 dark:text-white">
                        {{ $user->name }}
                    </td>

                    <!-- Email -->
                    <td class="text-xs text-gray-600 dark:text-gray-300">
                        {{ $user->email }}
                    </td>

                    <!-- Created At -->
                    <td class="text-xs text-gray-500 dark:text-gray-400">
                        {{ $user->created_at->format('Y-m-d') }}
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="4">
                        <div class="text-center py-10">

                            <i class="ri-user-line text-4xl text-gray-300 dark:text-gray-600 mb-2"></i>

                            <p class="font-semibold text-gray-600 dark:text-gray-300">
                                No users found
                            </p>

                            <p class="text-sm text-gray-400 dark:text-gray-500">
                                User registrations will appear here
                            </p>

                        </div>
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>
</div>

@endsection