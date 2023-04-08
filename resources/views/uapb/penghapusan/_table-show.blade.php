@php
$form = json_decode($item->pengelolaanForm->form);
@endphp
<table class="table table-info mb-0">
    <tbody>
        <tr>
            <td width="50%">{{ $item->satker->name }}</td>
            <td>{{ human_date($item->created_at) }}</td>
        </tr>
        <tr>
            <td>{{ $item->satker->djkn }}</td>
            <td>{{ $form->nomor_surat }}</td>
        </tr>
        <tr>
            <td>{{ $item->satker->kpknl }}</td>
            <td>{{ $form->perihal_surat }}</td>
        </tr>
    </tbody>
</table>
