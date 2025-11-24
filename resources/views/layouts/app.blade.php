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

  <body class="bg-gray-100">
    <nav> ... </nav>

    <div class="max-w-7xl mx-auto grid grid-cols-12 gap-4 p-4">

      {{-- Sidebar kiri --}}
      <aside class="col-span-3 bg-white p-4 rounded shadow h-fit">
        <ul class="space-y-2 text-sm">
          <li><a href="{{ route('redirect.role') }}" class="block px-2 py-1 hover:bg-gray-100 rounded">Dashboard</a></li>

          @if(auth()->user()->role=='guru')
          <li><a href="{{ route('guru.assignments.index') }}" class="block px-2 py-1 hover:bg-gray-100 rounded">Tugas Saya</a></li>
          @endif

          @if(auth()->user()->role=='siswa')
          <li><a href="{{ route('siswa.assignments.index') }}" class="block px-2 py-1 hover:bg-gray-100 rounded">Tugas Kelas</a></li>
          @endif

          

          <li><a href="{{ route('profile.edit') }}" class="block px-2 py-1 hover:bg-gray-100 rounded">Profil</a></li>

          <li>
            <form action="{{ route('logout') }}" method="POST">@csrf
              <button class="w-full text-left px-2 py-1 hover:bg-gray-100 rounded">Logout</button>
            </form>
          </li>
        </ul>
      </aside>

      {{-- Konten utama --}}
      <main class="col-span-9">
        @yield('content')
      </main>

    </div>

  </body>

  </main>
</body>

</html>