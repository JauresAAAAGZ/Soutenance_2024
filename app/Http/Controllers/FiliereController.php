<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Niveau;
use App\Http\Requests\StoreFiliereRequest;
use App\Http\Requests\UpdateFiliereRequest;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $filieres = Filiere::all();
            
           
            return view('admin.filieres.index', compact('filieres'))->with('message', 'Operation reussi');
                   
        }
        catch(\Exception $e){
            return view('admin.filieres.index', compact('filieres',))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $filieres=Filiere::all();
        $niveaux=Niveau::all();



        return view('admin.filieres.create', compact("filieres", "niveaux"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFiliereRequest $request)
    {
        try{
            $filieres = new Filiere();
           /* $validatedData = $request->validate([
                'matricule'=> 'required|unique:filieres|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nomfiliere' => 'required|min:3|max:100',
                'prenomfiliere' => 'required|min:3|max:100',
                 
            ]);*/
            //$filieres->idfiliere = $request->idfiliere;

            $filieres->nomFiliere = $request->nomFiliere;
            
            $filieres->codeFiliere = $request->codeFiliere;

            
          
            $filieres->save();
            $filieres->niveaux()->sync($request->niveaux);
    
            return redirect()->route('filieres.index')->with('message', 'La filiere a été creé avec succès');
        }
        catch(\Exception $e){
            return redirect()->route('filieres.index')->with('error', 'La filiere n\'a pas été creé'.$e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Filiere $filiere)
    {
        try{
       
            return view('admin.filieres.show', compact('filiere'));
        }
        catch(\Exception $e){
           return redirect(route('filieres.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filiere $filiere)
    {
        try{
            $niveaux=Niveau::all();
           
            return view('admin.filieres.edit', compact('filiere','niveaux'));
        }
        catch(\Exception $e){
           return redirect(route('filieres.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFiliereRequest $request, Filiere $filiere)
    {
        try{
            $filieres = Filiere::find($filiere->id);
            /*$validatedData = $request->validate([
                'matricule'=> 'required|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nomfiliere' => 'required|min:3|max:100',
                'prenomfiliere' => 'required|min:3|max:100',
                 
            ]);*/
           
            $filieres->nomFiliere = $request->nomFiliere;
            
            $filieres->codeFiliere = $request->codeFiliere;

            
          
            $filieres->save();
            $filieres->niveaux()->sync($request->niveaux);
    
            return redirect()->route('filieres.index', $filieres)->with('message1', 'La filiere a été modifier avec succes');
        }
        catch(\Exception $e){
           return redirect(route('filieres.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filiere $filiere)
    {
        try{         
           
            $filiere->delete();

            return redirect()->route('filieres.index')->with('danger', 'La filiere a été supprimée avec succès.');
    }
    catch(\Exception $e){
       return redirect(route('filieres.index'))->with('error', 'Operation echoue!');
    }
    }
}
