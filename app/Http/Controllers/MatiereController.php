<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Http\Requests\StoreMatiereRequest;
use App\Http\Requests\UpdateMatiereRequest;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $matieres = Matiere::all();
           
            return view('admin.matieres.index', compact('matieres',))->with('message', 'Operation reussi');
                   
        }
        catch(\Exception $e){
            return view('admin.matieres.index', compact('matieres',))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $matieres=Matiere::all();
           
            return view('admin.matieres.create', compact("matieres"));
        }
        catch(\Exception $e){
           return redirect(route('matieres.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMatiereRequest $request)
    {
        try{
            $matieres = new Matiere();
           /* $validatedData = $request->validate([
                'matricule'=> 'required|unique:matieres|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nommatiere' => 'required|min:3|max:100',
                'prenommatiere' => 'required|min:3|max:100',
                 
            ]);*/
            //$matieres->idMatiere = $request->idMatiere;

            $matieres->intitule = $request->intitule;
            
            $matieres->codeMatiere = $request->codeMatiere;

            $matieres->duree = $request->duree;
            
            $matieres->save();
    
            return redirect()->route('matieres.index')->with('message', 'La matiere a été creé avec succès');
        }
        catch(\Exception $e){
            return redirect()->route('matieres.index')->with('error', 'La matiere n\'a pas été creé');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Matiere $matiere)
    {
        try{
       
            return view('admin.matieres.show', compact('matiere'));
        }
        catch(\Exception $e){
           return redirect(route('matieres.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matiere $matiere)
    {
        try{
            
           
            return view('admin.matieres.edit', compact('matiere'));
        }
        catch(\Exception $e){
           return redirect(route('matieres.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMatiereRequest $request, Matiere $matiere)
    {
        try{
            $matieres = Matiere::find($matiere->id);
            /*$validatedData = $request->validate([
                'matricule'=> 'required|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nommatiere' => 'required|min:3|max:100',
                'prenommatiere' => 'required|min:3|max:100',
                 
            ]);*/
            $matieres->intitule = $request->intitule;
            
            $matieres->codeMatiere = $request->codeMatiere;

            $matieres->duree = $request->duree;
            
           
            $matieres->save();
    
            return redirect()->route('matieres.index', $matieres)->with('message1', 'La matiere a été modifier avec succes');
        }
        catch(\Exception $e){
           return redirect(route('matieres.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matiere $matiere)
    {
        try{         
           
            $matiere->delete();

            return redirect()->route('matieres.index')->with('danger', 'La matiere a été supprimée avec succès.');
    }
    catch(\Exception $e){
       return redirect(route('matieres.index'))->with('error', 'Operation echoue!');
    }
    }
}
