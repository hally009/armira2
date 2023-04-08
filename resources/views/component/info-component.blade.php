<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0 py-0">INFO</h5>
        <p class="mb-0">Informasi Aktifitas</p>
    </div>
    <div class="card-body">
        <div class="overflow-scroll" style="max-height: 550px;">
            @if(isset($notifs) && $notifs->count() > 0)
            @foreach($notifs as $notif)
            <div class="row my-2 px-3">
                <div class="col-md-4 col-sm-12 text-center">
                    <a href="{{ route('notif-redirect', $notif->url_id) }}">
                        <img src="{{ asset('images/profile-img.jpg') }}" alt="user" class="rounded-circle"
                            style="max-width: 75px;">
                    </a>
                </div>
                <div class="col-md-8">
                    <h5 class="card-title mb-0 py-0">{{ $notif->dari_name }}</h5>
                    <p style="font-size:14px; text-align: justify; text-justify: inter-word;">
                        {{ $notif->content }}
                        <br>
                        <span style="font-size:0.9em">
                            <i><b>{{ human_date($notif->created_at) }} {{ get_time($notif->created_at) }}</b></i>
                        </span>
                    </p>
                </div>
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('notif-redirect', $notif->url_id) }}">
                    Detail
                    <i class="bi bi-arrow-right"></i>
                </a>
                <hr class="mt-3">
            </div>

            @endforeach
            @else
            <div class="row my-2">
                <div class="col-12">
                    <p>Tidak ada informasi dan aktifitas</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>