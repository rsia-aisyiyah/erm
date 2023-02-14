<div class="modal fade" id="modalSoapRanap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN S.O.A.P</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <div class="modal-body">
                @include('content.ranap.modal._form_soap')
                {{-- <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFormSooap">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#formSoapRanap" aria-expanded="false" aria-controls="formSoapRanap"
                                style="padding:8px">
                                FORM PEMERIKSAAN SOAP
                            </button>
                        </h2>
                        <div id="formSoapRanap" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body">
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#tbSoapRanap" aria-expanded="true" aria-controls="tbSoapRanap"
                                style="padding:8px">
                                LIST DATA PEMERIKSAAN SOAP
                            </button>
                        </h2>
                        <div id="tbSoapRanap" class="accordion-collapse collapse show" aria-labelledby="tbSoapRanap">
                            <div class="accordion-body">
                                @include('content.ranap.modal._table_soap')
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanSoap()"><i class="bi bi-save"></i>
                    Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script></script>
@endpush
