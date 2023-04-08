@php
$form = json_decode($item->pengelolaanForm->form, true);
@endphp
<div class="row mt-3">
    <div class="col">
        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-detail" type="button" role="tab" aria-selected="true">
                    Detail Permohonan
                </button>
            </li>
            @foreach($formPenghapusan['tabs'] as $tab)
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#{{ $tab['id'] }}" type="button" role="tab" aria-selected="false">
                    {{ $tab['name'] }}
                </button>
            </li>
            @endforeach
            @if($item->file)
            <li class="nav-item">
                <button class="nav-link" id="sk-tab" data-bs-toggle="tab" data-bs-target="#tab-sk" type="button" role="tab" aria-selected="false">
                    SK Penghapusan
                </button>
            </li>
            @endif
        </ul>
        <div class="tab-content pt-2" id="borderedTabContent">
            <div class="tab-pane fade show active" id="tab-detail" role="tabpanel">
                <table class="table table-bordered table-striped">
                    <tbody>
                        @foreach($formPenghapusan['form'] as $key => $value)
                        <tr>
                            <td>{{ $value['name'] }}</td>
                            <td>
                                @if($value['property'] == 'number')
                                    {{ number_format($form[$value['id']]) }}
                                @elseif($value['property'] == 'date')
                                    {{ human_date($form[$value['id']]) }}
                                @else
                                    {{ $form[$value['id']] }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @foreach($formPenghapusan['tabs'] as $tab)
            <div class="tab-pane fade" id="{{ $tab['id'] }}" role="tabpanel">
                @if(isset($files[$tab['name_file']]))
                @include('component.embed', ['file' => $files[$tab['name_file']]])
                @endif
            </div>
            @endforeach
            @if($item->file)
            <div class="tab-pane fade" id="tab-sk" role="tabpanel">
                @include('component.embed', ['file' => $item->file])
            </div>
            @endif
        </div>
    </div>
</div>
