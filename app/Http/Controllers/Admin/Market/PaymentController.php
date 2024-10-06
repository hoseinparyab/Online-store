<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Payment;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('admin.market.payment.index', compact('payments'));
    }
    public function online()
    {
        return view("admin.market.payment.index");
    }
    public function offline()
    {
        return view("admin.market.payment.index");
    }
    public function attendance()
    {
        return view("admin.market.payment.index");
    }
    public function confirm()
    {
        return view("admin.market.payment.index");
    }
}
