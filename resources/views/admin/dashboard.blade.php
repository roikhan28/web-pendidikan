@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Dashboard Admin</h2>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        @foreach($counts as $k => $v)
            <div class="bg-white shadow rounded-lg p-4 text-center">
                <p class="text-gray-500 uppercase text-sm">{{ strtoupper($k) }}</p>
                <p class="text-2xl font-semibold text-blue-600">{{ $v }}</p>
            </div>
        @endforeach
    </div>

    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.kelas.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Kelola Kelas</a>
        <a href="{{ route('admin.subjects.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Kelola Mapel</a>
        <a href="{{ route('admin.schedules.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Kelola Jadwal</a>
        <a href="{{ route('admin.exams.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Kelola Ujian</a>
        <a href="{{ route('admin.users.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Kelola User</a>
        <a href="{{ route('admin.notifications.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Broadcast Notifikasi</a>
    </div>
@endsection
