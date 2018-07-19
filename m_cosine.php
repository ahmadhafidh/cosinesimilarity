<?php
class M_cosine extends CI_Model
{

	function hitung($data1, $data2){
		//mengecilkan kedua kalimat
		$kalimat1 = strtolower($data1);
		$kalimat2 = strtolower($data2);

		//memisahkan kalimat setiap ada spasi
		$potongan[0] = explode(' ',$kalimat1);
		$potongan[1] = explode(' ',$kalimat2);


		for($i=0;$i<count($potongan[0]);$i++){
			$pot_copy[] = $potongan[0][$i];
			$kalimat1 = $potongan[0];
		 }
		for($i=0;$i<count($potongan[1]);$i++){
		$pot_copy[] = $potongan[1][$i];
		$kalimat2 = $potongan[1];

		// }

		//Penghapusan Data Kembar
		for($i=1;$i<count($pot_copy);$i++){
			$x = $i-1;
			if($pot_copy[$x]!=" "){
				//jika pot_copy[$x] tidak kosong
				for($j=$i;$j<count($pot_copy);$j++){
					if($pot_copy[$x]==$pot_copy[$j]){
						$pot_copy[$j]=" ";
					}
				}
			}
		}

		//Pemfilteran kata yang sama agar tidak di tampilkan
		$ukuran = 0;
		for($i=0;$i<count($pot_copy);$i++){
			if($pot_copy[$i]!=" "){
				$term[] = $pot_copy[$i];
				$nilai1[] = 0;
				$nilai2[] = 0;
				$ukuran++;
			}
		//echo $pot_copy[$i]."<br>";
		}


		//Menghitung banyaknya tiap kata yang sama
		for($i=0;$i<count($term);$i++){
			for($j=0;$j<count($potongan[0]);$j++){
				if($term[$i] == $potongan[0][$j]){
					$nilai1[$i]++;
				}
			}
		}

		for($i=0;$i<count($term);$i++){
			for($j=0;$j<count($potongan[1]);$j++){
				if($term[$i] == $potongan[1][$j]){
					$nilai2[$i]++;
				}
			}
		}

		//Detail Proses
		$AxB = 0;
		$Amutlak = 0;
		$Bmutlak = 0;
		$hasil['cosine'] = 0;
		for($i=0; $i<count($nilai1); $i++){
			$AxB = $AxB+($nilai1[$i]*$nilai2[$i]);
			$Amutlak = $Amutlak+($nilai1[$i]*$nilai1[$i]);
			$Bmutlak = $Bmutlak+($nilai2[$i]*$nilai2[$i]);
		}
		
		$hasil['kalimat1'] = $kalimat[0];
		$hasil['kalimat2'] = $kalimat[1];
		$hasil['Amutlak'] = $Amutlak;
		$hasil['Bmutlak'] = $Bmutlak;

		$hasil['cosine']=$AxB/(sqrt($Amutlak)*sqrt($Bmutlak));
		// $hasil= $kalimat[0];
		return $hasil;

	}		
}
// copyright by Ahmad Hafidh Ayatullah
?>