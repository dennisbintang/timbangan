<h4>LAPORAN PENGUJIAN DAN/ATAU KALIBRASI TIMBANGAN BAYI</h4>
<br/>
<h5>A. PENDATAAN ADMINISTRASI</h5>
<table>
    <tr>
        <th width="100px">Nomor Order</th>
        <th width="100px">:</th>
        <td width="100px">{{ $administrasis->no_order }}</td>
        <td></td>
        <th width="150px">Resolusi</th>
        <th width="100px">:</th>
        <td width="100px">{{ $administrasis->resolusi }}</td>
        <td>kg</td>
    </tr>
    <tr>
        <th width="100px">Nama Alat</th>
        <th width="100px">:</th>
        <td width="100px">{{ $administrasis->nama_alat }}</td>
        <td></td>
        <th width="150px">Rentang Ukur</th>
        <th width="100px">:</th>
        <td width="100px">{{ $administrasis->rentang_ukur }}</td>
        <td>kg</td>
    </tr>
    <tr>
        <th width="100px">Merek</th>
        <th width="100px">:</th>
        <td width="100px">{{ $administrasis->merek }}</td>
        <td></td>
        <th width="150px">Ruangan Tempat Alat</th>
        <th width="100px">:</th>
        <td width="100px">{{ $administrasis->nama_instansi }}</td>
    </tr>
    <tr>
        <th width="100px">Model/Type</th>
        <th width="100px">:</th>
        <td width="100px">{{ $administrasis->model_type }}</td>
        <td></td>
        <th width="150px">Ruangan Kalibrasi</th>
        <th width="100px">:</th>
        <td width="100px">{{ $administrasis->ruang_kalibrasi }}</td>
    </tr>
    <tr>
        <th width="100px">No Seri</th>
        <th width="100px">:</th>
        <td width="100px">{{ $administrasis->no_seri }}</td>
        <td></td>
        <th width="150px">Tanggal Kalibrasi</th>
        <th width="100px">:</th>
        <td width="100px">{{ $administrasis->tanggal_kalibrasi }}</td>
    </tr>
</table>
<br/>
<h5>B. DAFTAR ALAT YANG DIGUNAKAN</h5>
<table>
    <thead>
    <tr>
        <th>Nama Alat</th>
        <th>Merek</th>
        <th>Tipe / Model</th>
        <th>No Seri</th>
    </tr>
    </thead>
    <tbody>
    @foreach($alats as $alat)
        <tr>
            <td>{{ $alat->nama_alat }}</td>
            <td>{{ $alat->merek_alat }}</td>
            <td>{{ $alat->tipe_model }}</td>
            <td>{{ $alat->no_seri }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<br/>
<h5>C. PENGUKURAN KONDISI LINGKUNGAN</h5>
<table>
    <thead>
    <tr>
        <th>Kondisi Ruang</th>
        <th>Penunjukan Standar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($kondisis as $kondisi)
        <tr>
            <td>{{ $kondisi->kondisi_ruang }}</td>
            <td>{{ $kondisi->standar }}</td>
            <td>±</td>
            <td>{{ $kondisi->ktps }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<br/>
<h5>D. PEMERIKSAAN FISIK DAN FUNGSI ALAT</h5>
<table>
    <thead>
    <tr>
        <th>Bagian Alat</th>
        <th>Fisik</th>
        <th>Fungsi</th>
    </tr>
    </thead>
    <tbody>
        
    @foreach($fungsialats as $fungsialat)
        <tr>
            <td>{{ $fungsialat->bagian_alat }}</td>
            <td>{{ $fungsialat->fisik }}</td>
            <td>{{ $fungsialat->fungsi }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<br/>
<h5>E. KALIBRASI AKURASI MASSA</h5>
<h5>1. Kemampuan Baca Kembali (Repeatibility of Reading)</h5>
<table>
    <thead>
    <tr>
        <th colspan=2>Simpangan</th>
        <th>Satuan</th>
    </tr>
    </thead>
    <tr>
        <td>Kapasitas mendekati nol</td>
        <td>{{ $pkmn }}</td>
        <td>kg</td>
    </tr>
    <tr>
        <td>Kapasitas Setengah Penuh</td>
        <td>{{ $pks }}</td>
        <td>kg</td>
    </tr>
    <tr>
        <td>Kapasitas Penuh</td>
        <td>{{ $pkp }}</td>
        <td>kg</td>
    </tr>
    <tbody>
    </tbody>
</table>
<br/>
<h5>2. Penyimpangan Penunjukan</h5>
<table>
    <thead>
    <tr>
        <th>Titik Setting</th>
        <th>Pembacaan</th>
        <th>Koreksi</th>
        <th>Ketidakpastian</th>
    </tr>
    <tr>
        <th>kg</th>
        <th>kg</th>
        <th>kg</th>
        <th>kg</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nilainominals as $nilainominal)
        <tr>
            <td>{{ $nilainominal->titiksetting }}</td>
            <td>{{ $nilainominal->pembacaan_massa }}</td>
            <td>{{ $nilainominal->koreksi_result }}</td>
            <td>{{ $nilainominal->ketidakpastian }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<br/>
<h5>3. Pembebanan Tidak Dipusat</h5>
<table>
    <thead>
    <tr>
        <th>Posisi</th>
        <th>Pembacaan kg</th>
        <th>Max Perbedaan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bebanpusats as $bebanpusat)
        <tr>
            <td>{{ $bebanpusat->posisi }}</td>
            <td>{{ $bebanpusat->pembacaan }}</td>
            <td></td>
        </tr>
    @endforeach    
    </tbody>
</table>
<br/>
<table>
    <tr>
        <th>4. LOP</th>
        <td>'=  ±</td>
        <td></td>
        <td>gram</td>
    </tr>
    <tr>
        <td></td>
        <td>'=  ±</td>
        <td></td>
        <td>kg</td>
    </tr>
</table>
<br/>
<h5>F. Kesimpulan dan Saran</h5>
<table>
    <thead>
    <tr>
        <th>Parameter</th>
        <th>Hasil</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<br/><h5>Catatan</h5>
<table>
    <thead>
    <tr>
        <td>1. Hasil kalibrasi tertelusur ke SI melalui LK-188 dan LK-032-IDN</td>
    </tr>
    <tr>
        <td>2. Pengujian dan kalibrasi menggunakan metode kerja nomor MK-46-SKP-2019</td>
    </tr>
    <tr>
        <td>3. Nilai Ketidakpastian pengukuraan dinyatakan pada tingkat kepercayaan 95%, k=2</td>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>