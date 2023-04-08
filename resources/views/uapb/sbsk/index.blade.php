@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-body">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-produk" type="button" role="tab" aria-controls="produk" aria-selected="true">Referensi Produk</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-sbsk" type="button" role="tab" aria-controls="sbsk" aria-selected="false">SBSK</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabContent">
                    <div class="tab-pane fade show active" id="tab-produk" role="tabpanel">
                        <div class="row mt-2 mb-3">
                            <div class="col-md-9 align-self-center"></div>
                            <div class="col-md-3 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal-add-product">Tambah Data</button>
                                </div>
                            </div>
                        </div>
                        <div id="table-product"></div>
                    </div>
                    <div class="tab-pane fade" id="tab-sbsk" role="tabpanel">
                        <div id="show-form"></div>
                    </div>
                </div>
                <!-- End Bordered Tabs -->
            </div>
        </div>
    </div>
</div>
@include('uapb.sbsk._modal-add')
@include('uapb.sbsk._modal-edit')

@endsection

@push('script')
<script>
    function getProduct() {
        let url = "{{ route('Uapb::produk.index') }}"
        $.get(url, function(data) {
            $("#table-product").html(data)

            $(".edit-produk").click(function(e) {
                e.preventDefault()
                let formInput = $(this).attr('data-form').split("|")
                $("#kode_barang").val(formInput[0])
                $("#nama").val(formInput[1])
                $("#status").val(formInput[2])
                $("#form-edit-product").attr('action', $(this).attr('data-action'))
                $("#modal-edit-product").modal('show')
            })
        })
    }

    function getForm() {
        let url = "{{ route('Uapb::sbsk.show-form') }}"
        $.get(url, function(data) {
            $("#show-form").html(data)
        })
    }

    getProduct()
    getForm()

    $("#store-product").click(function(e) {
        e.preventDefault();
        let form = $("#form-product")
        let actionUrl = form.attr('action');
        let dataForm = form.serialize()

        $.ajax({
            type: "POST"
            , url: actionUrl
            , data: dataForm, // serializes the form's elements.
            success: function(data) {
                getProduct()
                getForm()
                $("#modal-add-product").modal('hide')
            }
            , error: function(error) {
                window.location.replace('{{ route("login") }}')
            }
        })
    })

    $("#edit-product").click(function(e) {
        let form = $("#form-edit-product")
        let actionUrl = form.attr('action')
        let dataForm = form.serialize()

        $.ajax({
            type: "POST"
            , url: actionUrl
            , data: dataForm, // serializes the form's elements.
            success: function(data) {
                getProduct()
                getForm()
                $("#modal-edit-product").modal('hide')
            }
            , error: function(error) {
                window.location.replace('{{ route("login") }}')
            }
        })
    })

</script>
@endpush