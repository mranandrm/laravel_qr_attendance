<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReportController extends Controller
{
    public function generateReport()
    {
    
        $presentAttendees = Attendance::where('attendance_time', '!=', null)->get();
        $absentAttendees = Attendance::where('attendance_time', '=', null)->get();
    
        $data = [
            'presentAttendees' => $presentAttendees,
            'absentAttendees' => $absentAttendees,
        ];        

        $attendanceReportContent = view('report', $data)->render();

        $pdf = PDF::loadHtml($attendanceReportContent);

        return $pdf->stream('Attendance Report.pdf');
        
    }

    public function generateReport2()
    {
        // Get present and absent attendees
        $presentAttendees = Attendance::where('attendance_time', '!=', null)->get();
        $absentAttendees = Attendance::where('attendance_time', '=', null)->get();

        // Load the view with present and absent attendees data
        $pdf = $this->generatePDF('report', compact('presentAttendees', 'absentAttendees'));

        // Output the PDF
        return response($pdf->stream())->header('Content-Type', 'application/pdf');
    }

    private function generatePDF($view, $data)
    {
        // Create a new Dompdf instance
        $dompdf = new Dompdf();

        // Load the HTML content from the view
        $html = view($view, $data)->render();

        // Load options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        // Set options
        $dompdf->setOptions($options);

        // Load the HTML to Dompdf
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Return the generated PDF instance
        return $dompdf;        
    }
}
