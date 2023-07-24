<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Traits\ServiceHelper;

class ExercisesService extends Controller
{
    use ServiceHelper;

    public $name = "Exercises";
    public $title_creator = "Create";
    public $title_updater = "Update";
    public $modal_size = "modal-xl";
    public $creator_id = "creator-button";
    public $updater_id = "updater-button";
    public $model = Exercise::class;

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $paginate = $paginate == "all" ? Exercise::count() : $paginate;
        return Exercise::data()->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function __construct()
    {
        $this->model = new Exercise();
    }

    public function model($id)
    {
        return Exercise::find($id);
    }

    public function columns()
    {
        return [
            __("ID"),
            __("Image"),
            __("Video"),
            __("Title"),
            __("Muscles"),
            __("Equipment"),
            __("Level"),
            __("Place"),
            __("Type"),
            __("Status"),
            __("Actions")
        ];
    }

    public function rows()
    {
        return config('views.rows.exercises-service');
    }

    public function selects()
    {
        return [
            "status" => [
                __("Active") => "active",
                __("Inactive") => "inactive",
            ],
            "type" => [
                __('Cardio') => 'cardio',
                __('Warming') => 'warming',
                __('Cooling') => 'cooling',
                __('Exercise') => 'exercise'
            ],
            "level" => [
                __("Beginner") => "beginner",
                __("Intermediate") => "intermediate",
                __("Advanced") => "advanced",
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

    public function tabs($type)
    {
        $prefix_id = $type == "Updater" ? "updater" : "creator";

        return [
            ["title" => __("Exercise Info"), "id" => "exercise-info-$prefix_id", "status" => "active", "icon" => "fas fa-circle-info"],
            ["title" => __("Exercise Description"), "id" => "exercise-description-$prefix_id", "status" => "", "icon" => "fas fa-align-justify"],
            ["title" => __("Exercise Media"), "id" => "exercise-media-$prefix_id", "status" => "", "icon" => "fas fa-photo-film"],
        ];
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "updater" : "creator";
        $dir = app()->getLocale() == "ar" ? "rtl" : "ltr";

        $types = [
            __("Cardio") => "cardio",
            __("Warming") => "warming",
            __("Cooling") => "cooling",
            __("Exercise") => "exercise",
        ];

        $levels = [
            __("Beginner") => "beginner",
            __("Intermediate") => "intermediate",
            __("Advanced") => "advanced",
        ];

        $places = [
            __("Gym") => "gym",
            __("Home") => "home",
        ];

        $inputs = [
            [
                input("text", "title_ar", "title_ar_input_id_$prefix_id", "fas fa-dumbbell", "rtl", "50", "form-control inputText$type", __("Arabic Title"), true, __("Arabic Title"), "text-danger reset-validation title_ar-validation"),
                input("text", "title_en", "title_en_input_id_$prefix_id", "fas fa-dumbbell", "ltr", "50", "form-control inputText$type", __("English Title"), true, __("English Title"), "text-danger reset-validation title_en-validation"),
                select("select", "type", "type_select_id_$prefix_id", "fas fa-sliders", "", "select inputSelect$type", __("Type"), true, $types, "", true, __("Type"), "text-danger reset-validation type-validation"),
                select("select", "muscle_ids", "muscle_ids_select_id_$prefix_id", "fab fa-deviantart", "", "select inputSelect$type", __("Muscle"), true, muscles(true), "multiple", true, __("Muscle"), "text-danger reset-validation muscle_ids-validation"),
                select("select", "equipment_ids", "equipment_ids_select_id_$prefix_id", "fab fa-deviantart", "", "select inputSelect$type", __("Equipment"), true, equipment(true), "multiple", true, __("Equipment"), "text-danger reset-validation equipment_ids-validation"),
                select("select", "level", "level_select_id_$prefix_id", "fas fa-turn-up", "", "select inputSelect$type", __("Level"), true, $levels, "", true, __("Level"), "text-danger reset-validation level-validation"),
                select("select", "place", "place_select_id_$prefix_id", "fas fa-turn-up", "", "select inputSelect$type", __("Place"), true, $places, "multiple", true, __("Place"), "text-danger reset-validation place-validation"),
            ],
            [
                input("textarea", "description_ar", "description_ar_input_id_$prefix_id", "fas fa-pen", "rtl", "500", "form-control inputText$type", __("Arabic Description"), true, __("Arabic Description"), "text-danger description_ar-validation fw-bold ms-5 reset-validation"),
                input("textarea", "description_en", "description_en_input_id_$prefix_id", "fas fa-pen", "ltr", "500", "form-control inputText$type", __("English Description"), true, __("English Description"), "text-danger description_en-validation fw-bold ms-5 reset-validation"),
                input("textarea", "tips_ar", "tips_ar_input_id_$prefix_id", "fas fa-pen", "rtl", "500", "form-control inputText$type", __("Arabic Tips"), true, __("Arabic Tips"), "text-danger tips_ar-validation fw-bold ms-5 reset-validation"),
                input("textarea", "tips_en", "tips_en_input_id_$prefix_id", "fas fa-pen", "ltr", "500", "form-control inputText$type", __("English Tips"), true, __("English Tips"), "text-danger tips_en-validation fw-bold ms-5 reset-validation"),
            ],
            [
                input("image", "video", "video_input_id_$prefix_id", "fas fa-video", "ltr", "50", "form-control inputText$type", __("Video"), true, __("Video"), "text-danger reset-validation video-validation", false, "video/mp4"),
                input("image", "image", "image_input_id_$prefix_id", "fas fa-cloud-arrow-up", "ltr", "50", "form-control inputText$type", __("Image"), true, __("Image"), "text-danger reset-validation image-validation", false, "image/*"),
            ]
        ];

        $contents = [
            [
                "id" => "exercise-info-$prefix_id",
                "title" => __("Exercise Info"),
                "prev" => "",
                "next" => "",
                "type" => "text",
                "status" => "show active",
                "inputs" => [],
                "checkboxes" => []
            ],
            [
                "id" => "exercise-description-$prefix_id",
                "title" => __("Exercise Description"),
                "prev" => "",
                "next" => "",
                "type" => "text",
                "status" => "",
                "inputs" => [],
                "checkboxes" => []
            ],
            [
                "id" => "exercise-media-$prefix_id",
                "title" => __("Exercise Media"),
                "prev" => "",
                "next" => "",
                "type" => "text",
                "status" => "",
                "inputs" => [],
                "checkboxes" => []
            ],
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
            'muscle_ids',
            'equipment_ids',
            'title_ar',
            'title_en',
            'description_ar',
            'description_en',
            'tips_ar',
            'tips_en',
            'place',
            'type',
            'level',
            'status',
            'image',
            'video',
        ];
    }
}
