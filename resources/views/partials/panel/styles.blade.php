<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />

<!-- MDB RTL LIB -->
<link rel="stylesheet"
    href="{{ app()->getLocale() == 'ar' ? asset('assets/css/mdb.rtl.min.css') : asset('mdb/css/mdb.min.css') }}">

<!-- Sidebar Styling -->
<link rel="stylesheet"
    href="{{ app()->getLocale() == 'ar' ? asset('assets/css/sidebar.css') : asset('assets/css/sidebar-en.css') }}">

<!-- My Custom Styling -->
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

<!-- Switch -->
<link rel="stylesheet" href="{{ asset('assets/css/switch.css') }}">

<!-- Select -->
<link rel="stylesheet" href="{{ app()->getLocale() == 'ar' ? asset('assets/css/select.css') : '' }}" />

<!-- Modals -->
<link rel="stylesheet" href="{{ asset('assets/css/modals.css') }}">

<!-- Timeline -->
<link rel="stylesheet" href="{{ asset('assets/css/timeline.css') }}" />

<!-- Datepicker -->
<link rel="stylesheet" href="{{ asset('mdb/css/datepicker.css') }}" />

<!-- Scroll -->
<link rel="stylesheet" href="{{ asset('assets/css/scroll.css') }}" />
<link rel="stylesheet" href="{{ asset('mdb/css/custom.css') }}" />


@livewireStyles
