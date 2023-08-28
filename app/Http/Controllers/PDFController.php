<?php

namespace App\Http\Controllers;

use App\Mail\SendPDFMail;
use Illuminate\Http\Request;
use PDF;
use Mail;
use Session;

class PDFController extends Controller
{
    public function index(Request $request)
    {
        $data["number"] = $request->input('id_order');
        $data["fio"] = $request->input('fio');
        $data["date"] = $request->input('date');
        $data["discount"] = $request->input('discount');
        $data["sum_price"] = $request->input('sum_price');
        $data["products"] = $request->input('products');

        $options = [
//            'fontDir' => public_path('fonts/'),
            'defaultPaperSize' => 'A4',
//            'defaultFont' => 'Montserrat',
            'isRemoteEnabled' => true,
            'defaultCharset' => 'UTF-8',
            'chroot' => public_path(),
            'isHtml5ParserEnabled' => true,
            'isFontSubsettingEnabled' => true
        ];

        PDF::setOptions($options);

        $pdf = PDF::loadView('orderMail', $data);
        $pdf2 = PDF::loadView('chekMail', $data);


        Mail::to($request->input('email'))->send(new SendPDFMail($pdf, $pdf2,$data["number"])); //email user

        return redirect()->route('office_view')->with('alert', 'Заказ выдан, документы отправлены на email!');

    }
}
