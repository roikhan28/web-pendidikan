@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-semibold mb-4">Tugas Kelas Saya</h1>

@foreach($assignments as $a)
<div class="bg-white p-4 rounded shadow mb-3">

    <div class="flex justify-between items-center">
        <div>
            <h3 class="font-bold text-lg">{{ $a->title }}</h3>
            <p class="text-sm text-gray-700">{{ $a->subject->name }}</p>
            <p class="text-sm text-gray-500">Deadline: {{ $a->deadline }}</p>
        </div>

        {{-- STATUS --}}
        @if(in_array($a->id, $submitted))
        <span class="px-3 py-1 bg-green-600 text-white rounded text-sm">Selesai</span>
        @else
        <span class="px-3 py-1 bg-red-600 text-white rounded text-sm">Belum Selesai</span>
        @endif
    </div>

    {{-- FORM SUBMIT HANYA MUNCUL JIKA BELUM SELESAI --}}
    @if(!in_array($a->id, $submitted))
    <form method="POST" action="{{ route('siswa.assignments.submit',$a) }}"
        enctype="multipart/form-data" class="mt-3">
        @csrf
        <input type="file" name="file" required class="border">
        <button class="px-3 py-1 bg-blue-600 text-white rounded ml-2">
            Upload Tugas
        </button>
    </form>
    @else
    <p class="mt-3 text-green-700 text-sm">Anda sudah mengumpulkan tugas ini.</p>
    @endif

</div>
@endforeach

@endsection