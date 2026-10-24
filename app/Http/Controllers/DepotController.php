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
use Illuminate\Support\Facades\Mail;
use App\Mail\DepotCreated;
use App\Models\Etudiant;
use Dompdf\Dompdf;


class DepotController extends Controller
{
    // Le professeur connecté est-il celui qui a créé le dépôt ?
    private function estProfesseurDuDepot(Depot $depot): bool
    {
        $user = Auth::user();

        return $user->role_id == 2
            && $user->professeur_id !== null
            && $depot->professeur_id == $user->professeur_id;
    }

    // Le dépôt vise-t-il la filière et le niveau de l'étudiant connecté ?
    private function etudiantConcerne(Depot $depot): bool
    {
        $etudiant = Auth::user()->etudiant;

        return Auth::user()->role_id == 1
            && $etudiant !== null
            && $depot->filieres->contains('id', $etudiant->filiere_id)
            && $depot->niveaux->contains('id', $etudiant->niveau_id);
    }

    // L'admin et le service examen voient tous les dépôts, les autres seulement les leurs
    private function peutVoir(Depot $depot): bool
    {
        return in_array(Auth::user()->role_id, [3, 4])
            || $this->estProfesseurDuDepot($depot)
            || $this->etudiantConcerne($depot);
    }

    // Fichier joint par le professeur du dépôt, par opposition au rendu d'un étudiant
    private function estRessource(Media $media, Depot $depot): bool
    {
        return $media->getCustomProperty('user_email') === $depot->professeur?->user?->email;
    }

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
           
    
            return redirect()->route('depots.index')->with('message', 'Le dépôt a été créé.');
        }
        catch(\Exception $e){
            return redirect()->route('depots.index')->with('error', "Le dépôt n'a pas pu être créé.");
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
        abort_unless($this->peutVoir($depot), 403, 'Accès refusé.');

        try{
       
            return view('depots.show', compact('depot'));
        }
        catch(\Exception $e){
           return redirect(route('depots.index'))->with('error', 'Une erreur est survenue, veuillez réessayer.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depot $depot)
    {
        abort_unless($this->estProfesseurDuDepot($depot), 403, 'Accès refusé.');

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
        abort_unless($this->estProfesseurDuDepot($depot), 403, 'Accès refusé.');

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

           
    
            return redirect()->route('depots.index')->with('message', 'Le dépôt a été modifié.');
        }
        catch(\Exception $e){
            return redirect()->route('depots.index')->with('error', "Le dépôt n'a pas pu être modifié.");
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depot $depot)
    {
        abort_unless($this->estProfesseurDuDepot($depot), 403, 'Accès refusé.');

        try{
            $depot->delete();

            return redirect()->route('depots.index')->with('message', 'Le dépôt a été supprimé.');
    }
    catch(\Exception $e){
       return redirect(route('depots.index'))->with('error', 'Une erreur est survenue, veuillez réessayer.');
    }
    }
    

  

    public function downloadFile($id)
    {
        $media = Media::findOrFail($id);
        $depot = $media->model;

        $estAuteur = Auth::user()->email === $media->getCustomProperty('user_email');
        $estReleve = strpos($media->file_name, 'notes') === 0;

        // L'auteur, le professeur du dépôt, le service examen pour les relevés,
        // et les étudiants concernés pour les ressources du professeur
        $autorise = $estAuteur
            || $this->estProfesseurDuDepot($depot)
            || (Auth::user()->role_id == 4 && $estReleve)
            || ($this->etudiantConcerne($depot) && $this->estRessource($media, $depot));

        abort_unless($autorise, 403, 'Accès refusé.');

        return response()->download($media->getPath(), $media->file_name);
    }


    public function addFiles(Request $request, Depot $depot)
    {
        abort_unless($this->etudiantConcerne($depot), 403, 'Accès refusé.');

        if ($depot->etat == 'fermé' || now()->greaterThanOrEqualTo($depot->dateFermeture)) {
            return redirect()->back()->with('error', 'Ce dépôt est fermé, il ne peut plus recevoir de fichier.');
        }

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
    
            return redirect()->back()->with('message1', 'Votre fichier a bien été envoyé.');
        } catch (\Exception $e) {
            report($e);
            return redirect()->back()->with('error', "Le fichier n'a pas pu être envoyé.");
        }
    }
    

  

public function updateDepotEtat($depotId) {
    // Find the dépôt by ID
    $depot = Depot::find($depotId);
    if ($depot) {
        // Appelé par le compte à rebours : on ne ferme que si l'échéance est réellement passée
        if (now()->lessThan($depot->dateFermeture)) {
            return response()->json(['message' => "Le dépôt n'a pas encore atteint sa date de fermeture."], 422);
        }

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
        $depot = $media->model;

        $estReleve = strpos($media->file_name, 'notes') === 0;
        $estAuteur = Auth::user()->email === $media->getCustomProperty('user_email');

        // Un fichier ne peut être supprimé que par son auteur, un relevé que par le professeur du dépôt
        if (!$estAuteur && !($estReleve && $this->estProfesseurDuDepot($depot))) {
            return redirect()->back()->with('error', "Vous n'êtes pas autorisé à supprimer ce fichier.");
        }

        // Une fois le dépôt fermé, l'étudiant ne peut plus retirer son rendu
        if (Auth::user()->role_id == 1 && $depot->etat == 'fermé') {
            return redirect()->back()->with('error', 'Ce dépôt est fermé, votre rendu ne peut plus être supprimé.');
        }

        $media->delete();

        return redirect()->back()->with('message', 'Le fichier a été supprimé.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', "Le fichier n'a pas pu être supprimé.");
    }
}

public function downloadProfessorFiles($depotId)
{
    $depot = Depot::findOrFail($depotId);

    abort_unless($this->estProfesseurDuDepot($depot) || $this->etudiantConcerne($depot), 403, 'Accès refusé.');

    // Première ressource jointe par le professeur du dépôt
    $media = $depot->getMedia()->first(fn ($media) => $this->estRessource($media, $depot));

    if (!$media) {
        
        return redirect()->back()->with('error', "Aucune ressource n'a été jointe à ce dépôt.");
    }

    // le chemin du media
    $filePath = $media->getPath();

    // retourner le fichier pour téléchargement
    return response()->download($filePath, $media->file_name);
}



public function showDepotStudents(Depot $depot)
{
    abort_unless($this->estProfesseurDuDepot($depot), 403, 'Accès refusé.');

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
    abort_unless($this->estProfesseurDuDepot($depot), 403, 'Accès refusé.');

    // Récupérer les données soumises depuis le formulaire
    $etudiantIds = $request->input('etudiant_ids');
    $notes = $request->input('notes');

    // Votre logique de validation et d'enregistrement des notes ici...

    // Générer le contenu du PDF
    $pdfContent = "<table border=\"1\" ><tr><th>Nom</th><th>Prénoms</th><th>Filière</th><th>Niveau</th><th>Note</th></tr>";
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
    return redirect()->route('depots.show', $depot)->with('message', 'Le relevé de notes a été généré.');
}



}




