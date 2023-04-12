<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('schedules.index');
    }

    /**
     * Display a create of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {

        $users = User::get();
        $branches = Branch::get();

        return view('schedules.create', compact(['users', 'branches']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'user_id' => 'required',
            'branch_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        try {
            Schedule::create([
                'user_id' => $request->user_id,
                'branch_id' => $request->branch_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'is_active' => 0,
                'created_at' => now(),
                'created_by' => $user->id,
            ]);

            return redirect(route('schedules.create'))->with('success', 'Data berhasil disimpan.');
        } catch (Exception $e) {
            return redirect(route('schedules.create'))->with('failed', 'Data gagal disimpan. Error: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        return view('schedules.show');
    }

    /**
     * Display an edit of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {
        return view('schedules.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        return null;
    }
}
