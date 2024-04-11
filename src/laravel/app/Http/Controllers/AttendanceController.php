<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User; // Userモデルをインポート
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        // ログイン中のユーザーIDを取得する必要があります
        $user = User::where('employee_id', session('employee_id'))
            ->where('password', session('password'))
            ->first();

        if ($user) {
            $attendances = Attendance::where('user_id', $user->id)
                ->whereYear('work_date', date('Y'))
                ->whereMonth('work_date', date('m'))
                ->get()
                ->map(function ($attendance) {
                    return [
                        'work_date' => Carbon::parse($attendance->work_date)->format('Y-m-d'),
                        'clock_in' => Carbon::parse($attendance->clock_in)->format('H:i'),
                        'clock_out' => Carbon::parse($attendance->clock_out)->format('H:i'),
                        'work_details' => $attendance->work_details,
                    ];
                });

                \Log::debug("attendance", $attendances->toArray());
            return view('attendance.index', compact('attendances'));
        } else {
            // ログインしていない場合の処理
            return redirect('/login');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'clock_in' => 'required|date_format:H:i',
            'clock_out' => 'required|date_format:H:i|after:clock_in',
            'work_details' => 'required',
        ]);

        // ログイン中のユーザーIDを取得する必要があります
        $user = User::where('employee_id', session('employee_id'))
            ->where('password', session('password'))
            ->first();

        if ($user) {
            $clockIn = date('Y-m-d') . ' ' . $request->clock_in; // DateTimeオブジェクトに変換
            $clockOut = date('Y-m-d') . ' ' . $request->clock_out; // DateTimeオブジェクトに変換
            Attendance::create([
                'user_id' => $user->id,
                'clock_in' => $clockIn, // DateTimeオブジェクトを渡す
                'clock_out' => $clockOut, // DateTimeオブジェクトを渡す
                'work_details' => $request->work_details,
                'work_date' => date('Y-m-d'),
            ]);

            return redirect('/attendance')->with('success', '勤怠記録が登録されました');
        } else {
            // ログインしていない場合の処理
            return redirect('/login');
        }
    }
}
