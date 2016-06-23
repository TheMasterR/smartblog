<?php

// check to see if file exists, then load it
// if (file_exists('articles.csv')) {
//     $file = file('articles.csv');
//     $header = ['user_id','title', 'media', 'content', 'date_created', 'date_published', 'status'];


//     // loop every row
//     foreach($file as $row) {
//         $cvs[]=str_getcsv($row, ',', '"'); // and split the values into an array
//     }

//     var_dump($cvs);

// } else {
//     echo 'can`t load the file dude!';
// }



// varianta cu associative array
$lines = explode("\n", file_get_contents('articles.csv'));
// structura cvs
$header = ['user_id','title','media','content','date_created','date_published','status'];
$articole = array();

foreach ( $lines as $line ) {
	$row = array();

	foreach (str_getcsv($line) as $key => $field)
		$row[$header[$key]] = $field;

	$row = array_filter($row);
	$articole[] = $row;
}

var_dump($articole);

foreach ($articole as $articol) {
	echo $articol['date_published'].'<br>';
	echo date("Y-m-d H:i:s", strtotime($articol['date_published'])) . '<br>';
}