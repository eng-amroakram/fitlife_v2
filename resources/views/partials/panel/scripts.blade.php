<script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


{{-- <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>


<x-livewire-alert::scripts />

@livewireScripts()

<script>
    $(document).ready(function() {
        var myDiv = document.getElementById('customremoveinputgroup');
        var containerDiv = document.getElementById('removecontainerpadding');
        if (window.innerWidth <= 767) {
            myDiv.classList.remove('input-group');
        } else {
            myDiv.classList.add('input-group');
        }

        window.addEventListener('resize', function() {
            var myDiv = document.getElementById('customremoveinputgroup');
            var containerDiv = document.getElementById('removecontainerpadding');
            if (window.innerWidth <= 767) {
                myDiv.classList.remove('input-group');
            } else {
                myDiv.classList.add('input-group');
            }
        });

    });
</script>


{{-- Alpine JS --}}
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

@livewire('auth')
@stack('login')

@stack('creator')
@stack('updater')
