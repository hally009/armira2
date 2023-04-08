<div class="card border-primary">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <form action="{{ route('Satker::master.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="row">

                        <div class="col-sm-6">
                            <input class="form-control" type="file" name="file_excel">
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-outline-secondary text-sm">
                                <i class="ri-file-excel-2-line"></i> Upload Excel
                            </button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-md-6 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    @if($item && $item->file_temp)
                    <a class="btn btn-outline-success" href="#" onclick="event.preventDefault(); document.getElementById('syncronize-form').submit();">
                        <i class="bi bi-arrow-repeat"></i>
                        <span>Sinkron</span>
                    </a>
                    <form id="syncronize-form" action="{{ route('Satker::master.syncronize') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($item && $item->file_temp)
        <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{ asset($item->file_temp) }}' width='100%' height='565px' frameborder='0'> </iframe>
        @endif
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-5 align-self-center"></div>

        </div>
    </div>
</div>
