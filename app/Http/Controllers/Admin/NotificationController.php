<?php
// app/Http/Controllers/Admin/NotificationController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $targets = ['guru','siswa']; // broadcast ke guru &/ siswa
        return view('admin.notifications.index', compact('targets'));
    }

    public function broadcast(Request $r)
    {
        $d = $r->validate([
            'role' => 'required|in:guru,siswa,all',
            'title' => 'required|string|max:255',
            'body'  => 'nullable|string',
        ]);

        $query = User::query();
        if ($d['role'] !== 'all') $query->where('role', $d['role']);
        else $query->whereIn('role',['guru','siswa']);

        $users = $query->pluck('id');
        foreach ($users as $uid) {
            Notification::create(['user_id'=>$uid, 'title'=>$d['title'], 'body'=>$d['body'] ?? null]);
        }

        return back()->with('status','Broadcast terkirim ke '.count($users).' user.');
    }
}
