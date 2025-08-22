<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// 👇 NUEVO
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index() {
        return Report::where('user_id', Auth::id())->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $data['user_id'] = Auth::id();
        return Report::create($data);
    }

    public function updateStatus(Request $request, Report $report) {
        $this->authorize('update', $report);
        $request->validate(['status' => 'required|in:pending,in_review,resolved']);
        $report->update(['status' => $request->status]);
        return $report;
    }

    // 👇 NUEVOS MÉTODOS
   public function exportPdf()
{
    $reports = Report::where('user_id', Auth::id())->get();

    $pdf = Pdf::loadView('pdf', compact('reports'))
              ->setPaper('a4', 'portrait');

    return $pdf->download('mis_incidencias.pdf');
}
}
