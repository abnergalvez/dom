<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

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
        ini_set('memory_limit','256M');
        if($request->document)
        {
            $extension = $request->file('document')->getClientOriginalExtension();
            $path = $request->file('document')->storeAs('public/documents',$request->code.'.'.$extension);
            $request->request->add(['path' => $path]);
        }

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
        ini_set('memory_limit','256M');
            if($request->document){
                if ($area->path){
                    Storage::delete($area->path);
                }
            $extension = $request->file('document')->getClientOriginalExtension();
            $path = $request->file('document')->storeAs('public/documents',$request->code.'.'.$extension);
            $request->request->add(['path' => $path]);
            }
        $area->update($request->all());
        return redirect('/areas');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect('/areas');

    }
}
