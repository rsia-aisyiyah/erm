@extends('index')

@section('contents')
    @if (session()->get('pegawai')->nama == 'direksi' || session()->get('pegawai')->departemen == 'DPM2' || session()->get('pegawai')->departemen == 'DIR' || session()->get('pegawai')->departemen == 'CSM' || session()->get('pegawai')->bidang == 'Kebidanan' || session()->get('pegawai')->bidang == 'Keperawatan' || session()->get('pegawai')->jbtn == 'Asisten Apoteker' || session()->get('pegawai')->jbtn == 'Apoteker' || session()->get('pegawai')->jbtn == 'TTK' || session()->get('pegawai')->jbtn == '-')
        <div class="row gy-2">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Poliklinik Kandungan</h5>
                        <div class="d-grid gap-2">
                            @foreach ($data as $d)
                                @if ($d->dokter->kd_sps == 'S0001' && $d->kd_poli != 'U0017')
                                    <a style="font-size:12px" href="poliklinik/{{ $d->kd_poli }}?dokter={{ $d->dokter->kd_dokter }}"
                                        class="btn btn-primary">{{ $d->dokter->nm_dokter }} <br>
                                        {{ $d->nama }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Poliklinik Anak</h5>
                        <div class="d-grid gap-2">
                            @foreach ($data as $d)
                                @if ($d->dokter->kd_sps == 'S0003' && $d->kd_poli != 'U0017')
                                    <a style="font-size:12px" href="poliklinik/{{ $d->kd_poli }}?dokter={{ $d->dokter->kd_dokter }}"
                                        class="btn btn-success">{{ $d->dokter->nm_dokter }} <br>
                                        {{ $d->nama }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Poliklinik Penyakit Dalam</h5>
                        <div class="d-grid gap-2">
                            @foreach ($data as $d)
                                {{-- {{ $d }} --}}
                                @if ($d->dokter->kd_sps == 'S0005')
                                    <a href="poliklinik/{{ $d->kd_poli }}?dokter={{ $d->dokter->kd_dokter }}"
                                        class="btn text-light"
                                        style="font-size:14px;background-color: #6f42c1">{{ $d->dokter->nm_dokter }} <br>
                                        {{ $d->nama }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-1 col-lg-3 col-md-12 col-sm-12">
                <div class="row gy-2">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Lainnya</h5>
                                <div class="d-grid gap-2 mb-2">
                                    <a href="poliklinik/P006" class="btn text-light"
                                        style="background-color: #dc3700;height:55px; padding-top:10px;font-size:20px">Poliklinik Umum<br>
                                    </a>
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="poliklinik/PKIA" class="btn text-light"
                                        style="background-color:#d63384;height:55px; padding-top:10px;font-size:20px">Poliklinik KIA<br>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Poliklinik Umum</h5>
                            </div>
                        </div>
                    </div> --}}
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
                            @if (session()->get('pegawai')->bidang == 'Dokter Umum' || session()->get('pegawai')->jbtn == 'Dokter Umum')
                                <a href="poliklinik/P006?dokter={{ session()->get('pegawai')->nik }}"
                                    class="btn btn-primary">
                                    POLIKLINIK UMUM
                                </a>
                            @else
                                @foreach ($data as $d)
                                    @if ($d->dokter->kd_dokter == session()->get('pegawai')->nik)
                                        <a href="poliklinik/{{ $d->kd_poli }}?dokter={{ $d->dokter->kd_dokter }}"
                                            class="btn btn-primary">
                                            {{ $d->nama }}
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('script')
@endpush
