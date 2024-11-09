<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Models\Market\Province;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return view('customer.profile.my-addresses', compact('provinces'));
    }
}
