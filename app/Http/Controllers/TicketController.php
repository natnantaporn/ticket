<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Show logged in user's tickets
     */
    public function myTickets()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('info', 'กรุณาเข้าสู่ระบบเพื่อดูตั๋วของคุณ หรือค้นหาด้วยรหัสการจอง');
        }

        $bookings = Booking::with(['event', 'items.ticketType'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('tickets.my-tickets', compact('bookings'));
    }

    /**
     * Show specific booking and printable E-Ticket
     */
    public function show(string $bookingCode)
    {
        $booking = Booking::with(['event', 'items.ticketType'])
            ->where('booking_code', $bookingCode)
            ->orWhere('qr_token', $bookingCode)
            ->firstOrFail();

        $qrWriter = new SvgWriter();
        $ticketQrCodes = $booking->items->mapWithKeys(function ($item) use ($qrWriter) {
            $qrCode = QrCode::create($item->ticket_code)
                ->setSize(160)
                ->setMargin(10);

            return [$item->id => $qrWriter->write($qrCode)->getDataUri()];
        });

        return response()
            ->view('tickets.show', compact('booking', 'ticketQrCodes'))
            ->header('Cache-Control', 'no-store, private')
            ->header('Pragma', 'no-cache');
    }

    /**
     * Guest lookup booking form and handler
     */
    public function lookup(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'booking_code' => ['required', 'string'],
            ], [
                'booking_code.required' => 'กรุณาระบุรหัสการจอง',
            ]);

            $code = trim(strtoupper($request->booking_code));
            $booking = Booking::where('booking_code', $code)
                ->orWhere('qr_token', $code)
                ->first();

            if ($booking) {
                return redirect()->route('tickets.show', $booking->booking_code);
            }

            return back()->with('error', "ไม่พบข้อมูลการจองสำหรับรหัส {$code} กรุณาตรวจสอบความถูกต้อง")->withInput();
        }

        return view('tickets.lookup');
    }
}
