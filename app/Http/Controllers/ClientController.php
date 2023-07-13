<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{

    public function generateNumericString() {
        $numericString = '';
        
        for ($i = 1; $i <= 8; $i++) {
            $numericString .= mt_rand(0, 9); // Generate a random digit (0-9)
            
            if ($i % 3 === 0 && $i !== 10) {
                $numericString .= '-'; // Add a hyphen after every third digit, except for the last one XXX-XXX-X
            }
        }
        
        return $numericString;
    }
    

    public function chekObs(int $solde) {
        if (1000 > $solde) {
            $obs = "Insuffisant";
        } elseif (($solde >= 1000) && (5000 >= $solde)) {
            $obs = "Moyen";
        } else {
            $obs = "Élevé";
        }

        return $obs;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = Client::all();
        return response()->json($client,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $obs = $this->chekObs($data["solde"]);


        $user = Client::create([
            'numCompte' => $this->generateNumericString(),
            'nom' => $data["nom"],
            'solde' => $data["solde"],
            'observation' => $obs
        ]);
        return response()->json([
            "user" => $user,
            "res" => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)

    {
        return response()->json($client, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $data = $request->all();
        $obs = $this->chekObs($data["solde"]);

        $client->nom = $data["nom"];
        $client->solde = $data["solde"];
        $client->observation = $obs;
        $client->save();

        return response()->json(["res" => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json([
            "deleted" => true
        ]);
    }

    public function minMax() {
        $val = DB::table("clients")
        ->select(DB::raw("min(solde) as min, max(solde) as max, sum(solde) as total"))
        ->get();
        
        return response()->json($val);
    }
}
