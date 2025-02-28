@extends('layouts.app')
@section('content')
<h1 class="text-black font-bold text-3xl pt-3 dark:text-white"><i class="ri-user-fill pr-2 text-2xl"></i>Users List</h2>
        <div><hr class="bg-black h-2 pl-2 mt-3 dark:bg-gray-300" ></div>
<table class="w-full mt-5">
    <tr class="bg-black text-white">
        <th class="border p-2 ">ID</th>
        <th class="border p-2 ">Name</th>
        <th class="border p-2 ">Email</th>
        <th class="border p-2 ">Created At</th>
    </tr>
    @foreach($users as $user)
    <tr class="text-center  bg-gray-400 ">
        <td class="border p-2">{{ $user->id }}</td>
        <td class="border p-2">{{ $user->name }}</td>
        <td class="border p-2">{{ $user->email }}</td>
        <td class="border p-2">{{ $user->created_at->format('Y-m-d') }}</td>
    </tr>
    @endforeach
</table>
@endsection
