<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function tags()
    {
        return view('panel.table', ['title' => __('Tags'), 'service' => 'TagsService', "create_check" => true]);
    }

    public function tips()
    {
        return view('panel.table', ['title' => __('Tips'), 'service' => 'TipsService', "create_check" => true]);
    }

    public function posts()
    {
        return view('panel.table', ['title' => __('Posts'), 'service' => 'PostsService', "create_check" => true]);
    }
}
