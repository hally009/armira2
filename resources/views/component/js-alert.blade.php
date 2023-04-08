<div class="position-relative">
    <div class="position-absolute top-0 start-50 translate-middle-x" style="z-index: 1; width:200px">
        <div class="alert alert-success alert-dismissible" role="alert" id="alert-success">
            <p id="text-success"></p>
            <button type="button" class="btn-close" id="close-alert" aria-label="Close"></button>
        </div>

        <div class="alert alert-danger alert-dismissible" role="alert" id="alert-error">
            <p id="text-error"></p>
            <button type="button" class="btn-close" id="close-alert" aria-label="Close"></button>
        </div>
    </div>
</div>

<script>
    var alertSuccess = document.getElementById('alert-success')
    alertSuccess.style.display = 'none'

    var alertError = document.getElementById('alert-error')
    alertError.style.display = 'none'
</script>