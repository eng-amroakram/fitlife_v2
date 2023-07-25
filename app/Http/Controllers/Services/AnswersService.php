<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;

class AnswersService extends Controller
{
    use ServiceHelper;

    public $name = "Answers";
    public $title_creator = "Create";
    public $title_updater = "Update";
    public $modal_size = "";
    public $creator_id = "creator-button";
    public $updater_id = "updater-button";
    public $model = Answer::class;

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $paginate = $paginate == "all" ? Answer::count() : $paginate;
        return Answer::data()->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function __construct()
    {
        $this->model = new Answer();
    }

    public function model($id)
    {
        return Answer::find($id);
    }

    public function columns()
    {
        return [
            __("ID"),
            __("Question"),
            __("Answer"),
            __("Status"),
            __("Actions")
        ];
    }

    public function rows()
    {
        return config('views.rows.answers-service');
    }

    public function selects()
    {
        return [
            "status" => [
                __("Active") => "active",
                __("In Active") => "inactive",
            ],
            // "question_id" => questions(true),
        ];
    }

    public function create()
    {
        return [
            "lable" => __("Create"),
            "check" => true,
            "page" => false,
            "modal" => true,
            "id" => "creator-button"
        ];
    }

    public function tabs()
    {
        return [
            ["title" => __("Answer Info"), "id" => "answer-info", "status" => "active", "icon" => "fas fa-circle-info"],
        ];
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";
        $dir = app()->getLocale() == "ar" ? "rtl" : "ltr";

        $inputs = [
            [
                input("text", "answer_ar", "answer_ar_input_id$prefix_id", "fas fa-dumbbell", "rtl", "50", "form-control inputText$type", __("Arabic Title"), true, __("Arabic Title"), "text-danger reset-validation answer_ar-validation"),
                input("text", "answer_en", "answer_en_input_id$prefix_id", "fas fa-dumbbell", "ltr", "50", "form-control inputText$type", __("English Title"), true, __("English Title"), "text-danger reset-validation answer_en-validation"),
                select("select", "question_id", "question_id_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", __("Question"), true, questions(true), "", true, __("Question"), "text-danger reset-validation question_id-validation"),
            ],
        ];

        $contents = [
            [
                "id" => "answer-info",
                "title" => __("Answer Info"),
                "prev" => "",
                "next" => "",
                "type" => "text",
                "status" => "show active",
                "inputs" => [],
                "checkboxes" => []
            ]
        ];

        $x = 0;

        foreach ($contents as $content) {
            $content["inputs"] = $inputs[$x];
            $contents[$x] = $content;
            $x++;
        }

        return $contents;
    }

    public function fillable()
    {
        return [
            "question_id",
            "answer_ar",
            "answer_en",
        ];
    }
}
