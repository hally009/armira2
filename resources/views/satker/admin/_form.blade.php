<div class="{{ isset($pass) ? 'col-md-4': 'col-md-6'}}">
    <div class="form-floating">
        <input type="text" class="form-control" name="name" value="{{ old('name', (isset($item) && $item->name)?$item->name:'') }}">
        <label>Nama</label>
    </div>
</div>
<div class="{{ isset($pass) ? 'col-md-4': 'col-md-6'}}">
    <div class="form-floating">
        <input type="text" class="form-control" name="email" value="{{ old('email', (isset($item) && $item->email)?$item->email:'') }}">
        <label>Email</label>
    </div>
</div>
@if(isset($pass))
    <div class="col-md-4">
        <div class="form-floating">
            <input type="password" class="form-control" name="password">
            <label>Password</label>
        </div>
    </div>
@endif

<div class="text-left">
    <div class="row">
        <div class="col-md-6 align-self-center text-left">
            <a href="{{ route('Satker::admin.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="col-md-6 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <button type="submit" class="btn btn-success text-white">SIMPAN</button>
            </div>
        </div>
    </div>
</div>
