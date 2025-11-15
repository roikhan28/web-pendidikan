@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-3">Broadcast Notifikasi</h2>
<form class="bg-white p-4 rounded shadow max-w-xl" method="POST" action="{{ route('admin.notifications.broadcast') }}">
  @csrf
  <label class="block mb-1">Target</label>
  <select name="role" class="border rounded w-full p-2 mb-3">
    <option value="all">Semua (Guru & Siswa)</option>
    <option value="guru">Guru</option>
    <option value="siswa">Siswa</option>
  </select>
  <label class="block mb-1">Judul</label>
  <input name="title" class="border rounded w-full p-2 mb-3" required>
  <label class="block mb-1">Isi</label>
  <textarea name="body" class="border rounded w-full p-2 mb-3" rows="4"></textarea>
  <button class="px-3 py-1 bg-blue-600 text-white rounded">Kirim</button>
</form>
@endsection
