@include('partials.web.head')

<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="{{ asset('assets/images/header_1.jpg') }}" class="img-fluid" alt="Sample image">
            </div>
            @livewire('creator')
        </div>
    </div>

</section>


@include('partials.web.footer')
