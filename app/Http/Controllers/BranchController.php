<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('branches.index');
    }

    /**
     * Display a create of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        return view('branches.create');
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
            'name' => 'required',
            'location' => 'required'
        ]);

        try {
            Branch::create([
                'name' => $request->name,
                'location' => $request->location,
                'created_at' => now(),
                'created_by' => $user->id,
            ]);

            return redirect(route('branches.create'))->with('success', 'Data berhasil disimpan.');
        } catch (Exception $e) {
            return redirect(route('branches.create'))->with('failed', 'Data gagal disimpan. Error: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        return view('branches.show');
    }

    /**
     * Display an edit of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {

        $model = Branch::find($req->id);

        return view('branches.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required'
        ]);

        $branch = Branch::find($request->id);
        $branch->name = $request->name;
        $branch->location = $request->location;
        $branch->updated_at = now();
        $branch->save();

        return redirect(route('branches.edit', $request->id))->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        return null;
    }
}
