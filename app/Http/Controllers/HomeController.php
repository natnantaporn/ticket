<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Retrieve the main featured event with ticket types
        $event = Event::with('ticketTypes')->where('status', 'active')->first();

        // If not found, get any event
        if (!$event) {
            $event = Event::with('ticketTypes')->first();
        }

        return view('home', compact('event'));
    }
}
