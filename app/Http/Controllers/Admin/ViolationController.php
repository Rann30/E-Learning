<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViolationCard;
use App\Models\Student;
use App\Models\ActivityLog;

class ViolationController extends Controller
{
    public function index()
    {
        $violations = ViolationCard::with('student.user')
            ->latest()
            ->paginate(20);

        return view('admin.violations.index', compact('violations'));
    }

    public function create()
    {
        $students = Student::with('user')->get();
        return view('admin.violations.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'card_number' => 'required|string|unique:violation_cards,card_number',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $violation = ViolationCard::create($request->all());

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'ViolationCard',
            'model_id' => $violation->id,
            'description' => 'Created violation card: ' . $violation->card_number,
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('admin.violations.index')
            ->with('success', 'Kartu pelanggaran berhasil dibuat!');
    }

    public function destroy($id)
    {
        $violation = ViolationCard::findOrFail($id);
        $cardNumber = $violation->card_number;
        $violation->delete();

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'ViolationCard',
            'model_id' => $id,
            'description' => 'Deleted violation card: ' . $cardNumber,
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('admin.violations.index')
            ->with('success', 'Kartu pelanggaran berhasil dihapus!');
    }
}
