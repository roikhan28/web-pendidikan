@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-3">
  <h2 class="text-xl font-semibold">Daftar User</h2>
  <a href="{{ route('admin.users.create') }}" class="px-3 py-1 bg-blue-600 text-white rounded">Tambah</a>
</div>
<div class="bg-white rounded shadow overflow-x-auto">
  <table class="min-w-full">
    <thead>
      <tr class="bg-gray-50 text-left">
        <th class="p-2">Nama</th>
        <th class="p-2">Email</th>
        <th class="p-2">Role</th>
        <th class="p-2">Kelas</th>
        <th class="p-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($items as $u)
      <tr class="border-t">
        <td class="p-2">{{ $u->name }}</td>
        <td class="p-2">{{ $u->email }}</td>
        <td class="p-2">{{ $u->role }}</td>
        <td class="p-2">{{ $u->kelas->name ?? '-' }}</td>
        <td class="p-2 flex gap-2">
          <a href="{{ route('admin.users.edit',$u) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
          <form method="POST" action="{{ route('admin.users.destroy',$u) }}" onsubmit="return confirm('Hapus user ini?')">>
            @csrf @method('DELETE')
            <button class="px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="mt-3">{{ $items->links() }}</div>
@endsection
