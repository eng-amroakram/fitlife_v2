<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Muscle;
use App\Traits\ServiceHelper;

class MusclesService extends Controller
{
    use ServiceHelper;

    public $name = "Muscles";
    public $title_creator = "Create";
    public $title_updater = "Update";
    public $modal_size = "";
    public $creator_id = "creator-button";
    public $updater_id = "updater-button";
    public $model = Muscle::class;

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $paginate = $paginate == "all" ? Muscle::count() : $paginate;
        return Muscle::data()->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function __construct()
    {
        $this->model = new Muscle();
    }

    public function model($id)
    {
        return Muscle::find($id);
    }

    public function columns()
    {
        return [
            __("ID"),
            __("Image"),
            __("Title"),
            __("Status"),
            __("Actions")
        ];
    }

    public function rows()
    {
        return config('views.rows.muscles-service');
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
            ["title" => __("Muscle Info"), "id" => "muscle-info", "status" => "active", "icon" => "fas fa-circle-info"],
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
                // select("select", "status", "status_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", __("Status"), false, [__("Active") => "active", __("In Active") => "inactive",], "", true, __("Status"), "text-danger reset-validation status-validation"),
            ],
        ];

        $contents = [
            [
                "id" => "muscle-info",
                "title" => __("Muscle Info"),
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
        return $this->model->getFillable();
    }
}
