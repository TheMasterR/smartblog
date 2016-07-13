<?php

require_once 'application/init.php';

// include APP_PATH . 'classes/DBMySqlInterface.php';
// include APP_PATH . 'classes/DBMySql.php';
// include APP_PATH . 'classes/BaseObjectInterface.php';
// include APP_PATH . 'classes/baseObject.php';
// include APP_PATH . 'classes/user.php';
// include APP_PATH . 'classes/article.php';
// include APP_PATH . 'classes/comment.php';

$PATH_TO_CSV = 'public/uploads/articles.csv';

if (file_exists($PATH_TO_CSV)) {
    // parse the file, and store the array
    $results = parseCSV($PATH_TO_CSV);

    foreach ($results as $article) {
        $user = new User();
        $user->getBy('id', $article['user_id']);

        // check to see if the user_id exists in the database
        if ($user->id != NULL) {
            // echo 'user_id '.$article['user_id']. ' -> title '. $article['title'] .'<br>';
            // var_dump($user);
            // we insert the new article into the DB

            $q = new Article();
            $q->user_id = $article['user_id'];
            $q->title = $article['title'];
            $q->content = $article['content'];
            $q->media = $article['media'];
            $q->date_published = $article['date_published'];
            $q->date_created = $article['date_created'];
            $q->status = $article['status'];
            $result = $q->save();
            var_dump($q);
            var_dump($result);
            if($result == true) {
                echo 'Added with succes!<br>';
            } else {
                echo 'a fost o problema<br>';
            }



        } else {
            echo 'The user with the id ' . $article['user_id'] . ', does not exist, so I cant insert the article.';
        }




        //$user->getBy('user_id', $results[$]);
        //var_dump($user);
        //clean-up
        unset($user);
    }

    // var_dump($results);


} else {
    // tell the user we can't find the file
    echo $PATH_TO_CSV . ' -> FILE NOT FOUND!';
}


// parse the file and make an array with the data structure
function parseCSV($file) {
    $lines = explode("\n", file_get_contents($file));
    // structura cvs
    $header = ['user_id','title','media','content','date_published','date_created','status'];
    $articole = array();

    foreach ( $lines as $line ) {
    	$row = array();

    	foreach (str_getcsv($line) as $key => $field)
    		$row[$header[$key]] = $field;

    	$row = array_filter($row);
    	$articole[] = $row;
    }

    return $articole;
}