@extends('admin.layouts.app')

@section('title', 'Profil Admin')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-8 max-w-lg">
    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <form method="POST" action="/admin/profile/update">
        @csrf

        <label class="block mb-2 font-medium">Username</label>
        <input type="text" name="username" value="{{ old('username', $admin->username) }}"
               class="w-full border rounded-lg px-3 py-2 mb-1">
        @error('username') <p class="text-red-500 text-sm mb-3">{{ $message }}</p> @enderror

        <label class="block mb-2 font-medium mt-4">Password Baru (kosongkan jika tidak diubah)</label>
        <input type="password" name="password" class="w-full border rounded-lg px-3 py-2 mb-1">
        @error('password') <p class="text-red-500 text-sm mb-3">{{ $message }}</p> @enderror

        <label class="block mb-2 font-medium mt-4">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="w-full border rounded-lg px-3 py-2 mb-4">
        @error('password_confirmation') <p class="text-red-500 text-sm mb-3">{{ $message }}</p> @enderror

        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg">Simpan</button>
    </form>
</div>
@endsection