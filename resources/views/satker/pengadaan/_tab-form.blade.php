<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body wizard-content">
        <div class="form tab-wizard wizard-circle">
            <!-- Step 1 -->
            <h6>Isi Data SBSK</h6>
            <section>
                <form id="formData" action="{{ route('Satker::pengadaan-temp.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    @include('satker.pengadaan._form-sbsk')
                </form>
            </section>
            <!-- Step 2 -->
            <h6>Unggah Dokumen</h6>
            <section>
                <div class="row mb-5">
                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                        @foreach(tab_perencanaan() as $tab)
                        <li class="nav-item">
                            <button class="nav-link @if($loop->iteration == 1) active @endif" data-bs-toggle="tab" 
                            data-bs-target="#{{ $tab['id'] }}" type="button" role="tab" @if($loop->iteration == 1) aria-selected="true" @else 
                            aria-selected="false"  @endif >
                                {{ $tab['name'] }}
                            </button>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content pt-2" id="borderedTabContent">
                        @foreach(tab_perencanaan() as $tab)
                        <div class="tab-pane fade @if($loop->iteration == 1)  show active @endif" id="{{ $tab['id'] }}" role="tabpanel">
                            <form id="{{ $tab['id_upload'] }}" action="{{ route('Satker::pengadaan-temp.upload-file', [$tab['name_file']]) }}" method="POST" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="row mb-3 mt-3">
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control" id="file_pengadaan" name="file_pengadaan">
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
                <form id="submit-form" action="{{ route('Satker::pengadaan.store') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                </form>
                <div id="sec-result">
                    @if($temp)
                    @include('satker.pengadaan.result')
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>

@push('script')
<script src="{{ asset('js/jquery.steps.min.js') }}"></script>
<script type="text/javascript">
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content")

    let uploadFile = (formId) => {
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
                alert('Upload Success')
            }
        });

    }

    let storeFormData = () => {
        let form = $("#formData")
        let actionUrl = form.attr('action')
        let dataForm = form.serialize()

        $.ajax({
            type: "POST",
            url: actionUrl,
            data: dataForm, // serializes the form's elements.
            success: function(data) {
                return true
            },
            error: function(error) {
                window.location.replace('{{ route("login") }}')
                return false
            }
        })
    }

    let loadResult = () => {
        $.ajax({
            url: "{{ route('Satker::pengadaan.result') }}",
            success: function(data) {
                $("#sec-result").html(data)
            }
        });
    }
    
    $(".tab-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Kirim",
            next: "Lanjut",
            previous: "Kembali"
        },
        startIndex: {{($temp) ? $temp->step: 0}},
        onFinished: function(event, currentIndex) {
            $("#submit-form").submit()
        },
        onStepChanging: function(event, currentIndex, priorIndex) {
            if (currentIndex < priorIndex) {
                if (currentIndex == 0) {
                    storeFormData()
                    return true
                }
                if (currentIndex == 1) {
                    loadResult()
                    return true
                }
            }
            return true
        }
    })
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

    $("#nama_usulan").keyup(function() {
        if($(this).val() != '') {
            $(".usulan").removeAttr("disabled")
            return
        }
        $(".usulan").attr("disabled", true)
    })
</script>
@endpush