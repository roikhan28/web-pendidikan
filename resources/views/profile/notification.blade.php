@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Notifikasi</h1>
<div class="bg-white rounded shadow divide-y">
@foreach($notifications as $n)
  <div class="p-3 flex justify-between items-center">
    <div>
      <div class="font-semibold">{{ $n->title }}</div>
      <div class="text-sm text-gray-600">{{ $n->body }}</div>
      <div class="text-xs text-gray-400">{{ $n->created_at->format('d/m/Y H:i') }}</div>
    </div>
    <div>
      @if(!$n->read_at)
        <form method="POST" action="{{ route('profile.notifications.read',$n->id) }}">
          @csrf
          <button class="px-2 py-1 bg-green-600 text-white rounded">Tandai Dibaca</button>
        </form>
      @else
        <span class="text-xs text-green-700">Sudah dibaca</span>
      @endif
    </div>
  </div>
@endforeach
</div>
<div class="mt-3">{{ $notifications->links() }}</div>
@endsection
