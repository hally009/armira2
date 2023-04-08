<div class="modal fade" id="modal-edit-product" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Referensi Prooduk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="form-edit-product" action="#" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="col-md-4">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control" name="kode_barang" id="kode_barang" value="">

                    </div>
                    <div class="col-md-4">
                        <label>Nama barang</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="">
                    </div>
                    <div class="col-md-4">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            @foreach(get_status() as $key => $value)
                            <option value="{{ $value }}">{{ $key }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mt-3 mb-3 ps-2 pe-0">
                        <div class="col-md-9 align-self-center">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="tutup">TUTUP</button>
                        </div>
                        <div class="col-md-3 align-self-center text-right pe-0">
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-outline-primary" id="edit-product">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
