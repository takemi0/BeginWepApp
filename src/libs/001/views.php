<?php
/**
 * テンプレートファイルに値を置換した文字列を生成する
 * @param string 	$tpl
 * @param int 		$trg_date
 * @param array 	$rows
 * @return string
 */
function MakeView( $tpl, $trg_date, $rows  ) {
	$tmp =  file_get_contents($tpl);

	$tmp = str_replace( '{$today}', date('Y-m-d'), $tmp );
	$tmp = str_replace( '{$next_month}', getNextMonth( $trg_date), $tmp );
	$tmp = str_replace( '{$prev_month}', getPrevMonth( $trg_date), $tmp );

	$tmp = str_replace( '{$year}', date('Y',$trg_date), $tmp );
	$tmp = str_replace( '{$month}', date('m',$trg_date), $tmp );
	$tmp = str_replace( '{$week_date}', implode('',$rows), $tmp );

	return $tmp;
}