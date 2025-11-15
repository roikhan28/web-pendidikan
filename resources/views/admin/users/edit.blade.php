@extends('layouts.app')
@section('content')
<h2 class="text-xl font-semibold mb-3">Edit User</h2>
<form method="POST" action="{{ route('admin.users.update',$user) }}" class="bg-white p-4 rounded shadow max-w-xl">
@csrf @method('PUT')

<label class="block mb-1">Nama</label>
<input name="name" class="border rounded w-full p-2 mb-3" value="{{ old('name',$user->name) }}" required>

<label class="block mb-1">Email</label>
<input type="email" name="email" class="border rounded w-full p-2 mb-3" value="{{ old('email',$user->email) }}" required>

<label class="block mb-1">Password (kosongkan jika tidak diubah)</label>
<input type="password" name="password" class="border rounded w-full p-2 mb-3">

<label class="block mb-1">Role</label>
<select name="role" class="border rounded w-full p-2 mb-3" required>
  <option value="admin" @selected($user->role=='admin')>Admin</option>
  <option value="guru" @selected($user->role=='guru')>Guru</option>
  <option value="siswa" @selected($user->role=='siswa')>Siswa</option>
</select>

<label class="block mb-1">Kelas</label>
<select name="kelas_id" class="border rounded w-full p-2 mb-3">
  <option value="">-- Pilih Kelas --</option>
  @foreach($kelas as $k)
    <option value="{{ $k->id }}" @selected($k->id==$user->kelas_id)>{{ $k->name }}</option>
  @endforeach
</select>

<button class="px-3 py-1 bg-blue-600 text-white rounded">Update</button>
</form>
@endsection
