<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Slot;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Response;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tutors = Tutor::all()->pluck('name','id');

        return view('dashboard', compact('tutors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $insert = Appointment::create([
                'event_date' => $request->date,
                'tutor_id' => $request->tutor_id,
                'slot_id' => $request->slot_id
            ]);

            if ($insert)
                $msg = 'Data has been successfully stored!';
            else
                $msg = 'Something went wrong!!';

            return redirect()->route('dashboard')->with('message', $msg);

        } catch (Exception $e) {
            Log::error('ERROR '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getAppointmentSlots(Request $request)
    {
        try {
            $slots = Appointment::where('tutor_id',$request->tutor_id)->where('event_date',$request->date)->get()->pluck('slot_id')->toArray();

            $available_slots = Slot::select('name','id')->whereNotIn('id',$slots)->get();

            return Response::json([
                    "type" => "success",
                    "data" => $available_slots
                ]);

        } catch (Exception $e) {
            Log::error('ERROR '.$e->getMessage());
        }
    }
}
