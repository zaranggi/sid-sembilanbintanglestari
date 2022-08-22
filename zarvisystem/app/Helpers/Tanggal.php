<?php
namespace App\Helpers;
use DateTime;

class Tanggal
{
	public static function tgl_indo($tgl)
	{
		$tanggal = substr($tgl,8,2);
		$bulan = Tanggal::namabulan(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);		return $tanggal.' '.$bulan.' '.$tahun;	}	public static function tgl_harian()
	{
		$kemarin  = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
		$date= date("Y-m-d",$kemarin);
		return $date;
	}
	public static function due_date()
	{
		$kemarin  = mktime(0, 0, 0, date("m"), date("d")+7, date("Y"));
		$date= date("Y-m-d",$kemarin);
		return $date;
	}
	public static function bulan_depan_plus($tanggal, $plus)
    {        $tgl = substr($tanggal,8,2);
        $bln = substr($tanggal,5,2);
        $thn = substr($tanggal,0,4);
        $xx	= mktime(0, 0, 0, $bln + intval($plus), $tgl, $thn);
		$xxx	= date("Y-m-d",$xx);
		return $xxx;
    }
	public static function bulan_lalu($tanggal)
    {        $tgl = substr($tanggal,8,2);
        $bln = substr($tanggal,5,2);
        $thn = substr($tanggal,0,4);
        $xx	= mktime(0, 0, 0, $bln-1, $tgl, $thn);
        $xxx	= date("Y-m-d",$xx);        return $xxx;
    }
    public static function bulan_lalu2($tanggal)
	{
		$bln = substr($tanggal,5,2);
		$thn = substr($tanggal,0,4);
		$xx	= mktime(0, 0, 0, $bln-1, '01', $thn);
		$xxx	= date("Y-m",$xx);		return $xxx;
	}
	public static function periode($tgl)
	{		$bulan = Tanggal::namabulan(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);		return $bulan.' '.$tahun;	}	public static function total_hari($tgl)
	{
        $today = date("Y-m");		if($tgl == $today)
        {
            $kemarin  = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
            $a = intval(date("d",$kemarin));
            $t_hari = [];
            for($i=1;$i<=$a;$i++)
            {
                $t_hari[]=$i;
            }
        }
        else{
            $a = date("t",strtotime($tgl));
            for($i=1;$i<=$a;$i++)
            {
                $t_hari[]=$i;
            }
        }		return $t_hari;	}	public static function jumlah_hari($tgl)
	{
		$today = date("Y-m");		if($tgl == $today)
		{
			$kemarin  = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
			$a = intval(date("d",$kemarin));
		}
		else{
			$a = date("t",strtotime($tgl));		}		return $a;	}	public static function namabulan($bln){
		switch ($bln){
					case 1:
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
			default:
				return "";
				break;
		}
	}

    public static function selisih_jam($date_1 , $date_2 , $differenceFormat = '%H:%i' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat);

    }

    public static function selisih_hari($jatuh_tempo, $differenceFormat = '%R%a' )
    {
        $tgl_lahir=new datetime(date($jatuh_tempo));
        $sekarang =new datetime (date("Y-m-d"));

        $interval = $tgl_lahir->diff($sekarang);
        $umur= $interval->format($differenceFormat);

        return $umur;

    }
    public static function selisih_hari2($tanggal1,$tanggal2, $differenceFormat = '%a' )
    {
        $tgl_lahir=new datetime(date($tanggal1));
        $sekarang =new datetime (date($tanggal2));

        $interval = $tgl_lahir->diff($sekarang);
        $umur= $interval->format($differenceFormat);

        return $umur + 1;

    }


	public static function indonesian_date ($timestamp = '', $date_format = 'l, j F Y H:i:s ') {
		if (trim ($timestamp) == '')
		{
			$timestamp = time ();
		}
		elseif (!ctype_digit ($timestamp))
		{
			$timestamp = strtotime ($timestamp);
		}
		# remove S (st,nd,rd,th) there are no such things in indonesia :p
		$date_format = preg_replace ("/S/", "", $date_format);
		$pattern = array (
			'/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
			'/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
			'/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
			'/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
			'/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
			'/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
			'/April/','/June/','/July/','/August/','/September/','/October/',
			'/November/','/December/',
		);
		$replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
			'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
			'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
			'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
			'Oktober','November','Desember',
		);
		$date = date ($date_format, $timestamp);
		$date = preg_replace ($pattern, $replace, $date);
		$date = "{$date}";
		return $date;
	}}
