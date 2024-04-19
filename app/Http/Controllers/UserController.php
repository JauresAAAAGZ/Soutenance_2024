<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Professeur;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use Illuminate\Http\Request;

class UserController extends Controller
{
     /**
     * Display a login page of the resource.
     */
    public function index()
    {
        try{
        $users = User::all();
       
        return view('admin.users.index', compact('users',))->with('message', 'Operation reussi');
               
    }
    catch(\Exception $e){
        return view('admin.users.index', compact('users',))->with('error', 'Operation echoue!');
     }
     
    }

    
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $users=User::all();
            $roles=Role::all();
            $admins=Admin::all();
            $professeurs=Professeur::all();
            $etudiants=Etudiant::all();

          
           
            return view('admin.users.create', compact("users", "roles","admins","professeurs","etudiants"));
        }
        catch(\Exception $e){
           return redirect(route('users.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try{
            $users = new User();
            /*$validatedData = $request->validate([
                'matricule'=> 'required|unique:etudiants|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nomEtudiant' => 'required|min:3|max:100',
                'prenomEtudiant' => 'required|min:3|max:100',
                 
            ]);*/
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = $request->password;
            $users->role_id = $request->role_id;
            $users->etudiant_id = $request->etudiant_id;
            $users->professeur_id = $request->professeur_id;
            $users->admin_id = $request->admin_id;
          
                       
            $users->save();
          
    
            return redirect()->route('users.index')->with('message', 'L\'utilisateur a été creé avec succès');
        }
        catch(\Exception $e){
            return redirect()->route('users.index')->with('error', 'L\'utilisateur n\'a pas été créé'.$e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try{
       
        return view('admin.users.show', compact('user'));
    }
    catch(\Exception $e){
       return redirect(route('users.index'))->with('error', 'Operation echoue!');
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        try{
           
           
            return view('admin.users.edit', compact('user'));
        }
        catch(\Exception $e){
           return redirect(route('users.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try{
            $users = User::find($user->id);
            /*$validatedData = $request->validate([
                'matricule'=> 'required|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nomEtudiant' => 'required|min:3|max:100',
                'prenomEtudiant' => 'required|min:3|max:100',
                 
            ]);*/
           
            $users->password = $request->password;
            
           
          
                       
            $users->update();
    
            return redirect()->route('users.show', $users)->with('message1', 'L\'utilisateur a été modifié avec succes');
        }
        catch(\Exception $e){
           return redirect(route('users.index'))->with('error', 'Operation echoue!'.$e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try{         
           
            $user->delete();

            return redirect()->route('users.index')->with('danger', 'L\'utilisateur a été supprimé avec succès.');
    }
    catch(\Exception $e){
       return redirect(route('users.index'))->with('error', 'Operation echoue!');
    }
    
    }

   
}
