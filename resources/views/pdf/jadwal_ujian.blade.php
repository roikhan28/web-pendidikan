<!doctype html><html><head><meta charset="utf-8"><style>
table{width:100%;border-collapse:collapse}th,td{border:1px solid #333;padding:6px;font-size:12px}
</style></head><body>
<h3>Jadwal Ujian</h3>
<table>
<thead><tr><th>Tanggal</th><th>Waktu</th><th>Kelas</th><th>Mapel</th><th>Lokasi</th></tr></thead>
<tbody>
@foreach($exams as $e)
<tr>
<td>{{ \Carbon\Carbon::parse($e->date)->format('d/m/Y') }}</td>
<td>{{ $e->start_time }} - {{ $e->end_time }}</td>
<td>{{ $e->subject->kelas->name }}</td>
<td>{{ $e->subject->name }}</td>
<td>{{ $e->location }}</td>
</tr>
@endforeach
</tbody>
</table>
</body></html>
