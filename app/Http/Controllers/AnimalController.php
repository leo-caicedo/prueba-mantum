<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function getQuantityTypeAnimal(Request $request)
    {
        $date = $request->query('date') ?? now()->toDateString();
        $date = Carbon::parse($date)->toDateString();

        $qtyAnimal = $request->query('qty') ?? 2;

        $qtyTypeAnimal = Animal::with('typeAnimal')
            ->where('birthdate', '>', $date)
            ->get()
            ->groupBy('typeAnimal.name')
            ->filter(function ($groupAnimal) use ($qtyAnimal) {
                return count($groupAnimal) > $qtyAnimal;
            })
            ->map(function ($groupAnimal) {
                return count($groupAnimal);
            });

        return response()->json(compact('qtyTypeAnimal'));
    }
}
