<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Market\Notification;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function readAll()
    {
       $notifications = Notification::all();
       foreach ($notifications as $notification)
       {
            $notification -> update(['read_at' => now()]);
       }

    }
}
