<?php

namespace App\Http\Controllers;

use App\Mail\BookingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function __invoke(){
        $data =[
            'bookingNumber'   =>'221932',
            'doctorName'      =>'Negga',
            'patientName'     =>'Mohammed',
            'date'            =>'wed/22-10-2024/12pm',
        ];
        Mail::to('Mohammedabdelsattar2@gmail.com')->send(new BookingMail($data));
        dd('success');
    }
}
