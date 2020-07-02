<?php

$data = file_get_contents("https://support.oneskyapp.com/hc/en-us/article_attachments/202761727/example_2.json");
$data = json_decode($data);

foreach($data->quiz->sport->q1->options as $item) {
	echo $item."\n";
}

// echo $data;
// var_dump($data);
