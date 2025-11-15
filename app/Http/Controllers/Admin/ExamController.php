<?php
// app/Http/Controllers/Admin/ExamController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index() { $items = Exam::with('subject.kelas')->orderBy('date')->paginate(15); return view('admin.exams.index', compact('items')); }
    public function create() { $subjects = Subject::with('kelas')->get(); return view('admin.exams.create', compact('subjects')); }
    public function store(Request $r) {
        $d = $r->validate([
            'subject_id'=>'required|exists:subjects,id',
            'date'=>'required|date',
            'start_time'=>'required',
            'end_time'=>'required|after:start_time',
            'location'=>'nullable|string'
        ]);
        Exam::create($d); return redirect()->route('admin.exams.index')->with('status','Ujian dibuat');
    }
    public function edit(Exam $exam) { $subjects = Subject::with('kelas')->get(); return view('admin.exams.edit', compact('exam','subjects')); }
    public function update(Request $r, Exam $exam) {
        $d = $r->validate([
            'subject_id'=>'required|exists:subjects,id',
            'date'=>'required|date',
            'start_time'=>'required',
            'end_time'=>'required|after:start_time',
            'location'=>'nullable|string'
        ]);
        $exam->update($d); return back()->with('status','Ujian diubah');
    }
    public function destroy(Exam $exam) { $exam->delete(); return back()->with('status','Ujian dihapus'); }
}
