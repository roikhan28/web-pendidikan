@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-3">Edit Kelas</h2>
<form method="POST" action="{{ route('admin.kelas.update',$item) }}" class="bg-white p-4 rounded shadow">
@csrf @method('PUT')
<label class="block mb-2">Nama Kelas</label>
<input name="name" class="border rounded w-full p-2 mb-3" required value="{{ old('name',$item->name) }}">
<button class="px-3 py-1 bg-blue-600 text-white rounded">Update</button>
</form>
@endsection
