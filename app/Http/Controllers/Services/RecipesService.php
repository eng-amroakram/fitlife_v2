<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Traits\ServiceHelper;

class RecipesService extends Controller
{
    use ServiceHelper;

    public $name = "Recipes";
    public $title_creator = "Create";
    public $title_updater = "Update";
    public $modal_size = "modal-lg";
    public $creator_id = "creator-button";
    public $updater_id = "updater-button";
    public $model = Recipe::class;

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $paginate = $paginate == "all" ? Recipe::count() : $paginate;
        return Recipe::data()->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function __construct()
    {
        $this->model = new Recipe();
    }

    public function model($id)
    {
        return Recipe::find($id);
    }

    public function columns()
    {
        return [
            __("ID"),
            __("Image"),
            __("Title"),
            __("Food Exchange"),
            __("Status"),
            __("Actions")
        ];
    }

    public function rows()
    {
        return config('views.rows.recipes-service');
    }

    public function selects()
    {
        return [
            "food_exchange_names" => [],
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

    public function tabs($type)
    {
        $prefix_id = $type == "Updater" ? "updater" : "creator";

        return [
            ["title" => __("Recipe Info"), "id" => "recipe-info-$prefix_id", "status" => "active", "icon" => "fas fa-circle-info"],
        ];
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "updater" : "creator";
        $dir = app()->getLocale() == "ar" ? "rtl" : "ltr";

        $inputs = [
            [
                input("text", "title_en", "title_en_input_id_$prefix_id", "fas fa-dumbbell", "ltr", "50", "form-control inputText$type", __("English Title"), true, __("English Title"), "text-danger reset-validation title_en-validation"),
                input("text", "title_ar", "title_ar_input_id_$prefix_id", "fas fa-dumbbell", "rtl", "50", "form-control inputText$type", __("Arabic Title"), true, __("Arabic Title"), "text-danger reset-validation title_ar-validation"),
                select("select", "food_exchange_ids", "food_exchange_ids_select_id_$prefix_id", "fab fa-deviantart", "", "select inputSelect$type", __("Food Exchange"), true, food_exchanges(true), "multiple", true, __("Food Exchange"), "text-danger reset-validation food_exchange_ids-validation"),
                input("image", "image", "image_input_id_$prefix_id", "fas fa-cloud-arrow-up", "ltr", "50", "form-control inputText$type", __("Image"), true, __("Image"), "text-danger reset-validation image-validation", false, "image/*"),
                input("textarea", "description_en", "description_en_input_id_$prefix_id", "fas fa-pen", "ltr", "500", "form-control inputText$type", __("English Description"), true, __("English Description"), "text-danger description_en-validation fw-bold ms-5 reset-validation"),
                input("textarea", "description_ar", "description_ar_input_id_$prefix_id", "fas fa-pen", "rtl", "500", "form-control inputText$type", __("Arabic Description"), true, __("Arabic Description"), "text-danger description_ar-validation fw-bold ms-5 reset-validation"),
                input("textarea", "other_info_en", "other_info_en_input_id_$prefix_id", "fas fa-pen", "ltr", "500", "form-control inputText$type", __("English Other Info"), true, __("English Other Info"), "text-danger other_info_en-validation fw-bold ms-5 reset-validation"),
                input("textarea", "other_info_ar", "other_info_ar_input_id_$prefix_id", "fas fa-pen", "rtl", "500", "form-control inputText$type", __("Arabic Other Info"), true, __("Arabic Other Info"), "text-danger other_info_ar-validation fw-bold ms-5 reset-validation"),
            ],
        ];

        $contents = [
            [
                "id" => "recipe-info-$prefix_id",
                "title" => __("Recipe Info"),
                "prev" => "",
                "next" => "",
                "type" => "text",
                "status" => "show active",
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
            "image",
            "title_ar",
            "title_en",
            "description_ar",
            "description_en",
            "other_info_ar",
            "other_info_en",
            "food_exchange_ids",
        ];
    }
}
