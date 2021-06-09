<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>サンプルアプリ：カレンダー</title>
	<link rel="stylesheet" href="/css/index.css">
	<link rel="stylesheet" href="/css/calender.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/bootstrap_4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	 <!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  </head>
  <body>
		<div class="flex-center position-ref full-height">
			<div class="top-right links">
				カレンダーアプリ<br/>
				Version: 1.0.3
			</div>

			<div class="content">
				<div class="title m-b-md">
					カレンダーアプリ
				</div>
				<div class="m-b-md">
					<div class="calender">
					<table class="calender">
						<tr>
							<th colspan="2" style="text-align: center;"><a href="?target_date={$prev_month}">前月</a></th>
							<th colspan="3" style="text-align: center;">
								{$year}年 {$month}月<br/>
								<a href="?target_date={$today}">今日</a>
							</th>
							<th colspan="2" style="text-align: center;"><a href="?target_date={$next_month}">翌月</a></th>
						</tr>
						<tr>
							<th class="cl_head">月</th>
							<th class="cl_head">火</th>
							<th class="cl_head">水</th>
							<th class="cl_head">木</th>
							<th class="cl_head">金</th>
							<th class="cl_head">土</th>
							<th class="cl_head">日</th>
						</tr>
						{$week_date}
					</table>
					</div>
				</div>
			</div>
			<div class="footer">
				&copy; 健巳 (Takemi)
				<a target="_blank" href="https://twitter.com/takemi77505234"><img src="../img/twitter_icon-icons.com_62765.png" width="16"></a>&nbsp;
				<a target="_blank" href="https://www.youtube.com/channel/UC46jNr1HHtM_eVTRKUpoiRA/"><img src="../img/social_youtube_2756.png" width="16"></a> 
			</div>
		</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="/bootstrap_4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>