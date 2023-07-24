<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;

class ChallengesService extends Controller
{
    use ServiceHelper;

    public $name = "Challenges";
    public $title_creator = "Create";
    public $title_updater = "Update";
    public $modal_size = "modal-lg";
    public $creator_id = "creator-button";
    public $updater_id = "updater-button";
    public $model = Challenge::class;

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $paginate = $paginate == "all" ? Challenge::count() : $paginate;
        return Challenge::data()->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function __construct()
    {
        $this->model = new Challenge();
    }

    public function model($id)
    {
        return Challenge::find($id);
    }

    public function columns()
    {
        return [
            __("ID"),
            __("Image"),
            __("Title"),
            __("Description"),
            __("Exercises"),
            __("Status"),
            __("Actions")
        ];
    }

    public function rows()
    {
        return config('views.rows.challenges-service');
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
            ["title" => __("Challenge Info"), "id" => "challenge-info", "status" => "active", "icon" => "fas fa-circle-info"],
        ];
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";
        $dir = app()->getLocale() == "ar" ? "rtl" : "ltr";

        $inputs = [
            [
                input("text", "title_ar", "title_ar_input_id$prefix_id", "fas fa-dumbbell", "rtl", "50", "form-control inputText$type", __("Arabic Title"), true, __("Arabic Title"), "text-danger reset-validation title_ar-validation"),
                input("text", "title_en", "title_en_input_id$prefix_id", "fas fa-dumbbell", "ltr", "50", "form-control inputText$type", __("English Title"), true, __("English Title"), "text-danger reset-validation title_en-validation"),

                input("image", "image", "image_input_id$prefix_id", "fas fa-cloud-arrow-up", "ltr", "50", "form-control inputText$type", __("Image"), true, __("Image"), "text-danger reset-validation image-validation", false, "image/*"),
                select("select", "exercise_ids", "exercise_ids_select_id_$prefix_id", "fab fa-deviantart", "", "select inputSelect$type", __("Exercises"), true, exercises(true), "multiple", true, __("Exercises"), "text-danger reset-validation exercise_ids-validation"),

                input("textarea", "description_ar", "description_ar_input_id_$prefix_id", "fas fa-pen", "rtl", "500", "form-control inputText$type", __("Arabic Description"), true, __("Arabic Description"), "text-danger description_ar-validation fw-bold ms-5 reset-validation"),
                input("textarea", "description_en", "description_en_input_id_$prefix_id", "fas fa-pen", "ltr", "500", "form-control inputText$type", __("English Description"), true, __("English Description"), "text-danger description_en-validation fw-bold ms-5 reset-validation"),

            ],
        ];

        $contents = [
            [
                "id" => "challenge-info",
                "title" => __("Challenge Info"),
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
            'title_ar',
            'title_en',
            'description_ar',
            'description_en',
            'exercise_ids',
            'image',
        ];
    }
}
