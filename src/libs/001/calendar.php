<?php

/**
 * 前月の1日の日付文字列を取得
 *
 * @param int $prc_date
 * @return string
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
 * @param int $proc_date
 * @return string
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

/**
 * カレンダーのデータを生成する
 * @return array
 */
function MakeCalendarData( $trg_date ){
	//月の日データ
	$data = [ 0 =>  ['', '','','','','',''] ];

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
	return $data;
}