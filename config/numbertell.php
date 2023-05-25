<?php
function numbertell($x){
$abil = array(
	"",
	"Satu", "Dua", "Tiga",
	"Empat", "Lima", "Enam",
	"Tujuh", "Delapan", "Sembilan",
	"Sepuluh", "Sebelas"
	);
	if ($x < 12)
	return " ".$abil[$x];
elseif ($x<20)
	return numbertell($x-10)." Belas";
elseif ($x<100)
	return numbertell($x/10)." Puluh".numbertell($x%10);
elseif ($x<200)
	return " Seratus".numbertell($x-100);
elseif ($x<1000)
	return numbertell($x/100)." Ratus".numbertell($x % 100);
elseif ($x<2000)
	return " Seribu".numbertell($x-1000);
elseif ($x<1000000)
	return numbertell($x/1000)." Ribu".numbertell($x%1000);
elseif ($x<1000000000)
	return numbertell($x/1000000)." Juta".numbertell($x%1000000);
elseif ($x<1000000000000)
	return numbertell($x/1000000000)." Milyar".numbertell($x%1000000000);
elseif ($x<1000000000000000)
	return numbertell($x/1000000000000)." Trilyun".numbertell($x%1000000000000);
}
?>