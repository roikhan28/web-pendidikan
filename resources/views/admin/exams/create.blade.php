@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-3">Tambah Ujian</h2>
<form method="POST" action="{{ route('admin.exams.store') }}" class="bg-white p-4 rounded shadow max-w-xl">
@csrf
<label class="block mb-1">Mata Pelajaran</label>
<select name="subject_id" class="border rounded w-full p-2 mb-3" required>
  <option value="">--Pilih Mapel--</option>
  @foreach($subjects as $s)
    <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->kelas->name }})</option>
  @endforeach
</select>

<label class="block mb-1">Tanggal</label>
<input type="date" name="date" class="border rounded w-full p-2 mb-3" required>

<label class="block mb-1">Jam Mulai</label>
<input type="time" name="start_time" class="border rounded w-full p-2 mb-3" required>

<label class="block mb-1">Jam Selesai</label>
<input type="time" name="end_time" class="border rounded w-full p-2 mb-3" required>

<label class="block mb-1">Lokasi</label>
<input name="location" class="border rounded w-full p-2 mb-3">

<button class="px-3 py-1 bg-blue-600 text-white rounded">Simpan</button>
</form>
@endsection
