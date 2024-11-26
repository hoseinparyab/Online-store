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
    public function show(Ticket $ticket)

    {
        return view('customer.profile.show-ticket', compact('ticket'));

    }
    public function change(Ticket $ticket)
    {
        $ticket->status = $ticket->status == 0 ? 1 : 0;
        $result = $ticket->save();
        return redirect()->back()->with('swal-success', 'تغییر شما با موفقیت انجام  شد');
    }
}
