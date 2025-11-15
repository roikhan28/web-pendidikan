@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-3">
  <h2 class="text-xl font-semibold">Daftar Ujian</h2>
  <a href="{{ route('admin.exams.create') }}" class="px-3 py-1 bg-blue-600 text-white rounded">Tambah</a>
</div>
<div class="bg-white rounded shadow overflow-x-auto">
  <table class="min-w-full">
    <thead>
      <tr class="bg-gray-50 text-left">
        <th class="p-2">Tanggal</th><th class="p-2">Mapel</th><th class="p-2">Kelas</th>
        <th class="p-2">Waktu</th><th class="p-2">Lokasi</th><th class="p-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($items as $e)
      <tr class="border-t">
        <td class="p-2">{{ \Carbon\Carbon::parse($e->date)->format('d/m/Y') }}</td>
        <td class="p-2">{{ $e->subject->name ?? '-' }}</td>
        <td class="p-2">{{ $e->subject->kelas->name ?? '-' }}</td>
        <td class="p-2">{{ $e->start_time }} - {{ $e->end_time }}</td>
        <td class="p-2">{{ $e->location }}</td>
        <td class="p-2 flex gap-2">
          <a href="{{ route('admin.exams.edit',$e) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
          <form action="{{ route('admin.exams.destroy',$e) }}" method="POST" onsubmit="return confirm('Hapus?')">
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
