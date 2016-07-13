<?php

    $uploadImage = 'public/uploads/' . basename('tmp1');

    if (move_uploaded_file($_FILES['image-upload']['tmp_name'], $uploadImage)) {
        return true;
    } else {
        return false;
    }

?>

<form action="" class="panel" method="post" enctype="multipart/form-data">
    <h1>New article</h1>

    <label for="title" class="title">Title</label>
    <input value=""
        type="title" name="title" id="title" placeholder="Article title here..." />

    <label for="tags" class="tags">Tags</label>
    <input value=""
        type="tags" name="tags" id="tags" placeholder="Some relevant tags..." />

    <label for="image-upload" class="image-upload">Image</label>
    <input type="file" name="image-upload" id="image-upload" value="Browse..." />

    <label for="article-content" class="article-content">Content</label>
    <textarea value=""
        class="new-article" name="article-content" id="article-content" placeholder="Your article content here..."></textarea>
<input type="submit" value="Add article" />
</form>


<?php
require_once 'application/init.php';




// ************************************************* \\
// *********** COMMENTS **************************** \\
// ************************************************* \\

// GET COMMENT by ID
// echo 'GET COMMENT BY ID = 1 <br>';
// $comment = new Comment();
// $comment->getBy('id', 1);
// var_dump($comment);

// GET ALL THE COMMENTS (or with filter ex: 'WHERE id < 5')
// echo 'GET ALL THE COMENTS using getAll()<br>';
// $all_comments = Comment::getAll();
// var_dump($all_comments);

// GET A COMMENT BY ID = 1, CHANGE THE CONTENT, and SAVE
// echo 'GET COMMENT BY ID=1 AND CHANGE THE CONTENT, THEN SAVE IT<br>';
// $comment = new Comment();
// $comment->getBy('id', 1);
// $comment->comment_content = "Muhahahahha - I am g0d!";
// $comment->save();
// var_dump($comment);


// CREATE A NEW COMMENT
// echo 'CREATE A NEW COMMENT AND SAVE IT<br>';
// $comment = new Comment();
// $comment->article_id = 1;
// $comment->user_id = 1;
// $comment->comment_content = "Muhahahahha - this is my new and shiny comment!";
// $comment->save();
// $result = $comment->save();

// var_dump($result);
// if($result == true) {
//     echo 'Am inserat cu succes comentariul! <br>';
// } else {
//     echo 'Nu am reusit sa inserez comentariul! <br>';
// }

// ************************************************* \\
// *********** ARTICLE ***************************** \\
// ************************************************* \\

// GET ALL ARTICLES that have STATUS=DRAFT
// echo 'GET ALL ARTICLES WITH STATUS = DRAFT <br>';
// $data = Article::getAll(" WHERE status='draft'");
// var_dump($data);

// // *** get by id
// echo 'GET ARTICLE by ID = 2 <br>';
// $article = new Article();
// $article->getBy('id', 2);
// $article->title = 'Test Article 2.1';
// $article->save();
// var_dump($article);


// ************************************************* \\
// *********** USERS ******************************* \\
// ************************************************* \\

//print all users that are admins or users
// $data = User::getAll("WHERE type='admin'");
// var_dump($data);


// *** get by id
// $user = new User();
// $user->getBy('id', 2);
// $user->name = "beni2";
// $user->save();


// *** CREATE A NEW USER AND INSERT HIM INTO THE DB
// $user2 = new User();
// $user2->name = "Pantea Lucian";
// $user2->email = "pantea.lucian@gmail.com";
// $user2->password = "parolădetest";
// $result = $user2->save();

// var_dump($result);
// if($result == true) {
//     echo 'succes';
// } else {
//     echo 'a fost o problema<br>';
// }



// var_dump($user);
// var_dump($user2);



// $db = new DBMySql();
// $db->connect();
// $data = $db->query("SELECT * FROM users");

// echo '<pre>';
// var_dump($data);
// echo '</pre>';

// echo "test";