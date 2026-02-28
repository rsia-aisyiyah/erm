    $.contextMenu({
        selector: '.row-sep',
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
                    "kontrolUlang": {
                        name: "Surat Kontrol Rawat Jalan / SKRJ",
                        icon: 'fa-regular fa-tag',
                        disabled : function(key, option){
                           // return data.jnspelayanan != 2;
                        },
                        callback: function (item, option, e, x, y) {
                            kontrolUlang(data.sep);
                        }
                    },
                    "perintahRawatInap": {
                        name: "Surat Perintah Rawat Inap / SPRI",
                        icon: 'fa-regular fa-tag',
                        // disabled : function(key, option){
                        //     return data.jnspelayanan != 2;
                        // },
                        callback: function (item, option, e, x, y) {
                            // rawatInap(data.no_rkm_medis, data.tgl_reg);
                            showModalSpri(data.no_rawat)
                        }
                    },
                    "rujukBalik": {
                        name: "Surat Rujuk Keluar",
                        icon: 'fa-regular fa-tag',
                        callback: function (item, option, e, x, y) {
                            rujukanKeluar(data.sep);
                        }
                    },
                    "uploadBerkas": uploadBerkasMenuItems(data.no_rawat),
                    "riwayatPasien": riwayatPasienMenuItems(data.no_rkm_medis),

                }
            }
        },

    });