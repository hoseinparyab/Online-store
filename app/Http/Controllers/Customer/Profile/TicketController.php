<?php

namespace App\Http\Controllers\Customer\Profile;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index() {

        $tickets = auth()->user()->tickets;

        return view('customer.profile.tickets',compact('tickets'));


    }
}
