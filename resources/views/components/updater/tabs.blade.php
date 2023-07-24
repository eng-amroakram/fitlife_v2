<ul class="nav md-tabs tabs-2 bg-color-green" role="tablist">
    @foreach ($tabs as $tab)
        <li class="nav-item">
            <a class="nav-link {{ $tab['status'] }}" data-toggle="tab" href="#{{ $tab['id'] }}" role="tab">
                <i class="{{ $tab['icon'] }} mr-1"></i>
                {{ $tab['title'] }}
            </a>
        </li>
    @endforeach
</ul>
