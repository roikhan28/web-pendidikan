@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Pengumpulan: {{ $assignment->title }}</h1>

<div class="bg-white rounded shadow">
    <table class="min-w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="p-2">Siswa</th>
                <th class="p-2">File</th>
                <th class="p-2">Waktu Upload</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submissions as $s)
            <tr class="border-t">
                <td class="p-2">{{ $s->siswa->name }}</td>
                <td class="p-2">
                    <a href="{{ asset('storage/'.$s->file_path) }}" class="text-blue-600 underline" download>
                        Download
                    </a>
                </td>
                <td class="p-2">{{ $s->submitted_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection