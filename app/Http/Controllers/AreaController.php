<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{

    public function index()
    {
        return view('areas.index')->with('areas',Area::all());
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {
        $area = \App\Area::create($request->all());
        return redirect('/areas');
    }

    public function show(Area $area)
    {
        return view('areas.show')->with('area', $area);
    }

    public function edit(Area $area)
    {
        return view('areas.edit')->with('area', $area);
    }


    public function update(Request $request, Area $area)
    {
        $area->update($request->all());
        return redirect('/areas');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect('/areas');

    }
}
