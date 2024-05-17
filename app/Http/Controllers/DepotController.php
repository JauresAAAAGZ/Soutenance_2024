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
use App\Models\Professeur;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepotCreated;
use App\Models\Etudiant;
use Dompdf\Dompdf;


class DepotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    try {
        // Ordre par defaut
        $orderBy = 'created_at';
        $orderDirection = 'desc';

        // vérifier si une option de tri est choisie
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $orderBy = 'created_at';
                    $orderDirection = 'asc';
                    break;
                case 'alphabetical':
                    $orderBy = 'nomDepot';
                    $orderDirection = 'asc';
                    break;
                case 'latest':
                default:
                    $orderBy = 'created_at';
                    $orderDirection = 'desc';
                    break;
            }
        }

        // récupérer la requete de recherche
        $searchQuery = $request->input('q');

        // Récupérer les dépôts en fonction de l'option de tri sélectionnée et de la requête de recherche.
        $depots = Depot::orderBy($orderBy, $orderDirection)
            ->where('nomDepot', 'like', '%'.$searchQuery.'%')
            ->orWhere('description', 'like', '%'.$searchQuery.'%')
            ->get();

        return view('depots.index', compact('depots'))->with('message', 'Opération réussie');
    } catch(\Exception $e) {
        return view('depots.index')->with('error', 'Opération échouée!');
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

            
            if ($request->hasFile('fichiers')) {
                foreach ($request->file('fichiers') as $file) {
                    $depots->addMedia($file)->preservingOriginal()
                        ->withCustomProperties([
                            'user_email' => Auth::user()->email,
                        ])->toMediaCollection();
                }
            }

           /* // Retrieve student emails based on filiere and niveau
            $studentEmails = $this->getStudentEmails($request->filieres, $request->niveaux);

            // Send email to students
            Mail::to($studentEmails)->send(new DepotCreated($depots));*/
           
    
            return redirect()->route('depots.index')->with('message', 'Le depot a été creé avec succès');
        }
        catch(\Exception $e){
            return redirect()->route('depots.index')->with('error', 'Le depot n\'a pas été creé'.$e);
        }
    }
    /*private function getStudentEmails($filieres, $niveaux) {
        // Retrieve student emails based on filieres and niveaux
        $students = Etudiant::whereIn('filiere_id', $filieres)
                            ->whereIn('niveau_id', $niveaux)
                            ->pluck('emailEtudiant')
                            ->toArray();
        
        return $students;
    }*/

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

            return redirect()->route('depots.index')->with('danger', 'Le depot a été supprimé avec succès.');
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
        try {
            foreach ($request->file('fichiers') as $file) {
                // Get the connected user's name
                $userName = Auth::user()->name; // Change 'name' to the appropriate field name
    
                // Truncate the user's name to only the first two words
                $userNameParts = explode(' ', $userName);
                $truncatedUserName = implode(' ', array_slice($userNameParts, 0, 2));
    
                // Get the original file name
                $originalFileName = $file->getClientOriginalName();
    
                // Construct the new file name
                $newFileName = $truncatedUserName . '_' . $originalFileName;
    
                // Add the media with the new file name
                $depot->addMedia($file)->preservingOriginal()
                    ->withCustomProperties([
                        'user_email' => Auth::user()->email,
                        // You can add more user-related information here if needed
                    ])->usingFileName($newFileName)->toMediaCollection();
            }
    
            return redirect()->back()->with('message1', 'Le fichier a été ajouté avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Le fichier n\'a pas été ajouté' . $e->getMessage());
        }
    }
    

  

public function updateDepotEtat($depotId) {
    // Find the dépôt by ID
    $depot = Depot::find($depotId);
    if ($depot) {
        // Check if the état is not already "fermé"
        if ($depot->etat !== 'fermé') {
            // Update the état to "fermé"
            $depot->etat = 'fermé';
            $depot->save();
            return response()->json(['message' => 'État du dépôt mis à jour avec succès.']);
        } else {
            return response()->json(['message' => 'État du dépôt est déjà fermé.']);
        }
    } else {
        return response()->json(['error' => 'Dépôt non trouvé.'], 404);
    }
}

