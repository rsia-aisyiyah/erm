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
                "hasilKritis": hasilKritisMenuItems(data.no_rawat),
                "asesmen": asesmenMenuItems(data.no_rawat, data.umurdaftar, data.sttsumur, totalHari, data.kd_sps),
                "skoringTb": skoringTbMenuItems(data.no_rawat),
                "planOfCare": {
                    name: "Plan of Care",
                    icon: "fa-regular fa-hand-lizard",
                    callback: () => modalPlanOfCare(data.no_rawat)
                },
                "monitoringCairan": {
                    name: "Monitoring Cairan",
                    icon: "fa-regular fa-tint",
                    callback: () => showModalMonitoringCairan(data.no_rawat)
                },
                "catatanEdukasiPasien": {
                    name: "Catatan Edukasi Pasien",
                    icon: "fa-regular fa-bell",
                    callback: () => catatanEdukasiPasien(data.no_rawat)
                },
                "obatPulang": {
                    name: "Edukasi Obat Pulang",
                    icon: "fa-regular fa-pills",
                    callback: () => showModalObatPulang(data.no_rawat)
                },
                "dischargePlanning": {
                    name: "Discharge Planning",
                    icon: "fa-regular fa-lightbulb",
                    callback: () => showModalDischargePlanning(data.no_rawat)
                },
                "resumeMedis": {
                    name: "Resume Medis",
                    icon: "fa-regular fa-file-alt",
                    callback: () => resumeMedis(data.no_rawat)
                },
                "uploadBerkas": uploadBerkasMenuItems(data.no_rawat),
                "riwayatPasien": riwayatPasienMenuItems(data.no_rkm_medis),

            }
        }
    },

});