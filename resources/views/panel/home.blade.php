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
                        <i class="fas fa-dumbbell bg-color-green mr-3 z-depth-2"></i>
                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">{{ __('Exercises') }}</p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('Exercise') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
