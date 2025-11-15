@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-3">Edit Mapel</h2>
<form method="POST" action="{{ route('admin.subjects.update',$subject) }}" class="bg-white p-4 rounded shadow max-w-xl">
@csrf @method('PUT')
<label class="block mb-1">Nama Mapel</label>
<input name="name" value="{{ old('name',$subject->name) }}" class="border rounded w-full p-2 mb-3" required>
<label class="block mb-1">Nama Guru</label>
<input name="teacher" value="{{ old('teacher',$subject->teacher) }}" class="border rounded w-full p-2 mb-3" required>
<label class="block mb-1">Kelas</label>
<select name="kelas_id" class="border rounded w-full p-2 mb-3" required>
  @foreach($kelas as $k)
    <option value="{{ $k->id }}" @selected($subject->kelas_id==$k->id)>{{ $k->name }}</option>
  @endforeach
</select>
<button class="px-3 py-1 bg-blue-600 text-white rounded">Update</button>
</form>
@endsection
