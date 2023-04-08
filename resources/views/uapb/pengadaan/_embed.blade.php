@if(get_mime($file) == 'pdf')
<object data="{{ asset($file) }}" width="1024" height="800"></object>
@elseif(get_mime($file) == 'image')
<img src="{{ asset($file) }}" width="150" />
@elseif(get_mime($file) == 'excel')
<iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{ asset($file) }}' width='100%' height='565px'
    frameborder='0'> </iframe>
@endif