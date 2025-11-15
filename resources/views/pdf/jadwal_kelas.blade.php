<!doctype html><html><head><meta charset="utf-8"><style>
table{width:100%;border-collapse:collapse}th,td{border:1px solid #333;padding:6px;font-size:12px}
</style></head><body>
<h3>Jadwal Kelas: {{ $kelas->name }}</h3>
<table>
<thead><tr><th>Mapel</th><th>Guru</th><th>Hari</th><th>Waktu</th><th>Ruang</th></tr></thead>
<tbody>
@foreach($kelas->subjects as $subj)
  @foreach($subj->schedules->sortBy(['day_of_week','start_time']) as $s)
    <tr>
      <td>{{ $subj->name }}</td>
      <td>{{ $subj->teacher }}</td>
      <td>{{ $s->day_of_week }}</td>
      <td>{{ $s->start_time }} - {{ $s->end_time }}</td>
      <td>{{ $s->room }}</td>
    </tr>
  @endforeach
@endforeach
</tbody>
</table>
</body></html>
