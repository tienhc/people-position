<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{


    public function findLargestAgeDifference()
    {
        // Lấy tuổi lớn nhất và nhỏ nhất
        $maxAge = People::max('age');
        $minAge = People::min('age');

        // Tính khoảng cách tuổi của từng người
        $people = DB::table('people')
            ->select('id', 'name', 'age', DB::raw("GREATEST($maxAge - age, age - $minAge) as difference"))
            ->orderByDesc('difference')
            ->limit(DB::table('people')->count() * 0.2) // Lấy 20%
            ->get();

        return response()->json($people);
    }

}
