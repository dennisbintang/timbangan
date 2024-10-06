<?php

namespace App\Exports;

use App\Models\Administrasi;
use App\Models\DaftarAlat;
use App\Models\PengukurKondisi;
use App\Models\PemeriksaanFungsiAlat;
use App\Models\KemampuanBacaKembali;
use App\Models\PenyimpanganNilaiNominal;
use App\Models\PengaruhPembebananTengah;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResultExport implements FromView
{
    protected $id;

    function __construct($id) {
            $this->id = $id;
    }

    public function view(): View
    {
        $datakondisi = PengukurKondisi::where('administrasi_id', $this->id)->get();
        foreach ($datakondisi as $key => $value) {
            $datakondisi[$key]['sum'] =  $value['awal'] + $value['akhir'];
            $datakondisi[$key]['average'] =  $value['sum'] / 2;
            if($datakondisi[$key]['kondisi_ruang'] == "Suhu (⁰C)"){
                $datakondisi[$key]['intercept'] =  -0.54749066777272;
                $datakondisi[$key]['xvar'] = 1.01824968892576;
                $datakondisi[$key]['ktps'] = round(1,2);
            }else if($datakondisi[$key]['kondisi_ruang'] == "Kelembaban (%RH)"){
                $datakondisi[$key]['intercept'] =  2.06105186954188;
                $datakondisi[$key]['xvar'] = 1.01933406281594;
                $datakondisi[$key]['ktps'] = round(5,2);
            }
            $datakondisi[$key]['standar'] = round($datakondisi[$key]['intercept'] + $datakondisi[$key]['xvar'] * $datakondisi[$key]['average'], 2);
            
        }

        $bacakembali = KemampuanBacaKembali::where('administrasi_id', $this->id)->get();
        foreach ($bacakembali as $key => $value) {
            $perbedaanKMN[$key] = $bacakembali[$key]['KMN_pembaca'] - $bacakembali[$key]['KMN_nol'];
            $perbedaanKS[$key] = $bacakembali[$key]['KS_pembaca'] - $bacakembali[$key]['KS_nol'];
            $perbedaanKP[$key] = $bacakembali[$key]['KP_pembaca'] - $bacakembali[$key]['KP_nol'];
            //$resBacaKembali['']
        }
        $pkmn = $this->Stand_Deviation($perbedaanKMN);
        $pks = $this->Stand_Deviation($perbedaanKS);
        $pkp = $this->Stand_Deviation($perbedaanKP);
        
        $nilainominal = PenyimpanganNilaiNominal::where('administrasi_id', $this->id)->get();
        foreach ($nilainominal as $key => $value) {
            $sumnilai = $nilainominal[$key]['m1'] + $nilainominal[$key]['m1_'];
            $nilainominal[$key]['titiksetting'] = $key + 1;
            $nilainominal[$key]['pembacaan_massa'] = $sumnilai / 2;

            $nextkey = $key + 1;
            if($nextkey < count($nilainominal)){
                $sumz = $nilainominal[$key]['z1'] + $nilainominal[$nextkey]['z1'];
                $nilainominal[$key]['pembacaan_nol'] = $sumz / 2;
            }else{
                $sumz = $nilainominal[$key]['z1'] + 0;
                $nilainominal[$key]['pembacaan_nol'] = $sumz / 2;    
            }

            $nilainominal[$key]['perbedaan'] = ($nilainominal[$key]['pembacaan_massa']-$nilainominal[$key]['pembacaan_nol']) * 1000; 
            $nilainominal[$key]['conv_mass'] = $this->Conv_mass($nilainominal[$key]['nominal_mass']);
            
            $nilainominal[$key]['koreksi'] = round(abs($nilainominal[$key]['conv_mass'] - $nilainominal[$key]['perbedaan']), 2);
            $nilainominal[$key]['koreksi_result'] = round($nilainominal[$key]['koreksi'] / 1000, 2);
            $nilainominal[$key]['ketidakpastian'] = 0.05;
        }

        // echo "<pre>";
        //   print_r($nilainominal);
          
        // echo "</pre>";
        //   die();
        return view('exports.administrasis', [
            'administrasis' => Administrasi::where('id', $this->id)->first(),
            'alats' => DaftarAlat::where('administrasi_id', $this->id)->get(),
            'kondisis' => $datakondisi,
            'fungsialats' => PemeriksaanFungsiAlat::where('administrasi_id', $this->id)->get(),
            'pkmn' => round($pkmn,1),
            'pks' => round($pks,1),
            'pkp' => round($pkp,1),
            'nilainominals' => $nilainominal,
            'bebanpusats' => PengaruhPembebananTengah::where('administrasi_id', $this->id)->get()
        ]);
    }

    function Conv_mass($nominal){
        //need table ref
        $massa1 = 1000.001;
        $massa2 = 2000.001;
        $massa3 = 2000.003;
        $massa4 = 5000.008;
        //end need table ref
        $result = 0;
        if($nominal == 1){
            $result = $massa1;
        }elseif($nominal == 2){
            $result = $massa2;
        }elseif($nominal == 3){
            $result = $massa1 + $massa2;
        }elseif($nominal == 4){
            $result = $massa2 + $massa3;
        }elseif($nominal == 5){
            $result = $massa4;
        }elseif($nominal == 6){
            $result = $massa4 + $massa1;
        }elseif($nominal == 7){
            $result = $massa4 + $massa2;
        }elseif($nominal == 8){
            $result = $massa4 + $massa2 + $massa1;
        }elseif($nominal == 9){
            $result = $massa4 + $massa2 + $massa3;
        }elseif($nominal == 10){
            $result = $massa4 + $massa2 + $massa3 + $massa1;
        }

        return $result;
    }

    function Stand_Deviation($arr)
    {
        $num_of_elements = count($arr);
        
        $variance = 0.0;
        
                // calculating mean using array_sum() method
        $average = array_sum($arr)/$num_of_elements;
        
        foreach($arr as $i)
        {
            // sum of squares of differences between 
                        // all numbers and means.
            $variance += pow(($i - $average), 2);
        }
        
        return (float)sqrt($variance/$num_of_elements);
    }
}
