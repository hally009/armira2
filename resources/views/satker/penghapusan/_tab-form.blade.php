<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
                <select class="form-select" id="select-document" aria-label="State">
                    <option value="-">--Pilih Jenis Dokumen--</option>
                    @foreach(kategori_penghapusan() as $index => $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="select-category" aria-label="State">
                    <option value="-">--Pilih Kategori--</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-outline-secondary text-sm" id="terapkan">
                    Terapkan
                </button>
            </div>
        </div>
    </div>
    <div class="card-body wizard-content" id="form-place"></div>
</div>

<div class="d-none" id="default-form">
    <div class="row" style="min-height:300px">
        <div class="col-md-12 text-center mt-5">
            <p>Silahkan Pilih Jenis Dokumen dan Kategori Penghapusan BMN</p>
        </div>
    </div>
</div>

@push('script')
<script src="{{ asset('js/jquery.steps.min.js') }}"></script>
<script>
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content")
    $("#form-place").html($('#default-form').html())
    $("#select-document").on('change', function() {
        if ($(this).val() == '-') {
            $("#select-category").html('<option value="-">--Pilih Kategori--</option>')
            return
        }
        $.ajax({
            url: "{{ route('Satker::penghapusan.index') }}/get-category/" + $(this).val()
            , success: function(data) {
                $("#select-category").html(data)
            }
        });
    })

    $("#terapkan").on('click', function() {
        if ($("#select-document").val() == '-' || $("#select-category").val() == '-') {
            $("#form-place").html($('#default-form').html())
            return
        }
        $.ajax({
            url: "{{ route('Satker::penghapusan.index') }}/get-form/" + $("#select-document").val() + "/" + $("#select-category").val()
            , success: function(data) {
                $("#form-place").html(data)
                steps()
            }
        });
    })



    let uploadFile = (formId) => {
        let form = $(formId)
        let dataForm = form.serialize()
        let formData = new FormData(form[0]);

        $.ajax({
            url: form.attr('action')
            , method: 'post'
            , data: formData
            , contentType: false
            , processData: false
            , success: function(data) {
                alert('Upload Success')
            }
        })
    }

    let storeFormData = () => {
        let form = $("#formData")
        let actionUrl = form.attr('action');
        let dataForm = form.serialize()

        $.ajax({
            type: "POST"
            , url: actionUrl
            , data: dataForm, // serializes the form's elements.
            success: function(data) {
                return true
            }
            , error: function(error) {
                window.location.replace('{{ route("login") }}')
                return false
            }
        })
    }

    let loadResult = () => {
        $.ajax({
            url: "{{ route('Satker::penghapusan.index') }}/result/" + $("#dokumen_id").val() + "/" + $("#kategori_id").val()
            , success: function(data) {
                $("#sec-result").html(data)
            }
        });
    }

    function steps() {
        $(".tab-wizard").steps({
            headerTag: "h6"
            , bodyTag: "section"
            , transitionEffect: "fade"
            , titleTemplate: '<span class="step">#index#</span> #title#'
            , labels: {
                finish: "Kirim"
                , next: "Lanjut"
                , previous: "Kembali"
            }
            , startIndex: 0 // set default step
            , onFinished: function(event, currentIndex) {
                $("#submit-form").submit()
            }
            , onStepChanging: function(event, currentIndex, priorIndex) {
                if (currentIndex < priorIndex) {
                    if (currentIndex == 0) {
                        //$("#formData").submit()
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
    }

</script>
@endpush
