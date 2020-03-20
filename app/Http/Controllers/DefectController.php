<?php

namespace App\Http\Controllers;

use App\Defects;
use Illuminate\Http\Request;


class DefectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:defect-list|defect-create|defect-edit|defect-delete', ['only' => ['index','show']]);
        $this->middleware('permission:defect-create', ['only' => ['create','store']]);
        $this->middleware('permission:defect-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:defect-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $defects = Defects::latest()->paginate(10);
        return view('defects.index',compact('defects'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('defects.create');
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
            'description' => 'required',
            'priority' => 'required',
        ]);

        Defects::create($request->all());

        return redirect()->route('defects.index')
            ->with('success','Defect created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Defects  $defect
     * @return \Illuminate\Http\Response
     */
    public function show(Defects $defect)
    {
        return view('defects.show',compact('defect'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Defects  $defect
     * @return \Illuminate\Http\Response
     */
    public function edit(Defects $defect)
    {
        return view('defects.edit',compact('defect'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Defects  defect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Defects $defect)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $defect->update($request->all());

        return redirect()->route('defects.index')
            ->with('success','Defect updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Defects  $defect
     * @return \Illuminate\Http\Response
     */
    public function destroy(Defects $defect)
    {
        $defect->delete();

        return redirect()->route('defects.index')
            ->with('success','Defect deleted successfully');
    }
}
