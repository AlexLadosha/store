<?php
$int = 5;
$string = '5';
$string2 = "Hello {$int} man";
$array = $int;
$array = array();

// echo true;
// exit;

if('1') {
	// echo 'true';
}

$a = 'abcdefghi';

for($i = 0; $i < strlen($a); $i++) {
	echo $a[$i]."\n";
}
exit;

$a = 2;
$c = 2<5;
$b = true;
// echo $a.$b;
var_dump($c);
exit;

$data = [
	'products' => [
		2,
		3,
		0,
		5
	],
	'categories' => [
		'cars',
		'shoes',
		'shirts'
	]
];

$a = json_encode($data);

echo $a;

$b = json_decode($a);

var_dump($b);

exit;

$i=1;
while($i < 100) {

	echo $i;
	$i++;
}
exit;

$v = [ 3, 7, 6];

foreach($v as $key => $d) {
	$v[$key]++;
}
var_dump($v);


foreach($data['products'] as $key => $d) {
	$data['products'][$key]++;
}
var_dump($data['products']);
exit;


foreach($data as $key => $d) {
	echo " {$key} - > \n";
	for($i = 0; $i < count($d); $i++) {
		echo "    {$data[$key][$i]}\n";
	}
	for($i = 0; $i < count($d); $i++) {
		echo "    {$d[$i]}\n";
	}
	foreach($d as $k) {
		echo "    {$k}\n";
	}
}
exit;

for($i = 0; $i<=100 ;$i++) {
	echo $i."\n";
}

echo 'df';


exit;

// var_dump($data['categories'][0]);


function result($a, $b = 2) {
	$b = (string) $b;
	if($b === '2' ) {
		echo 'aaaa';
	}
	// return $a + $b;
}

result(4);



// echo $products;

