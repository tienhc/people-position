<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Đề bài:
     * Có 20 lớp trong trường.
     *
     * 5 lớp có 35 học sinh.
     * 6 lớp có 45 học sinh.
     * 10 lớp có 30 học sinh.
     * 4 lớp có 40 học sinh.
     * => 5 + 6 + 10 + 4 = 25 lớp
     * E sẽ giả định đề bài là 25 lớp
     **/
    public function countStudents()
    {
        $classes = [
            ['students' => 35, 'count' => 5],
            ['students' => 45, 'count' => 6],
            ['students' => 30, 'count' => 10],
            ['students' => 40, 'count' => 4],
        ];

        $averageAge = 20 + (8 / 12); // 20 years 8 months
        $minAge = $averageAge - 0.5; // Trừ 6 tháng
        $maxAge = $averageAge + 0.5; // Cộng 6 tháng

        $result = [];
        $classIndex = 1;

        foreach ($classes as $class) {
            for ($i = 0; $i < $class['count']; $i++) {
                $larger = 0;
                $smaller = 0;

                for ($j = 0; $j < $class['students']; $j++) {
                    $age = rand(18, 23); // Giả lập tuổi ngẫu nhiên từ 18 đến 23

                    if ($age > $maxAge) {
                        $larger++;
                    } elseif ($age < $minAge) {
                        $smaller++;
                    }
                }

                $result[] = [
                    'class' => $classIndex++,
                    'total_students' => $class['students'],
                    'larger_age' => $larger,
                    'smaller_age' => $smaller,
                ];
            }
        }

        return response()->json($result);
    }
}
