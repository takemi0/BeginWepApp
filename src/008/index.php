<?php

//月の日データ
$data = [ 0 =>  ['', '','','','','',''] ];

$trg_date = null;
//URL引数のtarget_dateを取得する
if( isset( $_GET['target_date'] ) && !empty( $_GET['target_date'] ) ) {
	$trg_date = strtotime( $_GET['target_date'] );
	if( $trg_date === false || count( explode('-', $_GET['target_date']) ) < 3) {
		$trg_date = time();
	}
} else {
	$trg_date = time();
}

//データ作成
$today = [
	'y' => date('Y'),
	'm' => date('m'),
	'd' => date('d'),
];
$trg = [
	'y' => date('Y', $trg_date ),
	'm' => date('m', $trg_date ),
];
$begin = strtotime( date('Y-m-1', $trg_date) );
$end = strtotime( date('Y-m-t', $trg_date) );
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

//祝日処理
$holidays = [];
$fp = fopen( 'syukujitsu.csv', 'r' );
fgetcsv($fp);	//ヘッダー読み飛ばし
while( ($hdata = fgetcsv($fp) )!== false ) {
	if( !$hdata ) continue;
	$c_time = strtotime( $hdata[0] );
	$c_year = date('Y', $c_time );
	$c_month = date( 'm', $c_time );
	$c_day = date( 'd', $c_time );
	//処理月と異なる年付きの祝日データは読み飛ばし
	if( !($trg['y'] == $c_year && $trg['m'] == $c_month) ) continue;

	$holidays[$c_day] = $hdata[1];
}

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

		if( $trg['y'] == $today['y'] && 
			$trg['m'] == $today['m'] &&
				   $d == $today['d']
		) { 
			$class .= " cl_today";
		}

		if( !empty($holidays[$d]) ) {
			$class .= " cl_holiday";
		}

		$tmp.= "<td class='{$class}'>";
		$tmp.= $d;
		if( !empty($holidays[$d]) ) {
			$tmp.= '<br/><span>'.$holidays[$d].'</span>';
		}
		$tmp.= "</td>";
	}
	$tmp.= "</tr>";
	$rows[] = $tmp;
}

$tmp =  file_get_contents('index.tpl');

$tmp = str_replace( '{$today}', date('Y-m-d'), $tmp );
$tmp = str_replace( '{$next_month}', getNextMonth( $trg_date), $tmp );
$tmp = str_replace( '{$prev_month}', getPrevMonth( $trg_date), $tmp );

$tmp = str_replace( '{$year}', date('Y',$trg_date), $tmp );
$tmp = str_replace( '{$month}', date('m',$trg_date), $tmp );
$tmp = str_replace( '{$week_date}', implode('',$rows), $tmp );

echo $tmp;
exit;

/**
 * 前月の1日の日付文字列を取得
 *
 * @param [type] $prc_date
 * @return void
 */
function getPrevMonth( $proc_date ) {
	$year = date( 'Y', $proc_date );
	$month= date( 'm', $proc_date );
	$month --;
	if( $month < 1 ) {
		$year --;
		$month = 12;
	}
	return "{$year}-{$month}-1";
}

/**
 * 翌月の1日の日付文字列を取得
 *
 * @param [type] $proc_date
 * @return void
 */
function getNextMonth( $proc_date ) {
	$year = date( 'Y', $proc_date );
	$month= date( 'm', $proc_date );
	$month ++;
	if( $month > 12 ) {
		$year ++;
		$month = 1;
	}
	return "{$year}-{$month}-1";
}