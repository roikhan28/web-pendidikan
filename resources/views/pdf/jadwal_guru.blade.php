<!doctype html><html><head><meta charset="utf-8"><style>
table{width:100%;border-collapse:collapse}th,td{border:1px solid #333;padding:6px;font-size:12px}
</style></head><body>
<h3>Jadwal Mengajar: {{ $name }}</h3>
<table>
<thead><tr><th>Hari</th><th>Waktu</th><th>Kelas</th><th>Mapel</th><th>Ruang</th></tr></thead>
<tbody>
@foreach($items as $s)
<tr>
<td>{{ $s->day_of_week }}</td>
<td>{{ $s->start_time }} - {{ $s->end_time }}</td>
<td>{{ $s->kelas->name }}</td>
<td>{{ $s->subject->name }}</td>
<td>{{ $s->room }}</td>
</tr>
@endforeach
</tbody>
</table>
</body></html>
