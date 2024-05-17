<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    /**
     * Display a login page of the resource.
     */
    public function index()
    {
        try{
        $etudiants = Etudiant::all();
       
        return view('admin.etudiants.index', compact('etudiants',))->with('message', 'Operation reussi');
               
    }
    catch(\Exception $e){
        return view('admin.etudiants.index', compact('etudiants',))->with('error', 'Operation echoue!');
     }
     
    }

    
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $etudiants=Etudiant::all();
            $filieres=Filiere::all();
            $niveaux=Niveau::all();
           
            return view('admin.etudiants.create', compact("etudiants", "filieres","niveaux"));
        }
        catch(\Exception $e){
           return redirect(route('etudiants.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtudiantRequest $request)
    {
        try{
            $etudiants = new Etudiant();
            $validatedData = $request->validate([
                'matricule'=> 'required|unique:etudiants|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nomEtudiant' => 'required|min:3|max:100',
                'prenomEtudiant' => 'required|min:3|max:100',
                 
            ]);
            $etudiants->matricule = $request->matricule;
            $etudiants->nomEtudiant = $request->nomEtudiant;
            $etudiants->prenomEtudiant = $request->prenomEtudiant;
            $etudiants->emailEtudiant = $request->emailEtudiant;
           
            $etudiants->date_naissance_etu = $request->date_naissance_etu;
            $etudiants->sexe_etu = $request->sexe_etu;
            $etudiants->filiere_id=$request->filiere_id;
            $etudiants->niveau_id=$request->niveau_id;

            
            
            $etudiants->save();
    
            return redirect()->route('etudiants.index')->with('message', 'L\'Etudiant a été creé avec succès');
        }
        catch(\Exception $e){
            return redirect()->route('etudiants.index')->with('error', 'L\'Etudiant n\'a pas été creé');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        try{
       
        return view('admin.Etudiants.show', compact('etudiant'));
    }
    catch(\Exception $e){
       return redirect(route('etudiants.index'))->with('error', 'Operation echoue!');
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        try{
            $filieres = Filiere::all();
            $niveaux=Niveau::all();
           
            return view('admin.etudiants.edit', compact('etudiant', 'filieres','niveaux'));
        }
        catch(\Exception $e){
           return redirect(route('etudiants.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtudiantRequest $request, Etudiant $etudiant)
    {
        try{
            $etudiants = Etudiant::find($etudiant->id);
            $validatedData = $request->validate([
                'matricule'=> 'required|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nomEtudiant' => 'required|min:3|max:100',
                'prenomEtudiant' => 'required|min:3|max:100',
                 
            ]);
            $etudiants->matricule = $request->matricule;
            $etudiants->nomEtudiant = $request->nomEtudiant;
            $etudiants->prenomEtudiant = $request->prenomEtudiant;

            $etudiants->emailEtudiant = $request->emailEtudiant;

            $etudiants->date_naissance_etu = $request->date_naissance_etu;
            $etudiants->sexe_etu = $request->sexe_etu;
            $etudiants->filiere_id = $request->filiere_id;
            $etudiants->niveau_id=$request->niveau_id;
           
            $etudiants->save();
    
            return redirect()->route('etudiants.show', $etudiants)->with('message1', 'L\'étudiant a été modifier avec succes');
        }
        catch(\Exception $e){
           return redirect(route('etudiants.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        try{         
           
            $etudiant->delete();

            return redirect()->route('etudiants.index')->with('danger', 'L\'étudiant a été supprimé avec succès.');
    }
    catch(\Exception $e){
       return redirect(route('etudiants.index'))->with('error', 'Operation echoue!');
    }
    
    }


    public function getInfo($id)
    {
        $etudiant = Etudiant::find($id);

        if ($etudiant) {
            // Si l'étudiant est trouvé, renvoyer ses informations sous forme de JSON
            return response()->json([
                'nomEtudiant' => $etudiant->nomEtudiant,
                'emailEtudiant' => $etudiant->emailEtudiant,
                'prenomEtudiant' => $etudiant->prenomEtudiant,
                // Ajoutez d'autres informations d'étudiant si nécessaire
            ]);
        } else {
            // Si l'étudiant n'est pas trouvé, renvoyer une réponse avec un code d'erreur
            return response()->json(['error' => 'Étudiant non trouvé'], 404);
        }
    }

    /*public function getDossier(){
        try{
            $depots = Depot::all();
           
            return view('admin.etudiants.depots', compact('depots',))->with('message', 'Operation reussi');
                   
        }
        catch(\Exception $e){
            return view('admin.etudiants.depots', compact('depots',))->with('error', 'Operation echoue!');
         }
    }*/
   
}
