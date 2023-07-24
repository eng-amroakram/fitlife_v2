@extends('partials.panel.layout')
@section('title', $title)
@section('content')
    <section class="mb-4" wire:ignore.self style="height:650px;">
        <div class="card-header py-0">
            <nav class="navbar-expand-lg navbar-light bg-light mt-3"
                style="--mdb-navbar-box-shadow: 0 4px 12px 0 rgb(189, 189, 189),0 2px 4px rgba(0,0,0,0.05);">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"
                                    class="text-dark fw-bold fs-6">{{ __('Dashboard') }}</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="#"
                                    class="text-dark  fs-6">{{ $title }}</a></li>
                        </ol>
                    </nav>
                </div>
            </nav>
        </div>

        @livewire('table', ['service' => $service])
        @livewire('creator', ['service' => $service])
        @livewire('updater', ['service' => $service])

    </section>
@endsection
