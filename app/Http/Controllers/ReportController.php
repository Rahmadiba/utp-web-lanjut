<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    public function report1($pid){
        
    $payment = Payment::find($pid);
    $pdf = App::make('dompdf.wrapper');
    $print = "<div style='margin:20px; padding: 20px;'>";
    
    $print .= "<h1 align='center'> Payment Receipt </h1>";
    $print .= "<hr/>";
    $print .= "<p> Receipt No: <b>" . $pid . "</b> </p>";
    $print .= "<p> Date: <b>" . $payment->paid_date . "</b></p>";
    $print .= "<p> Enrollment No: <b>" . ($payment->enrollment->enroll_no ?? 'N/A') . "</b></p>";
    $print .= "<p> Student Name: <b>" . ($payment->enrollment->student->name ?? 'N/A') . "</b></p>";
    
    $print .= "<hr/>";
    $print .= "<table style='width: 100%; border-collapse: collapse;' border='1'>";
    $print .= "<tr>";
    $print .= "<th>Batch</th>";
    $print .= "<th>Amount</th>";
    $print .= "</tr>";
    $print .= "<tr>";
    $print .= "<td>" . ($payment->enrollment->batch->name ?? 'N/A') . "</td>";
    $print .= "<td>" . number_format($payment->amount, 2) . "</td>";
    $print .= "</tr>";
    $print .= "</table>";
    $print .= "<hr/>";
    
    $printedBy = Auth::check() ? Auth::user()->name : 'Guest';
    $print .= "<p> Printed By: <b>" . $printedBy . "</b></p>";
    $print .= "<p> Printed Date: <b>" . date('Y-m-d') . "</b></p>";
    
    $print .= "</div>";
    
    $pdf->loadHTML($print);
    return $pdf->stream("receipt_$pid.pdf");
    
}
}
?>