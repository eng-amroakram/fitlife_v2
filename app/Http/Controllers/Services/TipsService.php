<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Tip;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;

class TipsService extends Controller
{
    use ServiceHelper;

    public $name = "Tags";
    public $title_creator = "Create";
    public $title_updater = "Update";
    public $modal_size = "";
    public $creator_id = "creator-button";
    public $updater_id = "updater-button";
    public $model = Tip::class;

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $paginate = $paginate == "all" ? Tip::count() : $paginate;
        return Tip::data()->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function __construct()
    {
        $this->model = new Tip();
    }

    public function model($id)
    {
        return Tip::find($id);
    }

    public function columns()
    {
        return [
            __("ID"),
            __("Image"),
            __("Title"),
            __("Description"),
            __("Status"),
            __("Actions")
        ];
    }

    public function rows()
    {
        return config('views.rows.tips-service');
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
            ["title" => __("Tip Info"), "id" => "tip-info", "status" => "active", "icon" => "fas fa-circle-info"],
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
                input("textarea", "description_ar", "description_ar_input_id_$prefix_id", "fas fa-pen", "rtl", "500", "form-control inputText$type", __("Arabic Description"), true, __("Arabic Description"), "text-danger description_ar-validation fw-bold ms-5 reset-validation"),
                input("textarea", "description_en", "description_en_input_id_$prefix_id", "fas fa-pen", "ltr", "500", "form-control inputText$type", __("English Description"), true, __("English Description"), "text-danger description_en-validation fw-bold ms-5 reset-validation"),
            ],
        ];

        $contents = [
            [
                "id" => "tip-info",
                "title" => __("Tip Info"),
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
            'image',
        ];
    }
}
