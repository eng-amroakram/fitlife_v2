<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;

class UsersService extends Controller
{
    use ServiceHelper;

    public $name = "Users";
    public $title_creator = "Create";
    public $title_updater = "Update";
    public $modal_size = "modal-lg";
    public $creator_id = "creator-button";
    public $updater_id = "updater-button";
    public $model = User::class;

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        $paginate = $paginate == "all" ? User::count() : $paginate;
        return User::data()->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function __construct()
    {
        $this->model = new User();
    }

    public function model($id)
    {
        return User::find($id);
    }

    public function columns()
    {
        return [
            __("ID"),
            __("Image"),
            __("Name"),
            __("Email"),
            __("Phone"),
            __("Type"),
            __("Status"),
            __("Actions")
        ];
    }

    public function rows()
    {
        return config('views.rows.users-service');
    }

    public function selects()
    {
        return [
            "status" => [
                __("Active") => "active",
                __("Inactive") => "inactive",
            ],

            "type" => [
                __("Admin") => "admin",
                __("Client") => "client",
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
            ["title" => __("User Info"), "id" => "user-info", "status" => "active", "icon" => "fas fa-circle-info"],
        ];
    }



    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";
        $dir = app()->getLocale() == "ar" ? "rtl" : "ltr";


        $types = [
            __("Admin") => "admin",
            __("Client") => "client",
        ];

        $genders = [
            __("Male") => "male",
            __("Female") => "female",

        ];

        $inputs = [
            [
                input("text", "name", "name_input_id$prefix_id", "fas fa-user", "ltr", "50", "form-control inputText$type", __("Name"), true, __("Name"), "text-danger reset-validation name-validation"),
                input("text", "email", "email_input_id$prefix_id", "fas fa-user", "ltr", "50", "form-control inputText$type", __("Email"), true, __("Email"), "text-danger reset-validation email-validation"),
                input("text", "phone", "phone_input_id$prefix_id", "fas fa-user", "ltr", "50", "form-control inputText$type", __("Phone"), true, __("Phone"), "text-danger reset-validation phone-validation"),
                select("select", "gender", "gender_select_id_$prefix_id", "fab fa-deviantart", "", "select inputSelect$type", __("Gender"), true, $genders, "", true, __("Gender"), "text-danger reset-validation gender-validation"),
                input("password", "password", "password_input_id$prefix_id", "fas fa-user", "ltr", "50", "form-control inputText$type", __("Password"), true, __("Password"), "text-danger reset-validation password-validation"),
                input("image", "image", "image_input_id$prefix_id", "fas fa-cloud-arrow-up", "ltr", "50", "form-control inputText$type", __("Image"), true, __("Image"), "text-danger reset-validation image-validation", false, "image/*"),
                select("select", "type", "type_select_id_$prefix_id", "fab fa-deviantart", "", "select inputSelect$type", __("User Type"), true, $types, "", true, __("User Type"), "text-danger reset-validation type-validation"),
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
            'name',
            'type',
            'gender',
            'image',
            'email',
            'phone',
            'password',
        ];
    }
}
