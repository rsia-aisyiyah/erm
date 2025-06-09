$.contextMenu({
    selector: '.row-ranap',
    events: {

        hide: (element, event) => {
            $(element.selector).removeClass('table-secondary')
        }
    },
    build: (element, event) => {
        element.addClass('table-secondary')

        const data = element.data('pasien');
        const totalHari = totalUmurHari(data.tgl_lahir, data.tgl_reg);
        return {
            items: {
                "soap": {
                    name: "SOAP/CPPT",
                    icon: 'fa-regular fa-stethoscope',
                    callback: function (item, option, e, x, y) {
                        showModalSoapRanap(data.no_rawat);
                    }
                },
                "pemeriksaanPenunjang": pemeriksaanPenunjangMenuItems(data.no_rawat),
                "asesmen": asesmenMenuItems(data.no_rawat, data.umurdaftar, data.sttsumur, totalHari),
                "skoringTb": skoringTbMenuItems(data.no_rawat),
                "hasilKritis": hasilKritisMenuItems(data.no_rawat),
                "uploadBerkas": uploadBerkasMenuItems(data.no_rawat),
                "riwayatPasien": riwayatPasienMenuItems(data.no_rkm_medis),

            }
        }
    },

});