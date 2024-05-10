<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use App\Http\Requests\StoreProfesseurRequest;
use App\Http\Requests\UpdateProfesseurRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Matiere;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $professeurs = Professeur::all();
            
           
            return view('admin.professeurs.index', compact('professeurs'))->with('message', 'Operation reussi');
                   
        }
        catch(\Exception $e){
            return view('admin.professeurs.index', compact('professeurs',))->with('error', 'Operation echoue!');
        }
    }

   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
                  
            $professeurs=Professeur::all();
            $matieres=Matiere::all();
    
    
    
            return view('admin.professeurs.create', compact("professeurs", "matieres"));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfesseurRequest $request)
    {
        try{
            $professeurs = new Professeur();
           /* $validatedData = $request->validate([
                'matricule'=> 'required|unique:professeurs|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nomprofesseur' => 'required|min:3|max:100',
                'prenomprofesseur' => 'required|min:3|max:100',
                 
            ]);*/
            //$professeurs->idprofesseur = $request->idprofesseur;
            $professeurs->numEmploye = $request->numEmploye;
            
            $professeurs->nomProfesseur = $request->nomProfesseur;
            
            $professeurs->prenomProfesseur = $request->prenomProfesseur;
            $professeurs->emailProfesseur = $request->emailProfesseur;

            $professeurs->sexe_prof = $request->sexe_prof;
            $professeurs->date_naissance_prof = $request->date_naissance_prof;
           
            
          
            $professeurs->save();
            $professeurs->matieres()->sync($request->matieres);
    
            return redirect()->route('professeurs.index')->with('message', 'Le professeur a été creé avec succès');
        }
        catch(\Exception $e){
            return redirect()->route('professeurs.index')->with('error', 'Le professeur n\'a pas été creé'.$e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Professeur $professeur)
    {
        try{
           
            
            return view('admin.professeurs.show', compact('professeur'));
        }
        catch(\Exception $e){
           return redirect(route('professeurs.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professeur $professeur)
    {
        try{
            $matieres=Matiere::all();
           
            return view('admin.professeurs.edit', compact('professeur','matieres'));
        }
        catch(\Exception $e){
           return redirect(route('professeurs.index'))->with('error', 'Operation echoue!'.$e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfesseurRequest $request, Professeur $professeur)
    {
        try{
            $professeurs = Professeur::find($professeur->id);
            /*$validatedData = $request->validate([
                'matricule'=> 'required|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nomprofesseur' => 'required|min:3|max:100',
                'prenomprofesseur' => 'required|min:3|max:100',
                 
            ]);*/
           
            $professeurs->numEmploye = $request->numEmploye;
            
            $professeurs->nomProfesseur = $request->nomProfesseur;
            
            $professeurs->prenomProfesseur = $request->prenomProfesseur;
            $professeurs->emailProfesseur = $request->emailProfesseur;
            $professeurs->date_naissance_prof = $request->date_naissance_prof;
           
            
          
            $professeurs->save();
            $professeurs->matieres()->sync($request->matieres);
    
            return redirect()->route('professeurs.index', $professeurs)->with('message1', 'Le professeur a été modifier avec succes');
        }
        catch(\Exception $e){
           return redirect(route('professeurs.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professeur $professeur)
    {
        try{         
           
            $professeur->delete();

            return redirect()->route('professeurs.index')->with('danger', 'Le professeur a été supprimée avec succès.');
    }
    catch(\Exception $e){
       return redirect(route('professeurs.index'))->with('error', 'Operation echoue!');
    }
    }

    public function getProfesseurInfo($id)
    {
        $professeur = Professeur::find($id);

        if ($professeur) {
            return response()->json([
                'nomProfesseur' => $professeur->nomProfesseur,
                'emailProfesseur' => $professeur->emailProfesseur,
                'prenomProfesseur'=> $professeur->prenomProfesseur,
                // Ajoutez d'autres informations du professeur si nécessaire
            ]);
        } else {
            return response()->json(['error' => 'Professeur non trouvé'], 404);
        }
    }
}
