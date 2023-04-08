@php
$form = json_decode($item->pengelolaanForm->form);
@endphp
<form action="{{ route('Satker::psp.perbaikan.update', $item) }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row mb-3 mt-3">
        <div class="col-lg-3"></div>
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
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="nomor_surat" value="{{ $form->nomor_surat }}" name="nomor_surat">
                <label for="nomor_surat">Nomor Surat</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="date" class="form-control" id="tanggal_surat" value="{{ $form->tanggal_surat }}" name="tanggal_surat">
                <label for="tanggal_surat">Tanggal Surat</label>
            </div>
        </div>
    </div>
    <div class="row mb-3 mt-3">
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="perihal_surat" value="{{ $form->perihal_surat }}" name="perihal_surat">
                <label for="perihal_surat">Perihal Surat</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="number" class="form-control" id="nilai_psp" value="{{ $form->nilai_psp }}" name="nilai_psp">
                <label for="nilai_psp">Total Nilai Objek PSP</label>
            </div>
        </div>
    </div>
</form>
<div class="row mb-5">
    <div class="col-lg-12">
        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
            @foreach(tab_psp() as $tab)
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
            @foreach(tab_psp() as $tab)
            <div class="tab-pane fade @if($loop->iteration == 1)  show active @endif" id="{{ $tab['id'] }}"
                role="tabpanel">
                <form id="{{ $tab['id_upload'] }}"
                    action="{{ route('Satker::psp-perbaikan.upload-file', [$item->id, $tab['name_file']]) }}"
                    method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    @if($files = $item->pengelolaanFile->where('name', $tab['name_file'])->first())
                    <input type="hidden" class="form-control" name="id_file" value="{{ $files->id }}">
                    @endif
                    <div class="row mb-3 mt-3">
                        <div class="col-sm-6">
                            <input type="file" class="form-control" id="file_pengelolaan" name="file_pengelolaan">
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
        })
    }

</script>