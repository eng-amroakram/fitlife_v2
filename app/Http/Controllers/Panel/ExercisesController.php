<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExercisesController extends Controller
{
    public function index()
    {
        return view('panel.table', ['title' => __("Exercises"), 'service' => 'ExercisesService', "create_check" => true]);
    }

    public function equipment()
    {
        return view('panel.table', ['title' => __("Equipment"), 'service' => 'EquipmentService', "create_check" => true]);
    }

    public function muscles()
    {
        return view('panel.table', ['title' => __("Muscles"), 'service' => 'MusclesService', "create_check" => true]);
    }

    public function challenges()
    {
        return view('panel.table', ['title' => __("Challenges"), 'service' => 'ChallengesService', "create_check" => true]);
    }
}
