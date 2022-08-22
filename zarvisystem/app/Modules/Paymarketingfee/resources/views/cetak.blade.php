<?php

 function penyebut($nilai) {

		$nilai = abs($nilai);

		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");

		$temp = "";

		if ($nilai < 12) {

			$temp = " ". $huruf[$nilai];

		} else if ($nilai <20) {

			$temp = penyebut($nilai - 10). " belas";

		} else if ($nilai < 100) {

			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);

		} else if ($nilai < 200) {

			$temp = " seratus" . penyebut($nilai - 100);

		} else if ($nilai < 1000) {

			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);

		} else if ($nilai < 2000) {

			$temp = " seribu" . penyebut($nilai - 1000);

		} else if ($nilai < 1000000) {

			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);

		} else if ($nilai < 1000000000) {

			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);

		} else if ($nilai < 1000000000000) {

			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));

		} else if ($nilai < 1000000000000000) {

			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));

		}

		return $temp;

	}



	function terbilang($nilai) {

		if($nilai<0) {

			$hasil = "minus ". trim(penyebut($nilai));

		} else {

			$hasil = trim(penyebut($nilai));

		}

		return $hasil;

	}





?>

@foreach($data as $r)

@endforeach

<!DOCTYPE html>

<html>

<head>

	<title>Bukti Pembayaran</title>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<style>

		page { size:A4; margin-left:auto; margin-right:auto; }

		html { height:100%; }

		body { margin-left:1.2cm; font-size:12px;}

		table { border-collapse:collapse; border-spacing:0; border:0; width:95%; }

		th, td { padding:5px; }

		@media print { footer {page-break-after:always; } }



		.foldmark { position:absolute; background-color:black; height:1px; width:3mm; left:4mm; }

	</style>

</head>

<body>

	<div style="width:100%; height:3.0cm;">

		<img src="{{ asset('img/logo/logo_cetak.jpg')}}" width="100%"/>

	</div>

<hr/>

<br/>

<div style="font-size:100%; font-family:Helvetica, sans-serif; float:left; width:100%;">

	<table>

	<tr>

		<td><span style="width:60%; font-size:100%; text-decoration:underline;">

		<?php

            echo "<strong>Dibayarkan Kepada</strong><br></span>";
            echo "<strong>".strtoupper($r->penerima)."</strong><br></span>";
			?>

		</td>



	</tr>

	</table>

	<table>

	<tr>

		<td style="font-size: 100%; font-weight: bold;">



		</td>

		<td style="text-align:right; font-size: 90%;">

			<?php echo "Jember, ".App\Helpers\Tanggal::tgl_indo($r->tanggal); ?>

		</td>

	</tr>

	</table>

	<table style="border:1px solid #000;">

	<tr style="border:1px solid #000; font-weight: bold;">

		<td style="width:5%; text-align:center;">No</td>

		<td style="width:50%; text-align:left;">Keterangan</td>

		<td style="width:10%; text-align:center;">Metode</td>

		<td style="width:15%; text-align:center;">Jumlah</td>

	</tr>

	<tr>

		<td style="text-align:center;"><?php echo 1; ?></td>

		<td>Marketing Fee : {{$r->keterangan}}</td>

		<td style="text-align:center;">{{$r->tipe_pembayaran}}</td>

		<td style="text-align:right;">Rp {{ number_format($r->jumlah_bayar) }}</td>

	</tr>



	<tr style="border:1px solid #000;">

		<td colspan="3" style="text-align:right; font-weight:bold;">Total Pembayaran</td>

		<td style="text-align:right; font-weight:bold;">Rp {{ number_format($r->jumlah_bayar) }}</td>

	</tr>

	</table>

	<table>

	<tr>

		<td style="font-weight:bold;"><u>Terbilang</u></td>

	</tr>

	<tr>

		<td>

			{{ ucwords(terbilang($r->jumlah_bayar))}}  Rupiah

		</td>

	</tr>

	<tr>

		<td style="text-align:right; font-size: 90%;">

			<table>

				<tr><td style="text-align:right; width:60%; vertical-align:top;"></td>

					<td style="text-align:right; width:40%; vertical-align:top;">

						<table>

							<tr>

								<td  style="text-align:center;">Dibayarkan Oleh,</td>

							</tr>

							<tr>

								<td><br/><br/><br/></td>

							</tr>

							<tr>

								<td style="text-align:center;">( HARISH FAUZAN LUTHFI )</td>

							</tr>

						</table>

					</td>

				</tr>

				</table>

		</td>

	</tr>

	</table>





</div>

</body>

</html>
