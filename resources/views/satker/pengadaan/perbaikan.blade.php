<form action="{{ route('Satker::pengadaan.perbaikan.update', $pengadaan->id) }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row mb-3 mt-3">
        <div class="col-lg-3">
            <div class="form-floating">
                <input type="text" class="form-control" id="nama_usulan"
                    value="{{ ($pengadaan)?$pengadaan->nama:'' }}" name="nama_usulan">
                <label for="nama_usulan">Nama Usulan</label>
            </div>
        </div>
        <div class="col-md-9 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
                    &nbsp;
                <button type="submit" class="btn btn-outline-success">
                    Kirim
                </button>
            </div>
        </div>
    </div>
    <div class="row mb-3 mt-3">
        <div class="col-lg-12">
            <table class="table  table-bordered">
                <thead>
                    <tr>
                        <th>NAMA BARANG</th>
                        <th>SBSK BMN</th>
                        <th>BMN EKSISTING</th>
                        <th>KEBUTUHAN RIIL</th>
                        <th>JUMLAH USULAN</th>
                        <th>PELUANG USULAN DISETUJUI </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengadaan->pengadaanRakbm as $item)
                    <tr>
                        <td>{{ $item->produk->nama }}</td>
                        <td id="sbsk_{{ $item->id }}">{{ $item->sbsk_bmn }}</td>
                        <td id="existing_{{ $item->id }}">{{ $item->existing_bmn }}</td>
                        <td id="riil_{{ $item->id }}">{{ $item->kebutuhan }}</td>
                        <td>
                            <input class="form-control usulan" type="number" id="usulan_{{ $item->id }}"
                                name="usulan_{{ $item->id }}" value="{{ $item->total }}">
                        </td>
                        <td id="peluang_{{ $item->id }}">{{ $item->peluang_setuju }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>
<div class="row mb-5">
    <div class="col-lg-12">
        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
            @foreach(tab_perencanaan() as $tab)
            <li class="nav-item">
                <button class="nav-link @if($loop->iteration == 1) active @endif" data-bs-toggle="tab"
                    data-bs-target="#{{ $tab['id'] }}" type="button" role="tab" @if($loop->iteration == 1)
                    aria-selected="true" @else
                    aria-selected="false" @endif >
                    {{ $tab['name'] }}
                </button>
            </li>
            @endforeach
        </ul>
        <div class="tab-content pt-2" id="borderedTabContent">
            @foreach(tab_perencanaan() as $tab)
            <div class="tab-pane fade @if($loop->iteration == 1)  show active @endif" id="{{ $tab['id'] }}"
                role="tabpanel">
                <form id="{{ $tab['id_upload'] }}"
                    action="{{ route('Satker::pengadaan-perbaikan.upload-file', [$pengadaan->id, $tab['name_file']]) }}"
                    method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    @if($files = $pengadaan->pengadaanFile->where('name', $tab['name_file'])->first())
                    <input type="hidden" class="form-control" name="id_file" value="{{ $files->id }}">
                    @endif
                    <div class="row mb-3 mt-3">
                        <div class="col-sm-6">
                            <input type="file" class="form-control" id="file_pengadaan" name="file_pengadaan">
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="uploadFilePerbaikan('#{{ $tab['id_upload'] }}')">
                                Unggah
                            </button>
                        </div>
                    </div>
                    <div id="file-place-{{ $tab['id_upload'] }}">
                        @if($files)
                        @include('component.embed', ['file' => $files->file])
                        @endif
                    </div>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    $(".usulan").keyup(function() {
        let id = this.id.split("_")
        let value = $(this).val()
        if(!value) {
            $("#peluang_"+id[1]).text("0")
            return
        }

        let riil = parseInt($("#riil_"+id[1]).text())
        if(value <= riil) {
            $("#peluang_"+id[1]).text(value)
            return 
        }

        let peluang = riil - value
        if(peluang > 0) {
            $("#peluang_"+id[1]).text(peluang)
            return
        }
        $("#peluang_"+id[1]).text(riil)
    })

    let uploadFilePerbaikan = (formId) => {
        let form = $(formId)
        let dataForm = form.serialize()
        let formData = new FormData(form[0])
        
        $.ajax({
            url: form.attr('action'),
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                let filePlace = `#file-place-${formId.substring(1)}`
                $(filePlace).html(data)
                alert('Upload file success')
            }
        });
    }

</script>