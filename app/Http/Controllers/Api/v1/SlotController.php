<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SlotTimingResource;
use App\Http\Resources\UserResource;
use App\Models\DayModal;
use App\Models\SlotModal;
use App\Models\SlotTimingModal;
use App\Models\User;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::where('role', 'doctor')->get());
    }

    public function filter($doctorId, $dayId)
    {
        $doctor = User::where('id', $doctorId)->whereHas('slots', function ($slot) use ($dayId){
            $slot->where('day_id', $dayId);
        })->first();
        return UserResource::make($doctor);
    }

    public function create(Request $request)
    {
        $request->validate([
            'doctor_id' => ['required', 'exists:users,id'],
            'day_id' => ['required', 'exists:day_modals,id'],
            'from' => ['required', 'date_format:H:i'],
            'to' => ['required', 'date_format:H:i']
        ]);

        $slotTiming = SlotTimingModal::create([
            'from' => $request->from,
            'to' => $request->to
        ]);

        $slotModal = SlotModal::create([
            'user_id' => $request->doctor_id,
            'slot_timing_id' => $slotTiming->id,
            'day_id' => $request->day_id
        ]);

        return response()->json(UserResource::make(User::find($request->doctor_id)), 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'slot_timing_id' => ['required', 'exists:slot_timing_modals,id'],
            'from' => ['nullable', 'date_format:H:i'],
            'to' => ['nullable', 'date_format:H:i']
        ]);

        $slotTiming = SlotTimingModal::find($request->slot_timing_id);
        if ($request->from) {
            $slotTiming->from = $request->from;
        }
        if ($request->to) {
            $slotTiming->to = $request->to;
        }
        $slotTiming->save();
        return response()->json(SlotTimingResource::make($slotTiming), 200);
    }
}
