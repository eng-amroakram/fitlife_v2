<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\FoodExchange;
use App\Traits\ServiceHelper;

class FoodExchangesService extends Controller
{
    use ServiceHelper;

    public $name = "FoodExchanges";
    public $title_creator = "Create";
    public $title_updater = "Update";
    public $modal_size = "";
    public $creator_id = "creator-button";
    public $updater_id = "updater-button";
    public $model = FoodExchange::class;

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $paginate = $paginate == "all" ? FoodExchange::count() : $paginate;
        return FoodExchange::data()->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function __construct()
    {
        $this->model = new FoodExchange();
    }

    public function model($id)
    {
        return FoodExchange::find($id);
    }

    public function columns()
    {
        return [
            __("ID"),
            __("Title"),
            __("Status"),
            __("Actions")
        ];
    }

    public function rows()
    {
        return config('views.rows.food-exchanges-service');
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

    public function tabs()
    {
        return [
            ["title" => __("Food Exchange Info"), "id" => "food-exchange-info", "status" => "active", "icon" => "fas fa-circle-info"],
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
                select("select", "food_type_id", "food_type_id_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", __("Food Type"), false, food_types(true), "", true, __("Food Type"), "text-danger reset-validation food_type_id-validation"),
                select("select", "measurement_unit_ids", "measurement_unit_ids_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", __("Measurement Units"), true, measurement_units(true), "multiple", true, __("Measurement Units"), "text-danger reset-validation measurement_unit_ids-validation"),
                input("number", "quantity", "quantity_input_id$prefix_id", "fas fa-scale-unbalanced-flip", "ltr", "50", "form-control inputText$type", __("Quantity"), true, __("Quantity"), "text-danger reset-validation quantity-validation", false),
            ],
        ];

        $contents = [
            [
                "id" => "food-exchange-info",
                "title" => __("Food Exchange Info"),
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
            'measurement_unit_ids',
            'food_type_id',
            'title_ar',
            'title_en',
            'quantity',
            'image',
        ];
    }
}
