let development = {
    run: function () {
        let sample = {
            f1nama: 'Beni',
			f1jabatan: 'Direktur',
			f1alamat: 'Jl. Rasuna Said kav. 61',
			f1kelurahan: 'Setiabudi',
			f1kecamatan: 'Setiabudi',
			f1kota: 'Jakarta Selatan',
			f1provinsi: 'DKI Jakarta',
			f1kodepos: '10920',
			f1telp: '0212521810',
			f1email: 'dummyf1@fake.com',

            f2nama: 'PT. Rona Merah Sejati',
            f2alamat: 'Jl. Rasuna Said kav. 62',
            f2kelurahan: 'Setiabudi',
            f2kecamatan: 'Setiabudi',
            f2kota: 'Jakarta Selatan',
            f2provinsi: 'DKI Jakarta',
            f2kodepos: '10920',
            f2telp: '0212521810',

            f2kegiatan: 'Garment',
            f2alamatkegiatan: 'Jl. Rasuna Said kav. 60',
            f2kelurahankegiatan: 'Setiabudi',
            f2kecamatankegiatan: 'Setiabudi',
            f2kotakegiatan: 'Jakarta Selatan',
            f2provinsikegiatan: 'DKI Jakarta',
            f2kodeposkegiatan: '10920',

            f2akta: 'Akta no. 23 tahun 2001',
            f2npp: '12',
            f2npwp: '3278123698',
            f2produksi: 'Kain',
            f2kapasitas: '120 m3 per hari',
            f2kontak: 'contact@fake.com',

            f3jabatan: 'Legal',
            f3alamat: 'Jl. Rasuna Said kav. 63',
            f3kelurahan: 'Setiabudi',
            f3kecamatan: 'Setiabudi',
            f3kota: 'Jakarta Selatan',
            f3provinsi: 'DKI Jakarta',
            f3kodepos: '10920',
            f3telp: '0212521810',
        };

        $.each(sample, function (key , val) {
            $('[name="'+key+'"]').val(val);
        });

    }
}

