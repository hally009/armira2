<div class="form tab-wizard wizard-circle">
    <!-- Step 1 -->
    <h6>Isi Data</h6>
    <section>
        <form id="formData" action="{{ route('Satker::pengelolaan-temp.store', 'penghapusan') }}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <input type="hidden" name="dokumen_id" id="dokumen_id" value="{{ $documentId }}">
            <input type="hidden" name="kategori_id" id="kategori_id" value="{{ $categoryId }}">
            <div class="row mb-3 mt-3">
                @foreach($formPenghapusan['form'] as $key => $value)
                <div class="col-md-6 mb-3">
                    <div class="form-floating">
                        <input type="{{ $value['property'] }}" class="form-control" id="{{ $value['id'] }}" name="{{ $value['id'] }}" 
                        value="{{ ($temp)?$temp->form_view[$value['id']]:'' }}">
                        <label for="{{ $value['id'] }}">{{ $value['name'] }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </form>
    </section>
    <!-- Step 2 -->
    <h6>Unggah Dokumen</h6>
    <section>
        <div class="row mb-5">
            <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                @foreach($formPenghapusan['tabs'] as $tab)
                <li class="nav-item">
                    <button class="nav-link @if($loop->iteration == 1) active @endif" data-bs-toggle="tab" data-bs-target="#{{ $tab['id'] }}" type="button" role="tab" @if($loop->iteration == 1) aria-selected="true" @else
                        aria-selected="false" @endif >
                        {{ $tab['name'] }}
                    </button>
                </li>
                @endforeach
            </ul>
            <div class="tab-content pt-2" id="borderedTabContent">
                @foreach($formPenghapusan['tabs'] as $tab)
                <div class="tab-pane fade @if($loop->iteration == 1)  show active @endif" id="{{ $tab['id'] }}" role="tabpanel">
                    <form id="{{ $tab['id_upload'] }}" action="{{ route('Satker::pengelolaan-temp.upload-file', ['penghapusan', $tab['name_file']]) }}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="dokumen_id" value="{{ $documentId }}">
                        <input type="hidden" name="kategori_id" value="{{ $categoryId }}">
                        <div class="row mb-3 mt-3">
                            <div class="col-sm-6">
                                <input type="file" class="form-control" id="file_penghapusan" name="file_penghapusan">
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-outline-secondary" onclick="uploadFile('#{{ $tab['id_upload'] }}')">
                                    Unggah
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Step 3 -->
    <h6>Kirim Permohonan</h6>
    <section>
        <form id="submit-form" action="{{ route('Satker::penghapusan.store') }}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <input type="hidden" name="dokumen_id" value="{{ $documentId }}">
            <input type="hidden" name="kategori_id" value="{{ $categoryId }}">
        </form>
        <div id="sec-result">
            @include('satker.penghapusan.result')
        </div>
    </section>
</div>
