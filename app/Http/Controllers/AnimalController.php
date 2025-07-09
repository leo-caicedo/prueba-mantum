<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\TypeAnimal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /** QUERY SQL
     * select t."name", count(a.id) from animals a 
     * join type_animals t on a.type_animal_id = t.id
     * where a.birthdate > '2016-12-31'
     * group by t."name"
     * having count(a.id) > 2
     * order by count(a.id) desc; // Lo puse para ordenar de mayor a menor
     */
    public function getQuantityTypeAnimal(Request $request)
    {
        $date = $request->query('date') ?? '2016-12-31';
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

    public function matriz()
    {
        $typeAnimal = TypeAnimal::with('animals')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(function ($type) {
                return [
                    $type->id => [
                        'name' => $type->name,
                        'animals' => $type->animals
                            ->sortBy('name')
                            ->map(function ($animal) {
                                return [
                                    'id' => $animal->id,
                                    'name' => $animal->name,
                                ];
                            })
                            ->values()
                    ]
                ];
            });

        return response()->json($typeAnimal);
    }
}
