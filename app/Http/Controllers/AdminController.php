<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $admins = Admin::all();
           
            return view('admin.admins.index', compact('admins',))->with('message', 'Operation reussi');
                   
        }
        catch(\Exception $e){
            return view('admin.admins.index', compact('admins',))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $admins=Admin::all();
           
            return view('admin.admins.create', compact("admins"));
        }
        catch(\Exception $e){
           return redirect(route('admins.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        try{
            $admins = new Admin();
           /* $validatedData = $request->validate([
                'matricule'=> 'required|unique:admins|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nomadmin' => 'required|min:3|max:100',
                'prenomadmin' => 'required|min:3|max:100',
                 
            ]);*/
            //$admins->idadmin = $request->idadmin;

            $admins->nomAdmin = $request->nomAdmin;
            
            $admins->emailAdmin = $request->emailAdmin;
            
            $admins->save();
    
            return redirect()->route('admins.index')->with('message', 'L\' admin a été creé avec succès');
        }
        catch(\Exception $e){
            return redirect()->route('admins.index')->with('error', 'L\' admin n\'a pas été creé');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        try{
       
            return view('admin.admins.show', compact('admin'));
        }
        catch(\Exception $e){
           return redirect(route('admins.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        try{
            
           
            return view('admin.admins.edit', compact('admin'));
        }
        catch(\Exception $e){
           return redirect(route('admins.index'))->with('error', 'Operation echoue!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        try{
            $admins = Admin::find($admin->id);
            /*$validatedData = $request->validate([
                'matricule'=> 'required|min:3|max:100',
                'date_naissance_etu' => 'date',
                'nomadmin' => 'required|min:3|max:100',
                'prenomadmin' => 'required|min:3|max:100',
                 
            ]);*/
            $admins->nomAdmin = $request->nomAdmin;
            
            $admins->emailAdmin = $request->emailAdmin;

            $admins->save();
    
            return redirect()->route('admins.index', $admins)->with('message1', 'L\' admin a été modifier avec succes');
        }
        catch(\Exception $e){
           return redirect(route('admins.index'))->with('error', 'Operation echoue!'.$e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        try{         
           
            $admin->delete();

            return redirect()->route('admins.index')->with('danger', 'La admin a été supprimée avec succès.');
    }
    catch(\Exception $e){
       return redirect(route('admins.index'))->with('error', 'Operation echoue!');
    }
    }

    public function getAdminInfo($id)
    {
        $admin = Admin::find($id);

        if ($admin) {
            return response()->json([
                'nomAdmin' => $admin->nomAdmin,
                'emailAdmin' => $admin->emailAdmin,
                
                // Ajoutez d'autres informations de l'administrateur si nécessaire
            ]);
        } else {
            return response()->json(['error' => 'Administrateur non trouvé'], 404);
        }
    }
}

