<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return response()->json($cars);
    }
    public function estimatePrice(Request $request)
    {
        $data = $request->validate([
            'marque' => 'required',
            'modele' => 'required',
            'annee' => 'required',
        ]);
    
        $similarCars = Car::where('marque', $data['marque'])
            ->where('modele', $data['modele'])
            ->where('annee', $data['annee'])
            ->get();
    
        if ($similarCars->isEmpty()) {
            return response()->json(['message' => 'No similar cars found'], 404);
        }
    
        $totalPrice = $similarCars->sum('prix');
        $estimatedPrice = $totalPrice / $similarCars->count();
    
        return response()->json(['estimatedPrice' => $estimatedPrice]);
    }
}
