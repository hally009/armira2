@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5 align-self-center">
                        <h5 class="card-title mb-0 py-0">DASHBOARD</h5>
                    </div>
                    {{-- <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <a type="button" href="{{ route('Satker::admin.create') }}" class="btn btn-outline-success">
                                <i class="fa fa-plus-circle"></i> Tambah Data
                            </a>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Jumlah Barang</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="chartAset"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('chartAset');
  
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: @json($chartData['label']),
        datasets: [{
          label: '# of Votes',
          data: @json($chartData['data']),
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
</script>

@endpush