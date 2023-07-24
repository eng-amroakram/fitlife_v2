<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NutritionController extends Controller
{
    public function recipes()
    {
        return view('panel.table', ['title' => __('Recipes'), 'service' => 'RecipesService', "create_check" => true]);
    }

    public function foodTypes()
    {
        return view('panel.table', ['title' => __('Food Types'), 'service' => 'FoodTypesService', "create_check" => true]);
    }

    public function foodExchanges()
    {
        return view('panel.table', ['title' => __('Food Exchanges'), 'service' => 'FoodExchangesService', "create_check" => true]);
    }

    public function meals()
    {
        return view('panel.table', ['title' => __('Meals'), 'service' => 'MealsService', "create_check" => true]);
    }

    public function mealTypes()
    {
        return view('panel.table', ['title' => __('Meal Types'), 'service' => 'MealTypesService', "create_check" => true]);
    }

    public function measurementUnits()
    {
        return view('panel.table', ['title' => __('Measurement Units'), 'service' => 'MeasurementUnitsService', "create_check" => true]);
    }

    public function mealPlans()
    {
        return view('panel.table', ['title' => __('Meal Plans'), 'service' => 'MealPlansService', "create_check" => true]);
    }
}
