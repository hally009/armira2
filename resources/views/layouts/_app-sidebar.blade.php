<aside id="sidebar" class="sidebar">
    <a href="{{ route('home') }}">
        <div class="row nv pt-3 pb-1">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <h1><i class="ri-dashboard-line"></i></h1>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-center">MENU UTAMA</div>
            </div>
        </div>
    </a>
    @foreach($menu as $item)
    <a href="{{ $item['route'] }}">
        <div class="row nv pt-3 pb-1">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <h1><i class="{{ $item['icon'] }}"></i></h1>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-center">{{ $item['name'] }}</div>
            </div>
        </div>
    </a>
    @endforeach
</aside>
