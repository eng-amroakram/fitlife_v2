<?php

use App\Http\Controllers\Services\Services;
use App\Models\Equipment;
use App\Models\Exercise;
use App\Models\FoodExchange;
use App\Models\FoodType;
use App\Models\Goal;
use App\Models\Meal;
use App\Models\MealType;
use App\Models\MeasurementUnit;
use App\Models\Muscle;
use App\Models\Recipe;
use App\Models\Tag;


if (!function_exists('badge')) {
    function badge($type)
    {
        if (in_array($type, ["no", "لا"])) {
            return "badge rounded-pill badge-danger";
        }

        if ($type == "مكتب") {
            return "badge rounded-pill badge-warning";
        }

        if (in_array($type, ['Client', 'ادمن', 'عميل', 'client'])) {
            return "badge rounded-pill badge-info";
        }

        if (in_array($type, ["yes", "نعم", 'Admin', 'مدير', 'admin'])) {
            return "badge rounded-pill badge-success";
        }
    }
}



if (!function_exists('muscles')) {
    function muscles($search = null)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";

        if ($search) {
            return Muscle::data()->pluck($title, 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Muscle::data()->get();
    }
}


if (!function_exists('tags')) {
    function tags($search = null)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";

        if ($search) {
            return Tag::data()->pluck($title, 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Tag::data()->get();
    }
}


if (!function_exists('meal_types')) {
    function meal_types($search = null)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";

        if ($search) {
            return MealType::data()->pluck($title, 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return MealType::data()->get();
    }
}

if (!function_exists('food_types')) {
    function food_types($search = null)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";

        if ($search) {
            return FoodType::data()->pluck($title, 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return FoodType::data()->get();
    }
}


if (!function_exists('recipes')) {
    function recipes($search = null)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";

        if ($search) {
            return Recipe::data()->pluck($title, 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Recipe::data()->get();
    }
}

if (!function_exists('measurement_units')) {
    function measurement_units($search = null)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";

        if ($search) {
            return MeasurementUnit::data()->pluck($title, 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return MeasurementUnit::data()->get();
    }
}


if (!function_exists('getMusclesNames')) {
    function getMusclesNames($ids)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";
        return Muscle::data()->whereIn('id', $ids)->pluck($title)->toArray();
    }
}

if (!function_exists('getRecipesNames')) {
    function getRecipesNames($ids)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";
        return Recipe::data()->whereIn('id', $ids)->pluck($title)->toArray();
    }
}

if (!function_exists('mealsNames')) {
    function mealsNames($ids)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";
        return Meal::data()->whereIn('id', $ids)->pluck($title)->toArray();
    }
}



if (!function_exists('getEquipmentNames')) {
    function getEquipmentNames($ids)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";
        return Equipment::data()->whereIn('id', $ids)->pluck($title)->toArray();
    }
}

if (!function_exists('getExerciseNames')) {
    function getExerciseNames($ids)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";
        return Exercise::data()->whereIn('id', $ids)->pluck($title)->toArray();
    }
}

//getFoodExchangeNames

if (!function_exists('getFoodExchangeNames')) {
    function getFoodExchangeNames($ids)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";
        return FoodExchange::data()->whereIn('id', $ids)->pluck($title)->toArray();
    }
}

if (!function_exists('getMeasurementUnitsNames')) {
    function getMeasurementUnitsNames($ids)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";
        return [];
    }
}


























if (!function_exists('equipment')) {
    function equipment($search = null)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";

        if ($search) {
            return Equipment::data()->pluck($title, 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Equipment::data()->get();
    }
}

if (!function_exists('goals')) {
    function goals($search = null)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";

        if ($search) {
            return Goal::data()->pluck($title, 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Goal::data()->get();
    }
}

if (!function_exists('meals')) {
    function meals($search = null)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";

        if ($search) {
            return Meal::data()->pluck($title, 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Meal::data()->get();
    }
}


if (!function_exists('food_exchanges')) {
    function food_exchanges($search = null)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";

        if ($search) {
            return FoodExchange::data()->pluck($title, 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return FoodExchange::data()->get();
    }
}


if (!function_exists('exercises')) {
    function exercises($search = null)
    {
        $title = app()->getLocale() == "ar" ? "title_ar" : "title_en";

        if ($search) {
            return Exercise::data()->pluck($title, 'id')->mapWithKeys(function ($name, $id) {
                return [$name => $id];
            })->toArray();
        }

        return Exercise::data()->get();
    }
}

if (!function_exists('models_count')) {
    function models_count($model)
    {
        $model =  Services::createModelInstance($model);
        return $model::count();
    }
}
