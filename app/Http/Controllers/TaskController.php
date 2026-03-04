<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('tasks', compact('tasks'));
    }


    public function update($id)
    {
        $task = Task::findOrFail($id);
        $task->status = $task->status === 'pending' ? 'done' : 'pending';
        $task->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        Task::destroy($id);
        return redirect('/');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'tanggal_mulai' => 'required|date'
    ]);

    Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'tanggal_mulai' => $request->tanggal_mulai,
        'status' => 'antrian'
    ]);

    return redirect('/');
}

public function updateStatus($id, $status)
{
    $task = Task::findOrFail($id);

    $task->status = $status;

    if ($status === 'selesai') {
        $task->tanggal_selesai = Carbon::now();
    }

    $task->save();

    return redirect('/');

}

// public function exportPDF()
// {
//     $tasks = Task::orderBy('tanggal_mulai', 'asc')->get();
//     $pdf = Pdf::loadView('tasks.pdf', compact('tasks'));
    
//     // opsi agar PDF terlihat profesional
//     $pdf->setPaper('A4', 'portrait');
    
//     return $pdf->download('task_list_' . now()->format('Ymd_His') . '.pdf');
// }

public function exportPDF(Request $request)
{
    $month = $request->query('month'); // format: "YYYY-MM"
    
    if($month) {
        [$year, $monthNum] = explode('-', $month);
        $tasks = Task::whereYear('tanggal_mulai', $year)
                     ->whereMonth('tanggal_mulai', $monthNum)
                     ->orderBy('tanggal_mulai', 'asc')
                     ->get();
    } else {
        $tasks = Task::orderBy('tanggal_mulai', 'asc')->get();
    }

    $pdf = Pdf::loadView('tasks.pdf', compact('tasks', 'month'));
    $pdf->setPaper('A4', 'portrait');

    $filename = 'task_list_' . ($month ?? now()->format('Y-m')) . '.pdf';
    return $pdf->download($filename);
}

}   
