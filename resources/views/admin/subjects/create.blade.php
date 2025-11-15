@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-3">Tambah Mapel</h2>
<form method="POST" action="{{ route('admin.subjects.store') }}" class="bg-white p-4 rounded shadow max-w-xl">
@csrf
<label class="block mb-1">Nama Mapel</label>
<input name="name" class="border rounded w-full p-2 mb-3" required>
<label class="block mb-1">Nama Guru</label>
<input name="teacher" class="border rounded w-full p-2 mb-3" required>
<label class="block mb-1">Kelas</label>
<select name="kelas_id" class="border rounded w-full p-2 mb-3" required>
  <option value="">--Pilih Kelas--</option>
  @foreach($kelas as $k)
    <option value="{{ $k->id }}">{{ $k->name }}</option>
  @endforeach
</select>
<button class="px-3 py-1 bg-blue-600 text-white rounded">Simpan</button>
</form>
@endsection
