<div class="row mt-3">
    <div class="col">
        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
            @foreach(tab_perencanaan() as $tab)
            <li class="nav-item">
                <button class="nav-link @if($loop->iteration == 1) active @endif" data-bs-toggle="tab" 
                data-bs-target="#{{ $tab['id'] }}" type="button" role="tab" @if($loop->iteration == 1) aria-selected="true" @else 
                aria-selected="false"  @endif >
                    {{ $tab['name'] }}
                </button>
            </li>
            @endforeach
            @if($item->file)
            <li class="nav-item">
                <button class="nav-link" id="sk-tab" data-bs-toggle="tab" data-bs-target="#tab-sk" type="button" role="tab" aria-selected="false">SK PSP</button>
            </li>
            @endif
        </ul>
        <div class="tab-content pt-2" id="borderedTabContent">
            @foreach(tab_perencanaan() as $tab)
            <div class="tab-pane fade @if($loop->iteration == 1) show active @endif" id="{{ $tab['id'] }}" role="tabpanel">
                @if(isset($files[$tab['name_file']]))
                @include('uapb.hibah._embed', ['file' => $files[$tab['name_file']]])
                @endif
            </div>
            @endforeach
            @if($item->file)
            <div class="tab-pane fade" id="tab-sk" role="tabpanel">
                @include('uapb.psp._embed', ['file' => $item->file])
            </div>
            @endif
        </div>
    </div>
</div>
