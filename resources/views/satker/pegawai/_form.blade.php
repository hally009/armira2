<div class="col-md-6">
    <div class="form-floating">
        <select class="form-select" id="jabatan" aria-label="State" name="struktur_id">
            <option>Pilih Jabatan</option>
            @foreach($struktur as $value)
            <option value="{{ $value->id }}" 
            @if(old('struktur_id', (isset($item) && $item->struktur_id)?$item->struktur_id:'') == $value->id)
                selected
                @endif
                >{{ $value->nama }}</option>
            @endforeach
        </select>
        <label for="jabatan">State</label>
    </div>
</div>
<div class="col-md-6">
    <div class="form-floating">
        <input type="number" class="form-control" id="total_pegawai" name="total_pegawai" 
        value="{{ old('total_pegawai', (isset($item) && $item->total)?$item->total:'') }}">
        <label for="total_pegawai">Total Pegawai</label>
    </div>
</div>

<div class="text-left">
    <div class="row">
        <div class="col-md-6 align-self-center text-left">
            <a href="{{ route('Satker::pegawai.index') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
        <div class="col-md-6 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <button type="submit" class="btn btn-outline-success">SIMPAN</button>
            </div>
        </div>
    </div>
</div>
