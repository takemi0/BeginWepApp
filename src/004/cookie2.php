<?php

$num = 0;
if( !isset( $_COOKIE['wellcom']) ) { 
    echo "初回訪問ありがとうございます";
} else { 
    $num = intval( $_COOKIE['wellcom']);
    echo number_format( $num + 1 ). " 回目の訪問ありがとうございます";
}

setcookie( 'wellcom', $num + 1, time() + 365 * 24 * 3600 );

echo file_get_contents('../index.html');