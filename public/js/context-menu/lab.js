$.contextMenu({
    selector: '.row-permintaan-lab',
    events: {
        hide: (element, event) => {
            $(element.selector).removeClass('table-secondary')
        }
    },
    build: (element, event) => {
        const no_rawat = element.data('id');
        const no_rkm_medis = element.data('no_rkm_medis');
        const tgl_hasil = element.data('tgl');
        const jam_hasil = element.data('jam');
        const noorder = element.data('noorder');
        element.addClass('table-secondary')
        return {
            items: {
                "pemeriksaanLab": {
                    name: "Pemeriksaan Lab",
                    icon: 'fa-regular fa-stethoscope',
                    callback: function (item, option, e, x, y) {
                        showHasilPemeriksaanLab(no_rawat, noorder);
                    }

                },
                "hasilKritis": {
                    name: "Hasil Kritis",
                    icon: 'fa-regular fa-flask',
                    callback: function (item, option, e, x, y) {
                        hasilKritis(`${no_rawat}`)
                    }
                },
                "riwayatPasien": {
                    name: "Riwayat Pasien",
                    icon: 'fa-regular fa-search',
                    callback: function (item, option, e, x, y) {
                        listRiwayatPasien(`${no_rkm_medis}`);
                    }
                },
                "soapRanap": {
                    name: "CPPT / SOAP",
                    icon: 'fa-regular fa-pencil',
                    callback: function (item, option, e, x, y) {
                        showModalSoapRanap(no_rawat);
                    }
                }
            }
        }
    }
});
