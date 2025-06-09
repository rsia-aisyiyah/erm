const asesmenMenuItems = (noRawat, umur, sttsumur, totalHari) => ({
    name: "Asesmen",
    icon: 'fa-regular fa-book',
    items: {
        asesmenMedis: {
            name: "Asesmen Medis UGD",
            callback: () => modalAsmedUgd(noRawat)
        },
        asesmenKeperawatan: {
            name: "Asesmen Keperawatan UGD",
            disabled: () => true,
            callback: () => false
        },
        asesmenNyeri: {
            name: "Asesmen Nyeri",
            icon: 'fa-regular fa-paperclip',
            items: {
                asesmenNyeriNeonatus: {
                    name: "Asesmen Nyeri Neonatus/Bayi",
                    disabled: () => totalHari > 28 || totalHari > 3 * 365,
                    callback: () => showModalAsesmenNyeriNeonatus(noRawat)
                },
                asesmenNyeriBatita: {
                    name: "Asesmen Nyeri Batita",
                    disabled: () => totalHari <= 28 || totalHari < 3 * 365,
                    callback: () => showModalAsesmenNyeriBatita(noRawat)
                },
                asesmenNyeriBalita: {
                    name: "Asesmen Nyeri Balita",
                    disabled: () => totalHari <= 3 * 365 || totalHari < 7 * 365,
                    callback: () => showModalAsesmenNyeriBalita(noRawat)
                },
                asesmenNyeriAnak: {
                    name: "Asesmen Nyeri Anak",
                    disabled: () => totalHari <= 7 * 365 || totalHari < 13 * 365,
                    callback: () => showModalAsesmenNyeriAnak(noRawat)
                },
                asesmenNyeriDewasa: {
                    name: "Asesmen Nyeri Dewasa",
                    disabled: () => totalHari <= 13 * 365,
                    callback: () => showModalAsesmenNyeriDewasa(noRawat)
                }
            }
        },
        asesmenResikoJatuh: {
            name: "Asesmen Resiko Jatuh",
            icon: 'fa-regular fa-paperclip',
            items: {
                asesmenResikoJatuhDewasa: {
                    name: "Asesmen Resiko Jatuh Dewasa",
                    disabled: () => umur < 13 || sttsumur !== 'Th',
                    callback: () => showModalAsesmenResikoJatuhDewasa(noRawat)
                },
                asesmenResikoJatuhAnak: {
                    name: "Asesmen Resiko Jatuh Anak",
                    disabled: () => umur > 13 && sttsumur === 'Th',
                    callback: () => showModalAsesmenResikoJatuhAnak(noRawat)
                }
            }
        }
    }
});

const skoringTbMenuItems = (no_rawat) => ({
    name: "Skoring TB",
    icon: 'fa-regular fa-pencil',
    callback: function (item, option, e, x, y) {
        skoringTb(`${no_rawat}`)
    }
})

const hasilKritisMenuItems = (no_rawat) => ({
    name: "Hasil Kritis",
    icon: 'fa-regular fa-warning',
    callback: function (item, option, e, x, y) {
        hasilKritis(`${no_rawat}`)
    }
})

const uploadBerkasMenuItems = (no_rawat) => ({
    name: "Upload Berkas",
    icon: 'fa-regular fa-upload',
    callback: function (item, option, e, x, y) {
        detailPeriksa(`${no_rawat}`)
    }

})

const riwayatPasienMenuItems = (no_rkm_medis) => (
    {
        name: "Riwayat Pasien",
        icon: 'fa-regular fa-search',
        callback: function (item, option, e, x, y) {
            listRiwayatPasien(`${no_rkm_medis}`);
        }
    }
)

const riwayatIcareMenuItems = (penjab, no_peserta, kd_dokter) => ({

    name: "Riwayat I-Care",
    icon: 'fa-regular fa-search',
    disabled: (item, option, e, x, y) => {
        if (penjab === 'A01' || penjab === 'A05') {
            return false;
        }

        return true;

    },
    callback: function (item, option, e, x, y) {
        riwayatIcare(no_peserta, kd_dokter);
    }

})

const pemeriksaanPenunjangMenuItems = (no_rawat) => (
    {
        name: "Pemeriksaan Penunjang",
        icon: 'fa-regular fa-flask',
        callback: function (item, option, e, x, y) {
            modalPemeriksaanPenunjang(`${no_rawat}`)
        }
    }
)
