<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginRegisterController extends Controller
{
    public function LoginRegisterForm()
    {
        return view('customer.auth.Login-Register');
    }
}
