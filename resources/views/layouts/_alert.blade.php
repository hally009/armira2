<?php $flash = [
    'error'   => ['class' => 'alert-danger', 'icon' => 'fa fa fa-ban'],
    'danger'  => ['class' => 'alert-danger', 'icon' => 'fa fa fa-ban'],
    'warning' => ['class' => 'alert-warning', 'icon' => 'fa fa-info'],
    'info'    => ['class' => 'alert-info', 'icon' => 'fa fa-info'],
    'message' => ['class' => 'alert-info', 'icon' => 'fa fa-info'],
    'success' => ['class' => 'alert-success', 'icon' => 'fa fa-check'],
]; ?>

@foreach($flash as $type => $context)
@if(session()->has($type))
<div class="alert {{ $context['class'] }} alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <h4><i class="icon {{ $context['icon'] }}"></i> Notif</h4>
    {{ session($type) }}
</div>
@endif
@endforeach

@if(!$errors->isEmpty())
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <h4><i class="icon fa fa fa-ban"></i> Notif</h4>
    @foreach($errors->all() as $error)
    {{ $error }}<br>
    @endforeach
</div>
@endif
