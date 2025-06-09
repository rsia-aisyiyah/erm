$.contextMenu({
    selector: '.row-ugd',
    events: {
        hide: (element, event) => {
            $(element.selector).removeClass('table-secondary')
        }
    },
    build: (element, event) => {
        const no_rawat = element.data('id');
        const no_rkm_medis = element.data('no_rkm_medis');
        const no_peserta = element.data('no_peserta');
        const dokter_bpjs = element.data('dokter_bpjs');
        const penjab = element.data('penjab');
        const umur = element.data('umur');
        const sttsumur = element.data('sttsumur');
        const pasien = element.data('pasien');
        const tgl_daftar = element.data('tgl_registrasi')
        const umurHari = hitungUmurDaftar(pasien.tgl_lahir, tgl_daftar)
        const totalHari = Number((umurHari.tahun * 365)) + Number((umurHari.bulan * 28)) + Number(umurHari.hari)
        element.addClass('table-secondary')

        return {
            items: {
                "soapUGD": {
                    name: "SOAP/CPPT",
                    icon: 'fa-regular fa-stethoscope',
                    callback: function (item, option, e, x, y) {
                        modalSoapUgd(no_rawat);
                    }

                },
                "pemeriksaanPenunjang": pemeriksaanPenunjangMenuItems(no_rawat),
                "asesmen": asesmenMenuItems(no_rawat, umur, sttsumur, totalHari),
                "skoringTb": skoringTbMenuItems(no_rawat),
                "hasilKritis": hasilKritisMenuItems(no_rawat),
                "uploadBerkas": uploadBerkasMenuItems(no_rawat),
                "riwayatPasien": riwayatPasienMenuItems(no_rkm_medis),
                "riwayatIcare": riwayatIcareMenuItems(penjab, no_peserta, dokter_bpjs),
            }
        }
    }
});


// how to create  asesmen items to single variable and call it for another file

