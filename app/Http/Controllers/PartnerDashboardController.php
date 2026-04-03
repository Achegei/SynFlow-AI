<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CertificateRequest;
use Illuminate\Support\Facades\Auth;

class PartnerDashboardController extends Controller
{
    // Show dashboard
    public function index()
    {
        $partner = Auth::user(); // currently logged-in partner

        // Fetch all certificate requests for this partner
        $requests = CertificateRequest::where('partner_id', $partner->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Calculate total students (sum of all certificate requests)
        $totalStudents = $requests->sum('student_count');

        // Calculate pending and completed certificates
        $pendingCertificates = $requests->where('certificate_status', 'pending')->count();
        $completedCertificates = $requests->where('certificate_status', 'delivered')->count();

        return view('partner.dashboard', compact(
            'requests',
            'totalStudents',
            'pendingCertificates',
            'completedCertificates'
        ));
    }

    // Show certificate request form
    public function showRequestForm()
    {
        return view('partner.certificate_request_form');
    }

    // Store a new certificate request
    public function storeCertificateRequest(Request $request)
        {
            $request->validate([
                'student_count' => 'required|integer|min:1',
                'total_amount' => 'required',
                'student_file' => 'required|file|mimes:csv,xlsx,xls|max:2048',
            ]);

            $partner = Auth::user();

            // Store file
            $filePath = $request->file('student_file')->store('student_lists', 'public');
            // Store file (ONLY ONCE)
            $studentFile = $request->file('student_file') 
                ? $request->file('student_file')->store('certificate_uploads', 'public') 
                : null;

            // Clean total amount (ONLY ONCE)
            $totalAmount = preg_replace('/[^0-9.]/', '', $request->total_amount);

            CertificateRequest::create([
                'partner_id' => $partner->id,
                'student_count' => $request->student_count,
                'total_amount' => $totalAmount,
                'student_file' => $filePath, // NEW COLUMN
                'payment_status' => 'pending',
                'certificate_status' => 'pending',
                'student_file' => $studentFile,
            ]);

            return redirect()->route('partner.dashboard')
                            ->with('success', 'Certificate request submitted successfully.');
        }

    // Show certificate status page
    public function certificateStatus()
    {
        $partner = auth()->user(); // currently logged-in partner

        $requests = CertificateRequest::where('partner_id', $partner->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('partner.certificate_status', compact('requests'));
    }
}