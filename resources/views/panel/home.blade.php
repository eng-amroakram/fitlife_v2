@extends('partials.panel.layout')
@section('title', $title)
<link rel="stylesheet"
    href="{{ app()->getLocale() == 'ar' ? asset('assets/css/custom.card.css') : asset('assets/css/custom.card-en.css') }}">

@section('content')
    <section class="mt-md-4 pt-md-2 mb-5 pb-4">
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-users bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Users') }}</p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('User') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-bullseye bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Goals') }}</p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('Goal') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-dumbbell bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Exercises') }}</p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('Exercise') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-person bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Muscles') }}</p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('Muscle') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-wrench bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Equipment') }}</p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('Equipment') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-circle-radiation bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Challenges') }}</p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('Challenge') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-clipboard-list bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Meal Plans') }}</p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('MealPlan') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-utensils bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Meal Types') }}</p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('MealType') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-utensils bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Meals') }}</p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('Meal') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-clipboard-list bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Recipes') }}</p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('Recipe') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-scale-balanced bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Measurement Units') }}
                            </p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('MeasurementUnit') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-cloud-meatball bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Food Types') }}
                            </p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('FoodType') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-right-left bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Food Exchanges') }}
                            </p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('FoodExchange') }}</h4>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-tags bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Tags') }}
                            </p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('Tag') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-bars-staggered bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Tips') }}
                            </p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('Tip') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade color-green cascading-admin-card">
                    <div class="admin-up">
                        <i class="fas fa-bolt bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Posts') }}
                            </p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('Post') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
