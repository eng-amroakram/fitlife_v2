<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;

class MealsService extends Controller
{
    use ServiceHelper;

    public $name = "Meals";
    public $title_creator = "Create";
    public $title_updater = "Update";
    public $modal_size = "";
    public $creator_id = "creator-button";
    public $updater_id = "updater-button";
    public $model = Meal::class;

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $paginate = $paginate == "all" ? Meal::count() : $paginate;
        return Meal::data()->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function __construct()
    {
        $this->model = new Meal();
    }

    public function model($id)
    {
        return Meal::find($id);
    }

    public function columns()
    {
        return [
            __("ID"),
            __("Meal Type"),
            __("Title"),
            __("Status"),
            __("Actions")
        ];
    }

    public function rows()
    {
        return config('views.rows.meals-service');
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
            ["title" => __("Meal Info"), "id" => "meal-info", "status" => "active", "icon" => "fas fa-circle-info"],
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
                select("select", "meal_type_id", "meal_type_id_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", __("Meal Type"), false, meal_types(true), "", true, __("Meal Type"), "text-danger reset-validation meal_type_id-validation"),
                select("select", "recipes", "recipes_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", __("Recipes"), false, recipes(true), "multiple", true, __("Recipes"), "text-danger reset-validation recipes-validation"),
            ],
        ];

        $contents = [
            [
                "id" => "meal-info",
                "title" => __("Meal Info"),
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
            'meal_type_id',
            'recipes',
            'title_ar',
            'title_en',
        ];
    }
}
