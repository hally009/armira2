<div class="row mt-3 mb-3">
    <div class="col-md-5 align-self-center"></div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <a type="button" href="{{ asset($file) }}" target="blank" class="btn btn-outline-success me-1">
                download
            </a>
        </div>
    </div>
</div>
@if(get_mime($file) == 'pdf')
    <object data="{{ asset($file) }}" width="1024" height="800"></object>
@elseif(get_mime($file) == 'image')
    <img src="{{ asset($file) }}" width="150" />
@elseif(get_mime($file) == 'excel')
    <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{ asset($file) }}' width='100%' height='565px'
        frameborder='0'> </iframe>
@endif