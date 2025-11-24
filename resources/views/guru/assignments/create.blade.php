@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Buat Tugas Baru</h1>

<form method="POST" action="{{ route('guru.assignments.store') }}" enctype="multipart/form-data"
    class="bg-white p-4 rounded shadow max-w-xl">
    @csrf

    <label>Mapel</label>
    <select name="subject_id" class="border rounded w-full p-2 mb-3" required>
        @foreach($subjects as $s)
        <option value="{{ $s->id }}">{{ $s->name }}</option>
        @endforeach
    </select>

    <label>Judul</label>
    <input name="title" class="border rounded w-full p-2 mb-3" required>

    <label>Deskripsi</label>
    <textarea name="description" class="border rounded w-full p-2 mb-3"></textarea>

    <label>File (opsional)</label>
    <input type="file" name="file" class="mb-3">

    <label>Deadline</label>
    <input type="datetime-local" name="deadline" class="border rounded w-full p-2 mb-3">

    <button class="px-3 py-1 bg-blue-600 text-white rounded">Buat</button>
</form>
@endsection