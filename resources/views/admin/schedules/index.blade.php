@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-3">
  <h2 class="text-xl font-semibold">Daftar Jadwal</h2>
  <a href="{{ route('admin.schedules.create') }}" class="px-3 py-1 bg-blue-600 text-white rounded">Tambah</a>
</div>
<div class="bg-white rounded shadow overflow-x-auto">
  <table class="min-w-full">
    <thead>
      <tr class="bg-gray-50 text-left">
        <th class="p-2">Hari</th><th class="p-2">Kelas</th><th class="p-2">Mapel</th>
        <th class="p-2">Jam</th><th class="p-2">Ruang</th><th class="p-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($items as $s)
      <tr class="border-t">
        <td class="p-2">{{ $s->day_of_week }}</td>
        <td class="p-2">{{ $s->kelas->name ?? '-' }}</td>
        <td class="p-2">{{ $s->subject->name ?? '-' }}</td>
        <td class="p-2">{{ $s->start_time }} - {{ $s->end_time }}</td>
        <td class="p-2">{{ $s->room }}</td>
        <td class="p-2 flex gap-2">
          <a href="{{ route('admin.schedules.edit',$s) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
          <form action="{{ route('admin.schedules.destroy',$s) }}" method="POST" onsubmit="return confirm('Hapus?')">
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
