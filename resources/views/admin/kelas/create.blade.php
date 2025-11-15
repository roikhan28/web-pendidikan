@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-3">Tambah Kelas</h2>
<form method="POST" action="{{ route('admin.kelas.store') }}" class="bg-white p-4 rounded shadow">
@csrf
<label class="block mb-2">Nama Kelas</label>
<input name="name" class="border rounded w-full p-2 mb-3" required>
<button class="px-3 py-1 bg-blue-600 text-white rounded">Simpan</button>
</form>
@endsection
