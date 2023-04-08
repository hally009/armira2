<div class="row">
    <div class="col-lg-12">
        @include('component.js-alert')
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form id="form-user" action="{{ route('user.update', $user) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <h5 class="card-title">Email</h5>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                        <label>Email</label>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="text-left">
                    <div class="row">
                        <div class="col-md-6 align-self-center text-left"></div>
                        <div class="col-md-6 align-self-center text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" id="simpan-user" class="btn btn-outline-success">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form id="form-password" action="{{ route('user.password', $user) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <h5 class="card-title">Ubah Password</h5>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="old_password">
                        <label>Password Lama</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="new_password">
                        <label>Password Baru</label>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="text-left">
                    <div class="row">
                        <div class="col-md-6 align-self-center text-left"></div>
                        <div class="col-md-6 align-self-center text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" id="simpan-password" class="btn btn-outline-success">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#simpan-user").click(function() {
        let form = $("#form-user")
        let actionUrl = form.attr('action')
        let dataForm = form.serialize()
        
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: dataForm,
            success: function(data) {
                $("#text-success").text(data.message)
                alertSuccess.style.display = 'block'
                setTimeout(() => alertSuccess.style.display = 'none', 1500)
            },
            error: function(error) {
                $("#text-error").text(error.responseJSON.message)
                alertError.style.display = 'block'
                setTimeout(() => alertError.style.display = 'none', 1500)
            }
        })
    })

    $("#simpan-password").click(function() {
        let form = $("#form-password")
        let actionUrl = form.attr('action')
        let dataForm = form.serialize()
        
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: dataForm,
            success: function(data) {
                $("#text-success").text(data.message)
                alertSuccess.style.display = 'block'
                setTimeout(() => alertSuccess.style.display = 'none', 1500)
            },
            error: function(error) {
                $("#text-error").text(error.responseJSON.message)
                alertError.style.display = 'block'
                setTimeout(() => alertError.style.display = 'none', 1500)
            }
        })
    })



    
</script>