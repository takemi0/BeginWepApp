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