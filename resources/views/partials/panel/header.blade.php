<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">

        <a class="ripple d-flex justify-content-center py-2" href="#!" data-ripple-color="primary">
            <img id="MDB-logo" src="{{ asset('assets/images/logo.png') }}?lang={{ app()->getLocale() }}" width="150"
                alt="MDB Logo" draggable="false">
        </a>

        <div class="position-sticky scrollable-nav">
            <div class="list-group list-group-flush mt-4">

                <a href="{{ route('panel.home') }}?lang={{ app()->getLocale() }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.home' ? ' active' : '' }}"
                    aria-current="true">
                    <i class="fas fa-tachometer-alt fa-fw"></i>
                    <span>{{ __('Dashboard') }}</span>
                </a>

                <a href="#exercises">

                    <a class="list-group-item list-group-item-action py-2 ripple" data-toggle="collapse"
                        href="#exercises" role="button" aria-expanded="false" tabindex="1">
                        <i class="fas fa-dumbbell pr-3"></i>
                        {{ __('Exercises Section') }}
                        <i class="fas fa-angle-down {{ app()->getLocale() == 'ar' ? 'ms-lg-4' : 'me-lg-4' }} rotate-icon"
                            style="transform: rotate(0deg);"></i>
                    </a>

                    <ul class="sidenav-collapse collapse {{ in_array(Route::currentRouteName(), config('routes.links.exercises')) ? 'show' : '' }}"
                        style="list-style: none; padding: 0; margin: 0;" id="exercises">
                        <li>
                            <a href="{{ route('panel.exercises.index') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.exercises.index' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-dumbbell"></i>
                                <span>{{ __('Exercises') }}</span>
                            </a>
                        </li>

                        {{-- <li>
                            <a href="{{ route('panel.exercises.workouts') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.exercises.workouts' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-diagram-project"></i>
                                <span>{{ __('Workouts') }}</span>
                            </a>
                        </li> --}}

                        <li>
                            <a href="{{ route('panel.exercises.muscles') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.exercises.muscles' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-person"></i>
                                <span>{{ __('Muscles') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.exercises.equipment') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.exercises.equipment' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-wrench"></i>
                                <span>{{ __('Equipment') }}</span>
                            </a>
                        </li>

                        {{--
                        <li>
                            <a href="{{ route('panel.exercises.levels') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.exercises.levels' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-turn-up"></i>
                                <span>{{ __('Levels') }}</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('panel.exercises.goals') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.exercises.goals' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-bullseye"></i>
                                <span>{{ __('Goals') }}</span>
                            </a>
                        </li> --}}


                        <li>
                            <a href="{{ route('panel.exercises.challenges') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.exercises.challenges' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-circle-radiation"></i>
                                <span>{{ __('Challenges') }}</span>
                            </a>
                        </li>

                    </ul>
                </a>


                <a href="#nutritions">

                    <a class="list-group-item list-group-item-action py-2 ripple" data-toggle="collapse"
                        href="#nutritions" role="button" aria-expanded="false" tabindex="1">
                        <i class="fas fa-carrot pr-3"></i>
                        {{ __('Nutritions Section') }}
                        <i class="fas fa-angle-down {{ app()->getLocale() == 'ar' ? 'ms-lg-4' : 'me-lg-4' }} rotate-icon"
                            style="transform: rotate(0deg);"></i>
                    </a>

                    <ul class="sidenav-collapse collapse {{ in_array(Route::currentRouteName(), config('routes.links.nutritions')) ? 'show' : '' }}"
                        style="list-style: none; padding: 0; margin: 0;" id="nutritions">


                        <li>
                            <a href="{{ route('panel.nutritions.meal-plans') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.nutritions.meal-plans' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-clipboard-list"></i>
                                <span>{{ __('Meal Plan') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.nutritions.meal-types') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.nutritions.meal-types' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-utensils"></i>
                                <span>{{ __('Meal Type') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.nutritions.meals') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.nutritions.meals' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-utensils"></i>
                                <span>{{ __('Meal') }}</span>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('panel.nutritions.recipes') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.nutritions.recipes' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-clipboard-list"></i>
                                <span>{{ __('Recipes') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.nutritions.measurement-units') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.nutritions.measurement-units' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-scale-balanced"></i>
                                <span>{{ __('Measurement Units') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.nutritions.food-types') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.nutritions.food-types' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-cloud-meatball"></i>
                                <span>{{ __('Food Types') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.nutritions.food-exchanges') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.nutritions.food-exchanges' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-right-left"></i>
                                <span>{{ __('Food Exchanges') }}</span>
                            </a>
                        </li>

                    </ul>
                </a>

                <a href="#information">

                    <a class="list-group-item list-group-item-action py-2 ripple" data-toggle="collapse"
                        href="#information" role="button" aria-expanded="false" tabindex="1">
                        <i class="fas fa-envelopes-bulk pr-3"></i>
                        {{ __('Information Section') }}
                        <i class="fas fa-angle-down {{ app()->getLocale() == 'ar' ? 'ms-lg-4' : 'me-lg-4' }} rotate-icon"
                            style="transform: rotate(0deg);"></i>
                    </a>

                    <ul class="sidenav-collapse collapse {{ in_array(Route::currentRouteName(), config('routes.links.information')) ? 'show' : '' }}"
                        style="list-style: none; padding: 0; margin: 0;" id="information">

                        <li>
                            <a href="{{ route('panel.information.tags') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.information.tags' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-tags"></i>
                                <span>{{ __('Tags') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.information.tips') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.information.tips' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-bars-staggered"></i>
                                <span>{{ __('tips') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.information.posts') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.information.posts' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-bolt"></i>
                                <span>{{ __('posts') }}</span>
                            </a>
                        </li>

                    </ul>
                </a>

                <a href="#settings">

                    <a class="list-group-item list-group-item-action py-2 ripple" data-toggle="collapse"
                        href="#settings" role="button" aria-expanded="false" tabindex="1">
                        <i class="fas fa-screwdriver-wrench pr-3"></i>
                        {{ __('Settings Section') }}
                        <i class="fas fa-angle-down {{ app()->getLocale() == 'ar' ? 'ms-lg-4' : 'me-lg-4' }} rotate-icon"
                            style="transform: rotate(0deg);"></i>
                    </a>

                    <ul class="sidenav-collapse collapse {{ in_array(Route::currentRouteName(), config('routes.links.settings')) ? 'show' : '' }}"
                        style="list-style: none; padding: 0; margin: 0;" id="settings">

                        <li>
                            <a href="{{ route('panel.settings.index') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.settings.index' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-sliders"></i>
                                <span>{{ __('Web Site Settings') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.settings.users') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.settings.users' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-users"></i>
                                <span>{{ __('Users') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.settings.goals') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.settings.goals' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-bullseye"></i>
                                <span>{{ __('Goals') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.settings.questions') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.settings.questions' ? ' active' : '' }}">
                                <i class="ms-3 far fa-circle-question"></i>
                                <span>{{ __('Questions') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.settings.answers') }}?lang={{ app()->getLocale() }}"
                                class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.settings.answers' ? ' active' : '' }}">
                                <i class="ms-3 fas fa-voicemail"></i>
                                <span>{{ __('Answers') }}</span>
                            </a>
                        </li>

                    </ul>
                </a>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <!-- <img src="images/logo.png" height="25" alt="MDB Logo" loading="lazy" /> -->
            </a>

            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a class="text-reset me-3 dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li class="logout">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-arrow-right-from-bracket text-danger"></i>
                                <span class="ms-1">{{ __('Logout') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="dropdown">
                    <a class="text-reset me-3 dropdown-toggle" type="button" id="language"
                        data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-language"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="language">

                        <li>
                            <a class="dropdown-item" href="{{ route(Route::currentRouteName()) }}?lang=en">
                                <i class="fas fa-earth-americas"></i>
                                <span class="ms-1">{{ __('English') }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route(Route::currentRouteName()) }}?lang=ar">
                                <i class="fas fa-earth-americas"></i>
                                <span class="ms-1">{{ __('Arabic') }}</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

</header>
