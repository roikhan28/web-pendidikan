@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Profil</h1>
<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow max-w-xl">
  @csrf
  <label class="block mb-1">Nama</label>
  <input class="border rounded w-full p-2 mb-3" name="name" value="{{ old('name',auth()->user()->name) }}" required>
  <label class="block mb-1">Password (opsional)</label>
  <input type="password" class="border rounded w-full p-2 mb-3" name="password">
  <label class="block mb-1">Konfirmasi Password</label>
  <input type="password" class="border rounded w-full p-2 mb-3" name="password_confirmation">
  <label class="block mb-1">Foto Profil (jpg/png)</label>
  <input type="file" class="mb-3" name="avatar" accept="image/*">
  <button class="px-3 py-1 bg-blue-600 text-white rounded">Simpan</button>
</form>
@endsection
