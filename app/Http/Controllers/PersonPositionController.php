<?php

namespace App\Http\Controllers;

use App\Models\PersonPosition;
use Illuminate\Http\Request;

class PersonPositionController extends Controller
{
    public function getFurthestPeople()
    {
        $people = PersonPosition::all();

        // Tính khoảng cách so với gốc tọa độ (0, 0) hoặc một điểm cho trước
        $distances = $people->map(function ($person) {
            return [
                'id' => $person->id,
                'distance' => $person->distanceFrom(0, 0)
            ];
        });

        // Sắp xếp khoảng cách giảm dần
        $sorted = $distances->sortByDesc('distance');

        // Lấy 10% xa nhất
        $top10 = $sorted->take(ceil($people->count() * 0.1));

        return response()->json($top10);
    }
}
