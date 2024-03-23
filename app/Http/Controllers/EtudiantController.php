<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;

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
         return view('login-etu');
    }

    /**
     * Display a dashboard of the resource.
     */
    public function dashboard(Etudiant $etudiant)
    {
        return view('dash-etu');
    }


 /**
     * treat the login request of the resource.
     */
        
     public function login(Request $request){
        

        $etudiant= Etudiant::where('emailEtudiant','=',$request->emailEtudiant)->first();
        

        if($etudiant && Hash::check($request->pswdEtudiant, $etudiant->pswdEtudiant)) 
        {
            Auth::guard('etudiant')->login($etudiant, true);

            if(Auth::guard('etudiant')->check()){
                
                return redirect()->route('etudiant.dashboard')->with('error','Connexion Succesfull');

            }
            else{
                return back()->with('error','Non connecté');
            }
           
        }
        else
        {
            return back()->with('error','Email ou mot de passe erroné');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtudiantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtudiantRequest $request, Etudiant $etudiant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        //
    }
   
}
