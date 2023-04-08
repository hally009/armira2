<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="2" class="text-center bg-primary text-white">DRAFT PERMOHONAN PSP</td>
                </tr>
                <tr>
                    <td>Nomor Surat</td>
                    <td>{{ ($temp)?$temp->form_view['nomor_surat']:'' }}</td>
                </tr>
                <tr>
                    <td>Tanggal Surat</td>
                    <td>{{ ($temp)?human_date($temp->form_view['tanggal_surat']):'' }}</td>
                </tr>
                <tr>
                    <td>Perihal Surat</td>
                    <td>{{ ($temp)?$temp->form_view['perihal_surat']:'' }}</td>
                </tr>
                <tr>
                    <td>Total Nilai Objek</td>
                    <td>{{ ($temp)?number_format($temp->form_view['nilai_psp']):'' }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        @if($temp && $temp->file)
                        <div class="row">
                            @foreach(json_decode($temp->file, true) as $key => $value)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h1><i class="bi bi-file-earmark-text"></i></h1>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{ str_replace("_", " ", $key) }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
