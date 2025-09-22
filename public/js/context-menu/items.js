const asesmenMenuItems = (noRawat, umur, sttsumur, totalHari, kd_sps) => ({
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
        asesmenRanap: {
            name: "Asesmen Ranap",
            // disabled: () => false,
            icon: 'fa-regular fa-paperclip',
            // items: {
            //     asesmenMedisKandungan: {
            //         name: "Asesmen Medis Kandungan",
            //         callback: () => modalAsmedKandungan(noRawat)
            //     },
            //     asesmenMedisAnak: {
            //         name: "Asesmen Medis Anak",
            //         callback: () => modalAsmedAnak(noRawat)
            //     },
            //     asesmenKeperawatanAnak: {
            //         name: "Asesmen Keperawatan Anak",
            //         callback: () => modalAskepAnak(noRawat)
            //     },
            //     asesmenKeperawatanKandungan: {
            //         name: "Asesmen Keperawatan Kandungan",
            //         callback: () => modalAskepAnak(noRawat)
            //     }
            // }
            items: asesmenRanapMenuItems(noRawat, kd_sps),
        },
        asesmenNyeri: {
            name: "Asesmen Nyeri",
            icon: 'fa-regular fa-paperclip',
            items: {
                asesmenNyeriNeonatus: {
                    name: "Asesmen Nyeri Neonatus/Bayi",
                    // Dinonaktifkan jika usia pasien LEBIH DARI 28 hari
                    disabled: () => totalHari > 28,
                    callback: () => showModalAsesmenNyeriNeonatus(noRawat)
                },
                asesmenNyeriBatita: {
                    name: "Asesmen Nyeri Batita",
                    // Dinonaktifkan jika usia pasien KURANG DARI atau SAMA DENGAN 28 hari,
                    // ATAU jika usia pasien LEBIH DARI atau SAMA DENGAN 3 tahun (365 * 3 hari)
                    disabled: () => totalHari <= 28 || totalHari >= (3 * 365),
                    callback: () => showModalAsesmenNyeriBatita(noRawat)
                },
                asesmenNyeriBalita: {
                    name: "Asesmen Nyeri Balita",
                    // Dinonaktifkan jika usia pasien KURANG DARI 3 tahun (365 * 3 hari),
                    // ATAU jika usia pasien LEBIH DARI atau SAMA DENGAN 7 tahun (365 * 7 hari)
                    disabled: () => totalHari < (3 * 365) || totalHari >= (7 * 365),
                    callback: () => showModalAsesmenNyeriBalita(noRawat)
                },
                asesmenNyeriAnak: {
                    name: "Asesmen Nyeri Anak",
                    // Dinonaktifkan jika usia pasien KURANG DARI 7 tahun (365 * 7 hari),
                    // ATAU jika usia pasien LEBIH DARI atau SAMA DENGAN 13 tahun (365 * 13 hari)
                    disabled: () => totalHari < (7 * 365) || totalHari >= (13 * 365),
                    callback: () => showModalAsesmenNyeriAnak(noRawat)
                },
                asesmenNyeriDewasa: {
                    name: "Asesmen Nyeri Dewasa",
                    // Dinonaktifkan jika usia pasien KURANG DARI 13 tahun (365 * 13 hari)
                    disabled: () => totalHari < (13 * 365),
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
            // listRiwayatPasien(`${no_rkm_medis}`);
            modalRiwayat(`${no_rkm_medis}`);
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

const totalUmurHari = (tgl_lahir, tgl_daftar) => {
    const umurHari = hitungUmurDaftar(tgl_lahir, tgl_daftar);
    const total = Number((umurHari.tahun * 365)) + Number((umurHari.bulan * 28)) + Number(umurHari.hari)

    return total
}

const asesmenRanapMenuItems = (no_rawat, kd_sps) => ({
    "asmedRanapKandungan": {
        name: "Asesmen Medis Kandungan",
        disabled: () => kd_sps !== 'S0001',
        callback: () => asmedRanapKandungan(no_rawat)
    },
    "asmedRanapAnak": {
        name: "Asesmen Medis Anak",
        disabled: () => kd_sps !== 'S0003',
        callback: () => asmedRanapAnak(no_rawat)
    },
    "askepRanapKandungan": {
        name: "Asesmen Keperawatan Kandungan",
        disabled: () => kd_sps !== 'S0001',
        callback: () => {
            return askepRanapKandungan(no_rawat)
        }
    },
    "askepRanapAnak": {
        name: "Asesmen Keperawatan Anak",
        disabled: () => kd_sps !== 'S0003',
        callback: () => askepRanapAnak(no_rawat)
    }
})