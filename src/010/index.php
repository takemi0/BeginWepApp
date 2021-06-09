<?php
require_once __DIR__.'/../libs/001/views.php';
require_once __DIR__.'/../libs/001/calendar.php';

/**
 * 処理を関数化して整理
 */

//処理日を取得する
$trg_date = GetTargetDate();

//今日の日付
$today = [
	'y' => date('Y'),
	'm' => date('m'),
	'd' => date('d'),
];
//処理対象年月
$trg = [
	'y' => date('Y', $trg_date ),
	'm' => date('m', $trg_date ),
];

//月の日データ
$data = MakeCalendarData( $trg_date );

//祝日処理
$holidays = GetHolidayData( $trg );

$rows = MakeCalendarHtml( $today, $data, $trg, $holidays );

echo MakeView( 'index.tpl', $trg_date, $rows );
exit;

//-------------------------------------------------------------
//以下、関数定義
//-------------------------------------------------------------

/**
 * Get変数から処理日を算出する
 * @return int
 */
function GetTargetDate(){
	//処理日を取得する
	$trg_date = null;
	//URL引数のtarget_dateを取得する
	if( isset( $_GET['target_date'] ) && !empty( $_GET['target_date'] ) ) {
		$trg_date = strtotime( $_GET['target_date'] );
		if( $trg_date === false || count( explode('-', $_GET['target_date']) ) < 2) {
			$trg_date = time();
		}
	} else {
		$trg_date = time();
	}
	return $trg_date;
}

/**
 * カレンダーのHTMLデータを生成する
 *
 * @param int $today
 * @param array $data
 * @param array $trg
 * @param array $holidays
 * @return array
 */
function MakeCalendarHtml( $today, $data, $trg, $holidays ){
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
	return $rows;
}