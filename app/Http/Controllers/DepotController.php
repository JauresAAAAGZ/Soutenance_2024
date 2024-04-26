<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Http\Requests\StoreDepotRequest;
use App\Http\Requests\UpdateDepotRequest;
use App\Models\Matiere;
use Illuminate\Http\Request;
use App\Models\Filiere;
use App\Models\Niveau;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Carbon\Carbon;


class DepotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $depots = Depot::all();
            
           
            return view('depots.index', compact('depots'))->with('message', 'Operation reussi');
                   
        }
        catch(\Exception $e){
            return view('depots.index', compact('depots',))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $depots=Depot::all();
        $filieres=Filiere::all();
        $niveaux=Niveau::all();
        $matieres=Matiere::all();

        return view('depots.create', compact("depots","filieres","niveaux","matieres"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepotRequest $request)
    {
        try{
            $depots = new Depot();
          
            $depots->nomDepot = $request->nomDepot;

            $depots->dateCreation = now();

            $depots->dateFermeture = $request->dateFermeture;

            // Calculer la différence entre l'heure de création et l'heure de fermeture
            $dateCreation = Carbon::parse($depots->dateCreation);
            $dateFermeture = Carbon::parse($depots->dateFermeture);
            $diffHours = $dateCreation->diffInHours($dateFermeture); // Différence en heures

            // Convertir la différence en un format de temps approprié
            $hours = $diffHours % 24;
            $days = ($diffHours - $hours) / 24;
            $depots->delai = sprintf('%02d:%02d:00', $days, $hours); // Format : jours:heures:minutes:secondes
            
            $depots->description = $request->description;
           
            $professorId = Auth::user()->professeur_id;
            $depots->professeur_id = $professorId;

            $depots->matiere_id = $request->matiere_id;
            
            $depots->save();

            $depots->niveaux()->sync($request->niveaux);
            $depots->filieres()->sync($request->filieres);

            foreach ($request->file('fichiers') as $file) {
                $depots->addMedia($file) ->preservingOriginal()
                
                ->withCustomProperties([
                    'user_email' => Auth::user()->email,
                   
                ])->toMediaCollection();
            }

           
    
            return redirect()->route('depots.index')->with('message', 'Le depot a été creé avec succès');
        }
        catch(\Exception $e){
            return redirect()->route('depots.index')->with('error', 'Le depot n\'a pas été creé'.$e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Depot $depot)
    {
        try{
       
            return view('depots.show', compact('depot'));
        }
        catch(\Exception $e){
           return redirect(route('depots.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depot $depot)
    {
       
        $filieres=Filiere::all();
        $niveaux=Niveau::all();
        $matieres=Matiere::all();

        return view('depots.edit', compact("depot","filieres","niveaux","matieres"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepotRequest $request, Depot $depot)
    {
        try{
            $depots = Depot::find($depot->id);
          
            $depots->nomDepot = $request->nomDepot;

           
            $depots->dateFermeture = $request->dateFermeture;

            
            $depots->description = $request->description;
           
            $professorId = Auth::user()->professeur_id;
            $depots->professeur_id = $professorId;

            $depots->matiere_id = $request->matiere_id;
            
            $depots->update();

            $depots->niveaux()->sync($request->niveaux);
            $depots->filieres()->sync($request->filieres);

           
    
            return redirect()->route('depots.index')->with('message', 'Le depot a été modifié avec succès');
        }
        catch(\Exception $e){
            return redirect()->route('depots.index')->with('error', 'Le depot n\'a pas modifié creé'.$e);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depot $depot)
    {
        try{         
           
            $depot->delete();

            return redirect()->route('depots.index')->with('danger', 'La matiere a été supprimée avec succès.');
    }
    catch(\Exception $e){
       return redirect(route('depots.index'))->with('error', 'Operation echoue!');
    }
    }
    

  

    public function downloadFile($id)
    {
        // Retrieve the media by ID
        $media = Media::findOrFail($id);
    
        // Get the path to the media file
        $path = $media->getPath();
    
        // Return a download response
        return response()->download($path, $media->file_name);
    }


    public function addFiles(Request $request, Depot $depot)
    {
        try{
           

            foreach ($request->file('fichiers') as $file) {
                $depot->addMedia($file) ->preservingOriginal()
                
                ->withCustomProperties([
                    'user_email' => Auth::user()->email,
                    // You can add more user-related information here if needed
                ])->toMediaCollection();

                
            }

           
    
            return  redirect()->back()->with('message1', 'Le fichier a été ajouté avec succès');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Le fichier n\'a pas été ajouté'.$e);
        }
    }

}
