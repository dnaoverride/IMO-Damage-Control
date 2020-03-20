<?php

namespace App\Http\Controllers;

use App\Centers;
use Illuminate\Http\Request;


class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:center-list|center-create|center-edit|center-delete', ['only' => ['index','show']]);
        $this->middleware('permission:center-create', ['only' => ['create','store']]);
        $this->middleware('permission:center-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:center-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers = Centers::latest()->paginate(10);
        return view('centers.index',compact('centers'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('centers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        Centers::create($request->all());

        return redirect()->route('centers.index')
            ->with('success','Center created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Centers  $center
     * @return \Illuminate\Http\Response
     */
    public function show(Centers $center)
    {
        return view('centers.show',compact('center'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Centers  $center
     * @return \Illuminate\Http\Response
     */
    public function edit(Centers $center)
    {
        return view('centers.edit',compact('center'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Centers  center
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Centers $center)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $center->update($request->all());

        return redirect()->route('centers.index')
            ->with('success','Center updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Centers  $center
     * @return \Illuminate\Http\Response
     */
    public function destroy(Centers $center)
    {
        $center->delete();

        return redirect()->route('centers.index')
            ->with('success','Center deleted successfully');
    }
}
