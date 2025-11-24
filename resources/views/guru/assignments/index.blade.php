@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Daftar Tugas</h1>

<a href="{{ route('guru.assignments.create') }}" class="px-3 py-1 bg-blue-600 text-white rounded mb-4 inline-block">
    + Buat Tugas Baru
</a>

<div class="bg-white rounded shadow">
    <table class="min-w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="p-2">Judul</th>
                <th class="p-2">Mapel</th>
                <th class="p-2">Deadline</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assignments as $a)
            <tr class="border-t">
                <td class="p-2">{{ $a->title }}</td>
                <td class="p-2">{{ $a->subject->name }}</td>
                <td class="p-2">{{ $a->deadline }}</td>
                <td class="p-2">
                    <a href="{{ route('guru.assignments.submissions',$a) }}" class="text-blue-600 underline">Pengumpulan</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection