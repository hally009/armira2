<form action="{{ route('Uapb::sbsk.update-detail', $satkerId) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Jabatan Pegawai</th>
                        @foreach($items as $item)
                        @if(get_status('aktif') == $item->status)
                        <th width="15%">{{ $item->produk->nama }}</th>
                        @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody style="font-size:14px !important">
                    @foreach($strukturs as $struktur)
                    <tr>
                        @if($pegawai->where('struktur_id', $struktur->id)->count() > 0)
                        <td class="text-success">
                            {{ $struktur->nama }}<br>
                            <span class="fst-italic" style="font-size:12px !important">
                                total pegawai {{ $pegawai->where('struktur_id', $struktur->id)->pluck('total')[0] }}
                            </span>
                        </td>
                        @else
                        <td class="text-danger">
                            {{ $struktur->nama }}<br>
                            <span class="fst-italic" style="font-size:12px !important">
                                total pegawai 0
                            </span>
                        </td>
                        @endif


                        @foreach($items as $item)
                        @if(get_status('aktif') == $item->status)
                        @foreach($item->detail->where('struktur_id', $struktur->id) as $key => $value)
                        <td>
                            <input class="form-control input-sm" type="text" name="detail-{{ $value->id }}" value="{{ $value->total }}">
                        </td>
                        @endforeach
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
