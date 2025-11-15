<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">
<nav class="bg-white shadow">
  <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
    <div class="font-semibold text-lg">
      <a href="{{ route('redirect.role') }}">{{ config('app.name') }}</a>
    </div>
    <div class="flex items-center gap-4">
      <a href="{{ route('profile.notifications') }}" class="relative">
        Notifikasi
        @php $unread = auth()->user()->notifications()->whereNull('read_at')->count(); @endphp
        @if($unread)
          <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs rounded-full px-1">{{ $unread }}</span>
        @endif
      </a>
      <a href="{{ route('profile.edit') }}">Profil</a>
      <div class="flex items-center gap-2">
        @php $av = auth()->user()->avatar_path; @endphp
        @if($av)
          <img src="{{ asset('storage/'.$av) }}" class="w-8 h-8 rounded-full object-cover" alt="avatar">
        @else
          <div class="w-8 h-8 rounded-full bg-gray-300"></div>
        @endif
        <span>{{ auth()->user()->name }}</span>
      </div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="px-3 py-1 bg-gray-800 text-white rounded">Logout</button>
      </form>
    </div>
  </div>
</nav>
<main class="max-w-7xl mx-auto p-4">
  @if(session('status'))
    <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('status') }}</div>
  @endif
  @if($errors->any())
    <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
      <ul class="ml-4 list-disc">
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif
  @yield('content')
</main>
</body>
</html>
