<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('panel.settings', ['title' => __('Settings'), 'service' => 'SettingsService', "create_check" => true]);
    }

    public function users()
    {
        return view('panel.table', ['title' => __('Users'), 'service' => 'UsersService', "create_check" => true]);
    }

    public function goals()
    {
        return view('panel.table', ['title' => __('Goals'), 'service' => 'GoalsService', "create_check" => true]);
    }

    public function questions()
    {
        return view('panel.table', ['title' => __('Questions'), 'service' => 'QuestionsService', "create_check" => true]);
    }

    public function answers()
    {
        return view('panel.table', ['title' => __('Answers'), 'service' => 'AnswersService', "create_check" => true]);
    }
}
