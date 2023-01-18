@extends('index')

@section('contents')
    @if (session()->get('pegawai')->nama == 'direksi')
        <div class="row gy-2">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Poliklinik Kandungan</h5>
                        <div class="d-grid gap-2">
                            @foreach ($data as $d)
                                @if ($d->dokter->kd_sps == 'S0001' && $d->kd_poli != 'U0017')
                                    <a href="poliklinik/{{ $d->kd_poli }}?dokter={{ $d->dokter->kd_dokter }}"
                                        class="btn btn-primary">{{ $d->dokter->nm_dokter }} <br>
                                        {{ $d->nama }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Poliklinik Anak</h5>
                        <div class="d-grid gap-2">
                            @foreach ($data as $d)
                                @if ($d->dokter->kd_sps == 'S0003' && $d->kd_poli != 'U0017')
                                    <a href="poliklinik/{{ $d->kd_poli }}?dokter={{ $d->dokter->kd_dokter }}"
                                        class="btn btn-success">{{ $d->dokter->nm_dokter }} <br>
                                        {{ $d->nama }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row gy-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Poliklinik : {{ session()->get('pegawai')->nama }}</h5>
                        <div class="d-grid gap-2">
                            @foreach ($data as $d)
                                @if ($d->dokter->kd_dokter == session()->get('pegawai')->nik)
                                    <a href="poliklinik/{{ $d->kd_poli }}?dokter={{ $d->dokter->kd_dokter }}"
                                        class="btn btn-primary">
                                        {{ $d->nama }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('script')
@endpush
