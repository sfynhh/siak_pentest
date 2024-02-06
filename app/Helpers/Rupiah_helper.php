<?php
   use CodeIgniter\Files\File;
   use CodeIgniter\HTTP\RequestInterface;

   use Dompdf\Dompdf;

  date_default_timezone_set("Asia/Jakarta");
//     function merge_pdfs($pdf1Path, $pdf2Path, $outputPath)
//     {
//          mb_internal_encoding('UTF-8');
//         $dompdf1 = new Dompdf();
//         $dompdf1->loadHtml(file_get_contents($pdf1Path));
//         $dompdf1->render();

//         $dompdf2 = new Dompdf();
//         $dompdf2->loadHtml(file_get_contents($pdf2Path));
//         $dompdf2->render();

//         $output = $dompdf1->output();
//         file_put_contents($outputPath, $output);

//         $dompdf2->loadHtml($output);
//         $dompdf2->render();
//         file_put_contents($outputPath, $dompdf2->output(), FILE_APPEND);
// }



    function rupiah($harga){
        return "Rp ".number_format($harga);
    }

    function terbilang($x)   
    {   
        $bilangan = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");   
        if ($x < 12)   
            return " " . $bilangan[$x];   
        elseif ($x < 20)   
            return terbilang($x - 10) . "belas";   
        elseif ($x < 100)   
            return terbilang($x / 10) . " Puluh" . terbilang($x % 10);   
        elseif ($x < 200)   
       
            return " Seratus" . terbilang($x - 100);   
        elseif ($x < 1000)   
            return terbilang($x / 100) . " Ratus" . terbilang($x % 100);   
        elseif ($x < 2000)   
            return " Seribu" . terbilang($x - 1000);   
        elseif ($x < 1000000)   
            return terbilang($x / 1000) . " Ribu" . terbilang($x % 1000);   
        elseif ($x < 1000000000)   
            return terbilang($x / 1000000) . " Juta" . terbilang($x % 1000000);    
    }
    function singkatan($var){
        $explodevar = explode(" ", $var);
        $arraypush=array();
        if (count($explodevar)>1){
            for ($i=0; $i <count($explodevar) ; $i++) { 
              array_push($arraypush, substr($explodevar[$i], 0,1));
            }
            return strtoupper(implode("", $arraypush));
        }else{
            return $var;
        }
    }

    function datetoindo($date)
    {   
        $bulan = array('01'=>'Januari', '02'=>'Februari','03'=> 'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember');
        $datecom = explode('-', $date);
        $numbulan= $datecom[1];
        return $datecom[2].' '.$bulan[$numbulan].' '.$datecom[0];
    }

     function datetosistem($date)
    {
         
         $bulan = array('Januari'=>'01', 'Februari'=>'02', 'Maret'=>'03', 'April'=>'04', 'Mei'=>'05', 'Juni'=>'06', 'Juli'=>'07', 'Agustus'=>'08', 'September'=>'09', 'Oktober'=>'10', 'November'=>'11', 'Desember'=>'12');

        $dateex =  explode(' ', $date);

        return $dateex[2].'-'.$bulan[$dateex[1]].'-'.$dateex[0];


    }

    function getDayNameIndonesian($date) {
    $dayNames = array(
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
        );
        $dayNameEnglish = date('l', strtotime($date));
        return $dayNames[$dayNameEnglish];
    }

    function convertDateToIndonesianMonth($date_str)
    {
        $year_val = date('Y', strtotime($date_str));
        $month_val = date('m', strtotime($date_str));
        
        $month_names = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        $month_name = $month_names[(int)$month_val - 1];
        
        return $month_name . ' ' . $year_val;
    }

    function getIpaddress()
    {
         $ipAddress = service('request')->getIPAddress();
         if ($ipAddress=='::1') {
             return true;
         }else{
            return false;
         }
    
    }


//fungsi check tanggal merah
    function tanggalMerah($value) {
        $array = json_decode(file_get_contents("https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/calendar.json"),true);

        //check tanggal merah berdasarkan libur nasional
        if(isset($array[$value]) && $array[$value]["holiday"])
        { 
           return  "merah";
            // print_r($array[$value]);

        //check tanggal merah berdasarkan hari minggu
        }else{
            return "hitam";
        }

    }

    function tanggalCuti($value) {
        $curl = curl_init();
        $date=explode('-', date("Y-n-j", strtotime($value)));
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://dayoffapi.vercel.app/api?month='.$date[1].'&year='.$date[0],
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $array=json_decode($response);
        $ket = 'hitam';
        foreach ($array as  $val) {
            if(date("Y-m-d", strtotime($val->tanggal))==$value){
                $ket = 'merah';
            }
        }
        return $ket;

    }

    function convert_num($nohp){
        if(!preg_match("/[^+0-9]/",trim($nohp))){
            if(substr(trim($nohp), 0, 2)=="62"){
                $hp    =trim($nohp);
            }
            else if(substr(trim($nohp), 0, 1)=="0"){
                $hp    ="62".substr(trim($nohp), 1);
            }
        }

      return $hp;
    }

   
?>