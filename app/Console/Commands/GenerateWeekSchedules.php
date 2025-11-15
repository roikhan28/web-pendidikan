<!doctype html><html><head><meta charset="utf-8"><style>
table{width:100%;border-collapse:collapse}th,td{border:1px solid #333;padding:6px;font-size:12px}
</style></head><body>
<h3>Jadwal Siswa</h3>
<h4>Pelajaran</h4>
<table>
<thead><tr><th>Hari</th><th>Waktu</th><th>Mapel</th><th>Ruang</th></tr></thead>
<tbody>
@foreach($jadwal as $s)
<tr>
<td>{{ $s->day_of_week }}</td>
<td>{{ $s->start_time }} - {{ $s->end_time }}</td>
<td>{{ $s->subject->name }}</td>
<td>{{ $s->room }}</td>
</tr>
@endforeach
</tbody>
</table>

<h4 style="margin-top:12px;">Ujian</h4>
<table>
<thead><tr><th>Tanggal</th><th>Waktu</th><th>Mapel</th><th>Lokasi</th></tr></thead>
<tbody>
@foreach($ujian as $e)
<tr>
<td>{{ \Carbon\Carbon::parse($e->date)->format('d/m/Y') }}</td>
<td>{{ $e->start_time }} - {{ $e->end_time }}</td>
<td>{{ $e->subject->name }}</td>
<td>{{ $e->location }}</td>
</tr>
@endforeach
</tbody>
</table>
</body></html>
