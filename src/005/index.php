<?php

//指定日時
$trg_date = null;
if( isset($_REQUEST['trg_date']) ) {
	$trg_date = strtotime( $_REQUEST['trg_date'] );
}

//月の日データ
$data = [ 0 =>  ['', '','','','','',''] ];

//データ作成
if( $trg_date === null ) {
	$trg_date = time();
} else {
	$trg_date = strtotime( $trg_date );
}

$begin = strtotime( date('Y-m-1', $trg_date) );
$end = strtotime( date('Y-m-t', $trg_date) );
$prev = strtotime( date('Y-m-1',$trg_date) );
$next = strtotime( date('Y-m-1',$trg_date) );
$line = 0;
for( $d = $begin; $d <= $end; $d += 24 * 3600 ) {
	$w = date( 'w', $d );
	$i = $w - 1;
	if( $i < 0 ) $i = 6;
	//echo date('Y-m-d', $d); echo " {$i} \n";
	$data[$line][$i] = date( 'd', $d );
	if( $i == 6 ) { 
		$line ++;
		$data[$line] = [ '', '', '', '', '', '', '' ];
	}
}
//print_r( $data );

$rows = [];
foreach( $data as $l ) {
	$tmp = "<tr>";
	foreach( $l as $i => $d ) {
		$class = "cl_day";
		if( !$d ) {
			$class = "cl_none";
		} else {
			if( $i == 5 ) {
				$class = "cl_sat";
			} elseif( $i == 6 ) {
				$class = "cl_sun";
			}
		}
		$tmp.= "<td class='{$class}'>";
		$tmp.= $d;
		$tmp.= "</td>";
	}
	$tmp.= "</tr>";
	$rows[] = $tmp;
}

$tmp =  file_get_contents('index.tpl');

$tmp = str_replace( '{$prev}', getPrevMonth($trg_date), $tmp );
$tmp = str_replace( '{$next}', getNextMonth($trg_date), $tmp );
$tmp = str_replace( '{$year}', date('Y',$trg_date), $tmp );
$tmp = str_replace( '{$month}', date('m',$trg_date), $tmp );
$tmp = str_replace( '{$week_date}', implode('',$rows), $tmp );

echo $tmp;
exit;

function getPrevMonth( $trg ) {
	$year = date('Y', $trg );
	$month= date('m', $trg );
	$month --;
	if( $month == 0 ) {
		$month = 12;
		$year --;
	}
	return "{$year}-{$month}-01";
}

function getNextMonth( $trg ) {
	$year = date('Y', $trg );
	$month= date('m', $trg );
	$month ++;
	if( $month > 12 ) {
		$month = 1;
		$year ++;
	}
	return "{$year}-{$month}-01";
}