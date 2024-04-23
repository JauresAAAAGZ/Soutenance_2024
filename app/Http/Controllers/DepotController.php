<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Http\Requests\StoreDepotRequest;
use App\Http\Requests\UpdateDepotRequest;
use Illuminate\Support\Facades\Auth;


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

        return view('depots.create', compact("depots"));
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
           
            
          
            $depots->save();
           
    
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depot $depot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepotRequest $request, Depot $depot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depot $depot)
    {
        //
    }
}
