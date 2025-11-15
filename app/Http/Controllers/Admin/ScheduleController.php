<?php
// app/Http/Controllers/Admin/ScheduleController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Kelas;
use App\Models\Subject;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index() {
        $items = Schedule::with(['kelas','subject'])->orderBy('day_of_week')->orderBy('start_time')->paginate(15);
        return view('admin.schedules.index', compact('items'));
    }
    public function create() {
        return view('admin.schedules.create', [
            'kelas' => Kelas::all(),
            'subjects' => Subject::all()
        ]);
    }
    public function store(Request $r) {
        $d = $r->validate([
            'kelas_id'=>'required|exists:kelas,id',
            'subject_id'=>'required|exists:subjects,id',
            'day_of_week'=>'required|integer|min:1|max:7',
            'start_time'=>'required',
            'end_time'=>'required|after:start_time',
            'room'=>'nullable|string'
        ]);
        // Cek konflik
        $conflict = Schedule::where('kelas_id',$d['kelas_id'])
            ->where('day_of_week',$d['day_of_week'])
            ->where(function($q) use ($d){
                $q->whereBetween('start_time', [$d['start_time'],$d['end_time']])
                  ->orWhereBetween('end_time', [$d['start_time'],$d['end_time']])
                  ->orWhere(function($qq)use($d){ $qq->where('start_time','<=',$d['start_time'])->where('end_time','>=',$d['end_time']); });
            })->exists();
        if ($conflict) return back()->withErrors(['start_time'=>'Konflik jadwal'])->withInput();

        Schedule::create($d);
        return redirect()->route('admin.schedules.index')->with('status','Jadwal dibuat');
    }
    public function edit(Schedule $schedule) {
        return view('admin.schedules.edit', [
            'item'=>$schedule,'kelas'=>Kelas::all(),'subjects'=>Subject::all()
        ]);
    }
    public function update(Request $r, Schedule $schedule) {
        $d = $r->validate([
            'kelas_id'=>'required|exists:kelas,id',
            'subject_id'=>'required|exists:subjects,id',
            'day_of_week'=>'required|integer|min:1|max:7',
            'start_time'=>'required',
            'end_time'=>'required|after:start_time',
            'room'=>'nullable|string'
        ]);
        // cek konflik (kecuali diri sendiri)
        $conflict = Schedule::where('id','<>',$schedule->id)
            ->where('kelas_id',$d['kelas_id'])
            ->where('day_of_week',$d['day_of_week'])
            ->where(function($q) use ($d){
                $q->whereBetween('start_time', [$d['start_time'],$d['end_time']])
                  ->orWhereBetween('end_time', [$d['start_time'],$d['end_time']])
                  ->orWhere(function($qq)use($d){ $qq->where('start_time','<=',$d['start_time'])->where('end_time','>=',$d['end_time']); });
            })->exists();
        if ($conflict) return back()->withErrors(['start_time'=>'Konflik jadwal'])->withInput();

        $schedule->update($d);
        return back()->with('status','Jadwal diubah');
    }
    public function destroy(Schedule $schedule) { $schedule->delete(); return back()->with('status','Jadwal dihapus'); }
}
