<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Event;
use App\Models\TicketType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            abort(403, 'เฉพาะผู้ดูแลระบบ (Admin) เท่านั้นที่สามารถเข้าถึงหน้านี้ได้');
        }

        $totalRevenue = Booking::where('payment_status', 'paid')->sum('total_amount');
        $totalBookings = Booking::count();
        $totalTicketsSold = BookingItem::count();
        $totalCheckedIn = BookingItem::where('is_checked_in', true)->count();

        $bookings = Booking::with(['event', 'items.ticketType'])
            ->latest()
            ->paginate(15);

        $ticketTypes = TicketType::with('event')->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalBookings',
            'totalTicketsSold',
            'totalCheckedIn',
            'bookings',
            'ticketTypes'
        ));
    }

    public function toggleCheckIn(Request $request, $itemId)
    {
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $item = BookingItem::findOrFail($itemId);
        $item->is_checked_in = !$item->is_checked_in;
        $item->checked_in_at = $item->is_checked_in ? Carbon::now() : null;
        $item->save();

        return back()->with('success', 'อัปเดตสถานะเช็คอินสำหรับ ' . $item->attendee_name . ' เรียบร้อยแล้ว');
    }
}
