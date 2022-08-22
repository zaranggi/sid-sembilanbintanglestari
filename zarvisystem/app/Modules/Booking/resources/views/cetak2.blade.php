<?php

/*
 * (C)2016 by Tim Rühsen
 * License: MIT style license, see LICENSE
 */

class item {
	public $name;
	public $description;
	public $units;
	public $unitprice;

	public function __construct(Array $value = array()) {
		$this->name = $value[0];
		$this->description = $value[1];
		$this->units = $value[2];
		$this->unitprice = $value[3];
	}
}

function de_float($number) {
	return number_format($number, 2, ',', '.');
}

function currency($number) {
	return de_float($number) . " €";
}

$tax = 19;
$logoImage = "logo.png";

/* Leistungsbringer */
$sender_company = "Meine GmbH";
$sender_street = "Meinestraße 1";
$sender_zip = "90123";
$sender_city = "Meinestadt";
$sender_country = "";
$sender_fon = "089-1234-56";
$sender_fax = "089-1234-99";
$sender_eml = "info@example.com";
$sender_www = "www.example.com";

$sender_footer = "Geschäftsführer Rha Barber · HRB 00000 · Amtsgericht Meinestadt · USt-IdNr. DE 000 000 000<br>" .
 "Sparkasse Meinestadt · IBAN DE00 0000 0000 0000 0000 00 · BIC ABCDEF99XXX";


$orderId="RE/test/1";
$orderDate="010416-300416";

$receiver_company="Empfänger GmbH";
$receiver_name="- Buchhaltung -";
$receiver_street="Foo Straße 55b";
$receiver_postal="12345 Bar Stadt";
$receiver_country="";
$receiver_custid=777;

$items = array(
  new item(array("Admin", "DB Einrichtung, Aufwand in h", 6.5, 63.00)),
  new item(array("Beratung", "telefonische Beratung in h", 3.0, 50.00)),
);
 

$price = 0;
$subTotalPrice = 0;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bukti Pembayaran</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		page { size:A4; margin-left:auto; margin-right:auto; }
		html { height:100%; }
		body { margin-left:1.2cm; }
		table { border-collapse:collapse; border-spacing:0; border:0; width:95%; }
		th, td { padding:5px; }
		@media print { footer {page-break-after:always; } }

		.foldmark { position:absolute; background-color:black; height:1px; width:3mm; left:4mm; }
	</style>
</head>
<body> 
<div style="width:90%; height:4.1cm; background:url({{ asset('img/scart-min.png')}}) right center no-repeat;"></div>
<div style="font-size:100%; font-family:Helvetica, sans-serif; float:left; width:100%;">
	<table>
	<tr>
		<td><span style="width:60%; font-size:100%; text-decoration:underline;">
		<?php
			//nama konsumen
			echo "<strong>Donny Irianto Anggriawan</strong><br></span>";
			echo "Alamat Konsumen <br>";
			echo "Telp Konsumen <br>";
			?>
			<br><br><br>
			
		</td>
		<td style="width:40%; vertical-align:top;">
			<?php
			echo "<strong>PT SEMBILAN BINTANG LESTARI</strong><br>";
			echo "JL. MAWAR NO.6 JEMBER";
			?> 
			<table>
				<?php echo "<tr style='font-size:85%;'><td>Telp<br>E-mail</td><td>(0331) - 482892 <br>sembilanbintanglestari@gmail.com</td></tr>"; ?> 
				
			</table>
		</td>
	</tr>
	</table>

	<table>
	<tr>
		<td style="font-size: 100%; font-weight: bold;">
			<?php echo "#AR12501"; ?>
		</td>
		<td style="text-align:right; font-size: 90%;">
			<?php echo "Jember, 12 Agustus 2020"; ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="border-bottom: 1px solid #000;">
			<br>
			Konsumen: <?php echo "KO-01205"; ?><br> 			
		</td>
	</tr>
	</table>

	<table style="border:1px solid #000;">
	<tr style="border:1px solid #000; font-weight: bold;">
		<td style="width:10%; text-align:center;">No</td>
		<td style="width:45%; text-align:center;">Keterangan</td>
		<td style="width:10%; text-align:center;">Menge</td>
		<td style="width:15%; text-align:center;"></td>
		<td style="width:20%; text-align:center;">Total</td>
	</tr>
	 
	<?php foreach( $items as $item ):
		$price = $item->units * $item->unitprice;
		$subTotalPrice = $subTotalPrice + $price;
	?>
	<tr>
		<td style="text-align:center;"><?php echo 1; ?></td>
		<td><?php echo $item->description; ?></td>
		<td style="text-align:right;"><?php echo number_format($item->units); ?></td>
		<td style="text-align:right;"><?php echo number_format($item->unitprice); ?></td>
		<td style="text-align:right;"><?php echo number_format(1500000000); ?></td>
	</tr>
	<?php endforeach; ?> 
	<tr style="border:1px solid #000;">
		<td colspan="4" style="text-align:right; font-weight:bold;">Total Pembayaran</td>
		<td style="text-align:right; font-weight:bold;"><?php echo number_format(round($subTotalPrice,2) + round($subTotalPrice * $tax / 100,2)); ?></td>
	</tr>
	</table>

	<br><br><br>

	<table>
	<tr>
		<td style="font-weight:bold;"><u>Hinweise</u></td>
	</tr>
	<tr>
		<td>
			<br>
			Der Rechnungsbetrag ist zahlbar innerhalb 14 Tagen ohne Abzug.<br>
			Irrtum und Änderungen vorbehalten. Es gelten unsere AGB.<br><br><br>
			Vielen Dank für Ihren Auftrag.
		</td>
	</tr>
	</table>

	<footer style="position:fixed; bottom:5mm; left:0; font-size: 70%; font-weight: bold; text-align: center; width: 100%; vertical-align:bottom;">
		<?php echo $sender_footer; ?>
	</footer>
</div>
</body>
</html>