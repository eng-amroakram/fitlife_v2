<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;

class QuestionsService extends Controller
{
    use ServiceHelper;

    public $name = "Questions";
    public $title_creator = "Create";
    public $title_updater = "Update";
    public $modal_size = "";
    public $creator_id = "creator-button";
    public $updater_id = "updater-button";
    public $model = Question::class;

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $paginate = $paginate == "all" ? Question::count() : $paginate;
        return Question::data()->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function __construct()
    {
        $this->model = new Question();
    }

    public function model($id)
    {
        return Question::find($id);
    }

    public function columns()
    {
        return [
            __("ID"),
            __("Question"),
            __("Status"),
            __("Actions")
        ];
    }

    public function rows()
    {
        return config('views.rows.questions-service');
    }

    public function selects()
    {
        return [
            "status" => [
                __("Active") => "active",
                __("Inactive") => "inactive",
            ],
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
            ["title" => __("Question Info"), "id" => "question-info", "status" => "active", "icon" => "fas fa-circle-info"],
        ];
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";
        $dir = app()->getLocale() == "ar" ? "rtl" : "ltr";

        $inputs = [
            [
                input("text", "question_ar", "question_ar_input_id$prefix_id", "fas fa-dumbbell", "rtl", "50", "form-control inputText$type", __("Arabic Question"), true, __("Arabic Question"), "text-danger reset-validation question_ar-validation"),
                input("text", "question_en", "question_en_input_id$prefix_id", "fas fa-dumbbell", "ltr", "50", "form-control inputText$type", __("English Question"), true, __("English Question"), "text-danger reset-validation question_en-validation"),
            ],
        ];

        $contents = [
            [
                "id" => "question-info",
                "title" => __("Question Info"),
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
            "question_ar",
            "question_en",
        ];
    }
}
