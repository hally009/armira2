<div class="card border-primary">
    <div class="card-header">
        <div class="row">
            <div class="col-md-5 align-self-center">
                @if($item && $item->file)
                <a type="button" href="{{ asset($item->file) }}" class="btn btn-outline-secondary">
                    <i class="ri-file-excel-2-line"></i> Unduh Excel
                </a>
                @endif
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center"></div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($item && $item->file)
        <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{ asset($item->file) }}' width='100%' height='565px' frameborder='0'> </iframe>
        @endif
    </div>
</div>