/*supprimer un media*/
public function deleteFile($id)
{
    try {
        $media = Media::findOrFail($id);
        
        // Check if the user is authorized to delete the file
        if (Auth::user()->email != $media->custom_properties['user_email']) {
            return redirect()->back()->with('error', 'vous n\'êtes pas autorisé a supprimer ce fichier');
        }

        // Delete the file
        $media->delete();

        return redirect()->back()->with('message', 'Fichier Supprimé');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Erreur lors de la suppression du fichier');
    }
}

public function downloadProfessorFiles($depotId)
{
    // Recupérer l'ID du depot
    $depot = Depot::findOrFail($depotId);
    
    // Récupérer l'email du prof
    $professorEmails = Professeur::pluck('emailProfesseur')->toArray();
    
    // Obtenir le premier média associé au dépôt et correspondant aux adresses e-mail des professeurs.
    $media = $depot->media()->where(function ($query) use ($professorEmails) {
        foreach ($professorEmails as $email) {
            $query->orWhereJsonContains('custom_properties->user_email', $email);
        }
    })->first();

    if (!$media) {
        
        return redirect()->back()->with('error', 'An error occurred while deleting the file');
    }

    // le chemin du media
    $filePath = $media->getPath();

    // retourner le fichier pour téléchargement
    return response()->download($filePath, $media->file_name);
}



public function showDepotStudents(Depot $depot)
{
    $filieres = $depot->filieres->pluck('id'); // Get the filiere IDs associated with this depot
    $niveaux = $depot->niveaux->pluck('id'); // Get the niveau IDs associated with this depot

    // Retrieve students based on filiere and niveau IDs
    $students = Etudiant::whereIn('filiere_id', $filieres)
                        ->whereIn('niveau_id', $niveaux)
                        ->get();

    return view('depots.students', compact('depot', 'students'));
}




public function submitNotes(Request $request, Depot $depot)
{
    // Récupérer les données soumises depuis le formulaire
    $etudiantIds = $request->input('etudiant_ids');
    $notes = $request->input('notes');

    // Votre logique de validation et d'enregistrement des notes ici...

    // Générer le contenu du PDF
    $pdfContent = "<table border=\"2\" ><tr><th>Nom</th><th>Prénoms</th><th>Filière</th><th>Niveau</th><th>Note</th></tr>";
    foreach ($etudiantIds as $index => $etudiantId) {
        $etudiant = Etudiant::find($etudiantId);
        if ($etudiant) {
            $pdfContent .= '<tr>';
            $pdfContent .= '<td>' . $etudiant->nomEtudiant . '</td>';
            $pdfContent .= '<td>' . $etudiant->prenomEtudiant . '</td>';
            $pdfContent .= '<td>' . $etudiant->filiere->nomFiliere . '</td>';
            $pdfContent .= '<td>' . $etudiant->niveau->diplome_niveau . '</td>';
            $pdfContent .= '<td>' . $notes[$index] . '</td>';
            $pdfContent .= '</tr>';
        }
    }
    $pdfContent .= "</table>";

    // Générer le PDF
    $dompdf = new Dompdf();
    $dompdf->loadHtml($pdfContent);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $pdfOutput = $dompdf->output();

    // Sauvegarder le PDF dans le stockage Laravel
    $pdfFileName = 'notes_etudiants_' . time() . '.pdf';
    Storage::put('pdf/' . $pdfFileName, $pdfOutput);

    // Lier le PDF au dépôt
    $depot->addMedia(storage_path('app/pdf/' . $pdfFileName))->toMediaCollection();

    // Redirection avec un message de succès
    return redirect()->route('depots.index')->with('message', 'Votre fichier de notes est enregistré avec succès');
}



}




