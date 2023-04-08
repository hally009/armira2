<div class="col-md-6">
    <div class="form-floating">
        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', (isset($item) && $item->nama)?$item->nama:'') }}">
        <label for="nama">Nama Periode</label>
    </div>
</div>
<div class="col-md-6">
    <div class="form-floating">
        <input type="number" class="form-control" id="tahun" name="tahun" value="{{ old('tahun', (isset($item) && $item->tahun)?$item->tahun:'') }}">
        <label for="tahun">Tahun</label>
    </div>
</div>
{{-- <div class="col-md-4">
    <div class="form-floating">
        <select class="form-select" id="status" aria-label="State" name="status">
            <option>Pilih Status</option>
            <option value="1" @if(old('status', (isset($item) && $item->status)?$item->status:'') == '1') selected
                @endif>Aktif</option>
            <option value="0" @if(old('status', (isset($item) && $item->status)?$item->status:'') == '0') selected
                @endif>Non Aktif</option>
        </select>
        <label for="status">Pengadaan BMN</label>
    </div>
</div> --}}

<div class="text-left">
    <div class="row">
        <div class="col-md-6 align-self-center text-left">
            <a href="{{ route('Uapb::periode.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="col-md-6 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <button type="submit" class="btn btn-success text-white">SIMPAN</button>
            </div>
        </div>
    </div>
</div>
