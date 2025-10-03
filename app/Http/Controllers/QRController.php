<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
     public function generateQrCode($eventId)
    {
        $event = Event::find($eventId);

        $qr_info = $event->id . "&" .$event->name . "&" . $event->date . "&" . $event->location;

        $qrCode = QrCode::size(300)->generate($qr_info);

    
        return view('qr', compact(['event', 'qrCode']));
    }

}
