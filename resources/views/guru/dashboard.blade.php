@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Dashboard Guru</h1>
<a href="{{ route('guru.pdf.jadwal') }}" class="px-3 py-1 bg-gray-800 text-white rounded mb-3 inline-block">Export PDF Jadwal Mengajar</a>
<div class="grid md:grid-cols-2 gap-4">
  <div class="bg-white p-4 rounded shadow">
    <h3 class="font-semibold mb-2">Jadwal Mengajar</h3>
    <ul class="space-y-1">
      @foreach($schedules as $s)
      <li>- Hari {{ $s->day_of_week }}, {{ $s->start_time }}-{{ $s->end_time }} | {{ $s->subject->name }} ({{ $s->kelas->name }}) @if($s->room) - {{ $s->room }} @endif</li>
      @endforeach
    </ul>
  </div>
  <div class="bg-white p-4 rounded shadow">
    <h3 class="font-semibold mb-2">Ujian Diampu</h3>
    <ul class="space-y-1">
      @foreach($exams as $e)
      <li>- {{ \Carbon\Carbon::parse($e->date)->format('d/m/Y') }} {{ $e->start_time }}-{{ $e->end_time }} | {{ $e->subject->name }} ({{ $e->subject->kelas->name }})</li>
      @endforeach
    </ul>
  </div>
</div>
@endsection
