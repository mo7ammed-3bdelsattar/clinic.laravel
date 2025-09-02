<?php

namespace App\Services;

use App\Models\User;
use App\Models\Booking;
use App\Services\ChatService;

class DashboardService
{

    public static function getDateFilter($filter)
    {
        $now = now();
        switch ($filter) {
            case '':
                return [$now->copy()->subYears(100), $now->copy()->addYears(100)];
            case 'today':
                return [$now->copy()->startOfDay(), $now->copy()->endOfDay()];
            case 'week':
                return [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()];
            case 'month':
                return [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()];
            case 'year':
                return [$now->copy()->startOfYear(), $now->copy()->endOfYear()];
            default:
                return [null, null];
        }
    }
    public static function getData()
    {
        $auth = auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if(!$auth->hasAnyRole(['admin', 'manager']), 403);
        $lastMembers = User::with('image')->latest()->take(4)->get();
        $count = count($lastMembers);
        $chats = ChatService::getChatList($auth->user_id);
        $doctorsCount = User::role('doctor')->count();
        $patientsCount = User::role('patient')->count();
        if (request()->has('filter')) {
            [$start, $end] = self::getDateFilter(request('filter'));
            if ($start && $end) {
                $bookings = Booking::with('patient.user', 'doctor.user')
                    ->whereBetween('created_at', [$start, $end])
                    ->paginate(10);
            }
        } else {
            $bookings = Booking::with('patient.user', 'doctor.user')->paginate(10);
        }
        $totalAmount = Booking::join('doctors', 'bookings.doctor_id', '=', 'doctors.id')
            ->where('bookings.status', 'visited')
            ->selectRaw('SUM(doctors.price) as total')
            ->pluck('total')
            ->first();
        $data = [
            'lastMembers' => $lastMembers,
            'count' => $count,
            'bookings' => $bookings,
            'chats' => $chats ?? [],
            'auth' => $auth,
            'doctorsCount' => $doctorsCount,
            'patientsCount' => $patientsCount,
            'totalAmount' => $totalAmount,
        ];
        return $data;
    }
}
