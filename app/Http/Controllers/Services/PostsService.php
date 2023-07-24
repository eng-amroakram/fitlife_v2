<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;

class PostsService extends Controller
{
    use ServiceHelper;

    public $name = "Posts";
    public $title_creator = "Create";
    public $title_updater = "Update";
    public $modal_size = "modal-xl";
    public $creator_id = "creator-button";
    public $updater_id = "updater-button";
    public $model = Post::class;

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $paginate = $paginate == "all" ? Post::count() : $paginate;
        return Post::data()->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function __construct()
    {
        $this->model = new Post();
    }

    public function model($id)
    {
        return Post::find($id);
    }

    public function columns()
    {
        return [
            __("ID"),
            __("Tag"),
            __("Image"),
            __("Title"),
            __("Description"),
            __("Type"),
            __("Status"),
            __("Featured"),
            __("Actions")
        ];
    }

    public function rows()
    {
        return config('views.rows.posts-service');
    }

    public function selects()
    {
        return [
            "status" => [
                __("Active") => "active",
                __("In Active") => "inactive",
            ],
            "type" => [
                __("Exercise") => "exercise",
                __("Nutrition") => "nutrition",
            ],
            "featured" => [
                __("Yes") => "yes",
                __("No") => "no",
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
            ["title" => __("Post Info"), "id" => "post-info", "status" => "active", "icon" => "fas fa-circle-info"],
        ];
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";
        $dir = app()->getLocale() == "ar" ? "rtl" : "ltr";

        $types = [
            __('Exercise') => 'exercise',
            __('Nutrition') => 'nutrition'
        ];

        $features = [
            __('Yes') => 'yes',
            __('No') => 'no'
        ];


        $inputs = [
            [
                input("text", "title_ar", "title_ar_input_id$prefix_id", "fas fa-dumbbell", "rtl", "50", "form-control inputText$type", __("Arabic Title"), true, __("Arabic Title"), "text-danger reset-validation title_ar-validation"),
                input("text", "title_en", "title_en_input_id$prefix_id", "fas fa-dumbbell", "ltr", "50", "form-control inputText$type", __("English Title"), true, __("English Title"), "text-danger reset-validation title_en-validation"),
                select("select", "tag_id", "tag_id_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", __("Tag"), false, tags(true), "", true, __("Tag"), "text-danger reset-validation tag_id-validation"),
                select("select", "type", "type_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", __("Type"), false, $types, "", true, __("Type"), "text-danger reset-validation type-validation"),
                select("select", "featured", "featured_select_id$prefix_id", "fas fa-toggle-on", "", "select inputSelect$type", __("Featured"), false, $features, "", true, __("Featured"), "text-danger reset-validation featured-validation"),
                input("image", "image", "image_input_id$prefix_id", "fas fa-cloud-arrow-up", "ltr", "50", "form-control inputText$type", __("Image"), true, __("Image"), "text-danger reset-validation image-validation", false, "image/*"),
                input("textarea", "description_ar", "description_ar_input_id_$prefix_id", "fas fa-pen", "rtl", "500", "form-control inputText$type", __("Arabic Description"), true, __("Arabic Description"), "text-danger description_ar-validation fw-bold ms-5 reset-validation"),
                input("textarea", "description_en", "description_en_input_id_$prefix_id", "fas fa-pen", "ltr", "500", "form-control inputText$type", __("English Description"), true, __("English Description"), "text-danger description_en-validation fw-bold ms-5 reset-validation"),
            ],
        ];

        $contents = [
            [
                "id" => "post-info",
                "title" => __("Post Info"),
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
            'tag_id',
            'image',
            'title_ar',
            'title_en',
            'description_ar',
            'description_en',
            'type',
            'featured',
        ];
    }
}
