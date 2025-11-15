@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-3">
  <h2 class="text-xl font-semibold">Daftar Kelas</h2>
  <a href="{{ route('admin.kelas.create') }}" class="px-3 py-1 bg-blue-600 text-white rounded">Tambah</a>
</div>
<div class="bg-white rounded shadow overflow-x-auto">
  <table class="min-w-full">
    <thead><tr class="bg-gray-50 text-left">
      <th class="p-2">ID</th><th class="p-2">Nama</th><th class="p-2">Aksi</th>
    </tr></thead>
    <tbody>
      @foreach($items as $it)
      <tr class="border-t">
        <td class="p-2">{{ $it->id }}</td>
        <td class="p-2">{{ $it->name }}</td>
        <td class="p-2 flex gap-2">
          <a class="px-2 py-1 bg-yellow-500 text-white rounded" href="{{ route('admin.kelas.edit',$it) }}">Edit</a>
          <form method="POST" action="{{ route('admin.kelas.destroy',$it) }}" onsubmit="return confirm('Hapus?')">
            @csrf @method('DELETE')
            <button class="px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
          </form>
          <a class="px-2 py-1 bg-gray-700 text-white rounded" href="{{ route('admin.pdf.jadwal.kelas',$it) }}">PDF Jadwal</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="mt-3">{{ $items->links() }}</div>
@endsection
