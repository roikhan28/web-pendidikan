@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-3">Edit Jadwal</h2>
<form method="POST" action="{{ route('admin.schedules.update',$item) }}" class="bg-white p-4 rounded shadow max-w-xl">
@csrf @method('PUT')
<label class="block mb-1">Kelas</label>
<select name="kelas_id" class="border rounded w-full p-2 mb-3" required>
  @foreach($kelas as $k)
    <option value="{{ $k->id }}" @selected($item->kelas_id==$k->id)>{{ $k->name }}</option>
  @endforeach
</select>

<label class="block mb-1">Mata Pelajaran</label>
<select name="subject_id" class="border rounded w-full p-2 mb-3" required>
  @foreach($subjects as $s)
    <option value="{{ $s->id }}" @selected($item->subject_id==$s->id)>{{ $s->name }}</option>
  @endforeach
</select>

<label class="block mb-1">Hari</label>
<input type="number" name="day_of_week" value="{{ old('day_of_week',$item->day_of_week) }}" class="border rounded w-full p-2 mb-3">

<label class="block mb-1">Jam Mulai</label>
<input type="time" name="start_time" value="{{ $item->start_time }}" class="border rounded w-full p-2 mb-3">

<label class="block mb-1">Jam Selesai</label>
<input type="time" name="end_time" value="{{ $item->end_time }}" class="border rounded w-full p-2 mb-3">

<label class="block mb-1">Ruang</label>
<input name="room" value="{{ $item->room }}" class="border rounded w-full p-2 mb-3">

<button class="px-3 py-1 bg-blue-600 text-white rounded">Update</button>
</form>
@endsection
