<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use App\Http\Requests\StoreNiveauRequest;
use App\Http\Requests\UpdateNiveauRequest;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $niveaux = Niveau::all();
           
            return view('admin.niveaux.index', compact('niveaux',))->with('message', 'Operation reussi');
                   
        }
        catch(\Exception $e){
            return view('admin.niveaux.index', compact('niveaux',))->with('error', 'Operation echoue!');
         }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $niveaux=Niveau::all();
           
            return view('admin.niveaux.create', compact("niveaux"));
        }
        catch(\Exception $e){
           return redirect(route('niveaux.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNiveauRequest $request)
    {
        try{
            $niveaux = new Niveau();
           /* $validatedData = $request->validate([
                'matricule'=> 'required|unique:niveaux|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nomNiveau' => 'required|min:3|max:100',
                'prenomNiveau' => 'required|min:3|max:100',
                 
            ]);*/
            //$niveaux->idNiveau = $request->idNiveau;

            $niveaux->diplome_niveau = $request->diplome_niveau;
            
            $niveaux->codeNiveau = $request->codeNiveau;

           
            
            $niveaux->save();
    
            return redirect()->route('niveaux.index')->with('message', 'Le Niveau a été creé avec succès');
        }
        catch(\Exception $e){
            return redirect()->route('niveaux.index')->with('error', 'La Niveau n\'a pas été creé');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Niveau $niveau)
    {
        try{
       
            return view('admin.niveaux.show', compact('niveau'));
        }
        catch(\Exception $e){
           return redirect(route('niveaux.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Niveau $niveau)
    {
        try{
            
           
            return view('admin.niveaux.edit', compact('niveau'));
        }
        catch(\Exception $e){
           return redirect(route('niveaux.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNiveauRequest $request, Niveau $niveau)
    {
        try{
        $niveaux = niveau::find($niveau->id);
            /*$validatedData = $request->validate([
                'matricule'=> 'required|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nomniveau' => 'required|min:3|max:100',
                'prenomniveau' => 'required|min:3|max:100',
                 
            ]);*/
            $niveaux->diplome_niveau = $request->diplome_niveau;
            
            $niveaux->codeNiveau = $request->codeNiveau;

                       
            $niveaux->save();
    
            return redirect()->route('niveaux.index', $niveaux)->with('message1', 'Le niveau a été modifié avec succes');
        }
        catch(\Exception $e){
           return redirect(route('niveaux.index'))->with('error', 'Operation echoue!'.$e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Niveau $niveau)
    {
        try{         
           
            $niveau->delete();

            return redirect()->route('niveaux.index')->with('danger', 'Le niveau a été supprimée avec succès.');
    }
    catch(\Exception $e){
       return redirect(route('niveaux.index'))->with('error', 'Operation echoue!');
    }
    }
}
