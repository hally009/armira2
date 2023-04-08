<form action="{{ route('Uapb::sbsk.update-sbsk') }}" method="POST">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
                    <thead style="font-size:14px !important" class="text-center">
                        <tr>
                            <th width="20%">Jabatan Pegawai</th>
                            @foreach($items as $item)
                            <th>{{ $item->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody style="font-size:14px !important">
                        @foreach($strukturs as $struktur)
                        <tr>
                            <td>
                                {{ $struktur->nama }}<br>
                            </td>
                            @foreach($items as $item)
                            <td>
                                <input class="form-control form-control-sm" type="number" name="sbsk-{{ $item->sbsk->where('struktur_id', $struktur->id)->pluck('id')[0] }}" value="{{ $item->sbsk->where('struktur_id', $struktur->id)->pluck('total')[0] }}">
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 align-self-center"></div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <button type="submit" class="btn btn-outline-success">
                    <i class="fa fa-plus-circle"></i> SIMPAN
                </button>
            </div>
        </div>
    </div>
</form>
