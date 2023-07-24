<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\MealPlan;
use App\Traits\ServiceHelper;

class MealPlansService extends Controller
{
    use ServiceHelper;

    public $name = "MealPlans";
    public $title_creator = "Create";
    public $title_updater = "Update";
    public $modal_size = "";
    public $creator_id = "creator-button";
    public $updater_id = "updater-button";
    public $model = MealPlan::class;

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $paginate = $paginate == "all" ? MealPlan::count() : $paginate;
        return MealPlan::data()->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function __construct()
    {
        $this->model = new MealPlan();
    }

    public function model($id)
    {
        return MealPlan::find($id);
    }

    public function columns()
    {
        return [
            __("ID"),
            __("Goal"),
            __("User"),
            __("Title"),
            __("Meals"),
            __("Status"),
            __("Actions")
        ];
    }

    public function rows()
    {
        return config('views.rows.meal-plans-service');
    }

    public function selects()
    {
        return [
            "status" => [
                __("Active") => "active",
                __("In Active") => "inactive",
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
            ["title" => __("Meal Plan Info"), "id" => "meal-plan-info-$prefix_id", "status" => "active", "icon" => "fas fa-circle-info"],
        ];
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "updater" : "creator";
        $dir = app()->getLocale() == "ar" ? "rtl" : "ltr";

        $inputs = [
            [
                input("text", "title_ar", "title_ar_input_id_$prefix_id", "fas fa-dumbbell", "rtl", "50", "form-control inputText$type", __("Arabic Title"), true, __("Arabic Title"), "text-danger reset-validation title_ar-validation"),
                input("text", "title_en", "title_en_input_id_$prefix_id", "fas fa-dumbbell", "ltr", "50", "form-control inputText$type", __("English Title"), true, __("English Title"), "text-danger reset-validation title_en-validation"),
                select("select", "goal_id", "goal_id_select_id_$prefix_id", "fab fa-deviantart", "", "select inputSelect$type", __("Goal"), true, goals(true), "", true, __("Goal"), "text-danger reset-validation goal_id-validation"),
                select("select", "meals", "meals_select_id_$prefix_id", "fab fa-deviantart", "", "select inputSelect$type", __("Meal"), true, meals(true), "multiple", true, __("Meal"), "text-danger reset-validation meals-validation"),
            ],
        ];

        $contents = [
            [
                "id" => "meal-plan-info-$prefix_id",
                "title" => __("Meal Plan Info"),
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
            'goal_id',
            'meals',
            'title_ar',
            'title_en',
        ];
    }
}
