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
                "pemeriksaanLab": {
                    name: "SOAP/CPPT",
                    icon: 'fa-regular fa-stethoscope',
                    callback: function (item, option, e, x, y) {
                        modalSoapUgd(no_rawat);
                    }

                },
                "pemeriksaanPenunjang": {
                    name: "Pemeriksaan Penunjang",
                    icon: 'fa-regular fa-flask',
                    callback: function (item, option, e, x, y) {
                        modalPemeriksaanPenunjang(`${no_rawat}`)
                    }
                },
                "asesmen": {
                    name: "Asesmen",
                    icon: 'fa-regular fa-book',
                    items: {
                        "asesmenMedis": {
                            name: "Asesmen Medis UGD",
                            callback: function (item, option, e, x, y) {
                                modalAsmedUgd(no_rawat)
                            }

                        },
                        "asesmenKeperawatan": {
                            "name": "Asesmen Keperawatan UGD",
                            disabled: (item, option, e, x, y) => {
                                return true;

                            },
                            callback: function (item, option, e, x, y) {
                                return false;
                            }
                        },
                        "asesmenNyeri": {
                            name: "Asesmen Nyeri",
                            icon: 'fa-regular fa-paperclip',
                            items: {
                                "asesmenNyeriNeonatus": {
                                    name: "Asesmen Nyeri Neonatus/Bayi",
                                    disabled: () => {
                                        if (totalHari <= 28 && totalHari <= 3 * 365) {
                                            return false;
                                        }
                                        return true;

                                    },
                                    callback: function (item, option, e, x, y) {
                                        showModalAsesmenNyeriNeonatus(`${no_rawat}`)
                                    }
                                },
                                "asesmenNyeriBatita": {
                                    name: "Asesmen Nyeri Batita",
                                    disabled: () => {
                                        if (totalHari <= 3 * 365 && totalHari >= 28) {
                                            return false;
                                        }
                                        return true;
                                    },
                                    callback: function (item, option, e, x, y) {
                                        showModalAsesmenNyeriBatita(`${no_rawat}`)
                                    }
                                },
                                "asesmenNyeriBalita": {
                                    name: "Asesmen Nyeri Balita",
                                    disabled: () => {
                                        if (totalHari <= 7 * 365 && totalHari >= 3 * 365) {
                                            return false;
                                        }
                                        return true;
                                    },
                                    callback: function (item, option, e, x, y) {
                                        showModalAsesmenNyeriBalita(`${no_rawat}`)
                                    }
                                },
                                "asesmenNyeriAnak": {
                                    name: "Asesmen Nyeri Anak",
                                    disabled: () => {
                                        if (totalHari >= 7 * 365 && totalHari <= 13 * 365) {
                                            return false;
                                        }
                                        return true;
                                    },
                                    callback: function (item, option, e, x, y) {
                                        showModalAsesmenNyeriAnak(`${no_rawat}`)
                                    }
                                },
                                "asesmenNyeriDewasa": {
                                    name: "Asesmen Nyeri Dewasa",
                                    disabled: () => {
                                        if (totalHari >= 13 * 365) {
                                            return false;
                                        }
                                        return true;
                                    },
                                    callback: function (item, option, e, x, y) {
                                        showModalAsesmenNyeriDewasa(`${no_rawat}`)
                                    }
                                }
                            }
                        },
                        "asesmenResikoJatuh": {
                            name: "Asesmen Resiko Jatuh",
                            icon: 'fa-regular fa-paperclip',
                            items: {
                                "asesmenResikoJatuhDewasa": {
                                    name: "Asesmen Resiko Jatuh Dewasa",
                                    disabled: (item, option, e, x, y) => umur < 13 || sttsumur !== 'Th',
                                    callback: (item, option, e, x, y) => showModalAsesmenResikoJatuhDewasa(`${no_rawat}`)
                                },
                                "asesmenResikoJatuhAnak": {
                                    name: "Asesmen Resiko Jatuh Anak",
                                    disabled: (item, option, e, x, y) => umur > 13 && sttsumur === 'Th',
                                    callback: (item, option, e, x, y) => showModalAsesmenResikoJatuhAnak(`${no_rawat}`)
                                }
                            }
                        },

                    }
                },
                "SkoringTB": {
                    name: "Skoring TB",
                    icon: 'fa-regular fa-pencil',
                    callback: function (item, option, e, x, y) {
                        skoringTb(`${no_rawat}`)
                    }
                },
                "hasilKritis": {
                    name: "Hasil Kritis",
                    icon: 'fa-regular fa-warning',
                    callback: function (item, option, e, x, y) {
                        hasilKritis(`${no_rawat}`)
                    }
                },
                "uploadBerkas": {
                    name: "Upload Berkas",
                    icon: 'fa-regular fa-upload',
                    callback: function (item, option, e, x, y) {
                        detailPeriksa(`${no_rawat}`)
                    }
                },
                "riwayatPasien": {
                    name: "Riwayat Pasien",
                    icon: 'fa-regular fa-search',
                    callback: function (item, option, e, x, y) {
                        listRiwayatPasien(`${no_rkm_medis}`);
                    }
                },
                "riwayatIcare": {
                    name: "Riwayat I-Care",
                    icon: 'fa-regular fa-search',
                    disabled: (item, option, e, x, y) => {
                        if (penjab === 'A01' || penjab === 'A05') {
                            return false;
                        }

                        return true;

                    },
                    callback: function (item, option, e, x, y) {
                        riwayatIcare(no_peserta, dokter_bpjs);
                    }
                }
            }
        }
    }
});
