<?php
// app/Http/Controllers/Admin/SubjectController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index() { $items = Subject::with('kelas')->latest()->paginate(10); return view('admin.subjects.index', compact('items')); }
    public function create() { $kelas = Kelas::all(); return view('admin.subjects.create', compact('kelas')); }
    public function store(Request $r) {
        $d = $r->validate(['name'=>'required','teacher'=>'required','kelas_id'=>'required|exists:kelas,id']);
        Subject::create($d); return redirect()->route('admin.subjects.index')->with('status','Mapel dibuat');
    }
    public function edit(Subject $subject) { $kelas = Kelas::all(); return view('admin.subjects.edit', compact('subject','kelas')); }
    public function update(Request $r, Subject $subject) {
        $d = $r->validate(['name'=>'required','teacher'=>'required','kelas_id'=>'required|exists:kelas,id']);
        $subject->update($d); return back()->with('status','Mapel diubah');
    }
    public function destroy(Subject $subject) { $subject->delete(); return back()->with('status','Mapel dihapus'); }
}
