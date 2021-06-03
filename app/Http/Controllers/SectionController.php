<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Only authenticated users can access.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view('sections.sections', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sections|max:255',
        ], [
            'name.required' => 'Ingrese el nombre del departamento',
            'name.unique' => 'El nombre del departamento ya está registrado',
        ]);

        section::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::user()->name,
        ]);

        session()->flash('Add', 'La sección se ha agregado con éxito');
        return redirect('/sections');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'name' => 'required|max:255|unique:sections,name,' . $id,
            'description' => 'required',
        ], [
            'name.required' => 'Ingrese el nombre del departamento',
            'name.unique' => 'El nombre del departamento ya está registrado',
            'description.required' => 'Por favor ingrese la descripción',
        ]);

        $sections = Section::find($id);
        $sections->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        session()->flash('Edit', 'La sección se ha modificado con éxito');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Section::find($id)->delete();
        session()->flash('Delete', 'La sección se ha eliminado correctamente');
        return redirect('/sections');
    }
}
