<?php

class AjaxController extends BaseController {

    public function getDate() {
        $now = new DateTime('now');
        $data = new stdclass();
        $data->date = $now->format('c');
        echo json_encode($now);
        echo $now->format('c');
    }

    public function getArticles() {
        echo 'My test string';
    }

  public function getComments() {
        $comments = Comment::getAll(' WHERE article_id=1 ORDER BY date_published ASC');

        $data = array();
        foreach ($comments as $key => $comment) {
            $data[$key]['id'] = $comment['id'];
            //$data[$key]['userId'] = $comment['user_id'];
            $user = new User($comment['user_id']);
            $data[$key]['userName'] = $user->name;
            $data[$key]['userImage'] = './public/img/thumb.png';
            $data[$key]['comment_content'] = $comment['comment_content'];
            $data[$key]['date_published'] = $comment['date_published'];
        }

        echo json_encode($data, JSON_NUMERIC_CHECK);
    }

    // public function getComments() {
    //     $id = htmlspecialchars($this->params['id']);
    //     $comments_arr = Comment::getAll("WHERE article_id='$id'");

    //     //adding username,userimage
    //     foreach($comments_arr as $key=>$comment) {
    //         //$user_obj will hold the record data for user_id from comment arary
    //         if ($comment['user_id'] !=0 ){
    //             $user_obj = new User($comment['user_id']);
    //             $comments_arr[$key]['userName'] = $user_obj->name;
    //             $comments_arr[$key]['userImage'] = $user_obj->picture;
    //         } else {
    //             $comments_arr[$key]['userName'] = 'Anonim';
    //             $comments_arr[$key]['userImage'] = '/public/img/default_avatar.jpg';
    //         }

    //     }


    //     echo $this->output = json_encode($comments_arr);
    // }

    // public function getComments() {
    //     $comments = Comment::getAll(' WHERE article_id=1 ORDER BY date_published ASC');

    //     $data = array();
    //     foreach ($comments as $key => $comment) {
    //         $data[$key]['id'] = $comment['id'];
    //         $data[$key]['articleId'] = $comment['article_id'];
    //         $data[$key]['userId'] = $comment['user_id'];
    //         $user = new User($comment['user_id']);
    //         $data[$key]['userName'] = $user->name;
    //         $data[$key]['userImage'] = './public/img/thumb.png';
    //         $data[$key]['commentContent'] = $comment['comment_content'];
    //         $data[$key]['datePosted'] = $comment['date_published'];
    //     }

    //     echo json_encode($data, JSON_NUMERIC_CHECK);
    // }

    public function saveComment() {

        $commentBody = isset($_POST['commentBody']) ? $_POST['commentBody'] : null;
        $articleId = isset($_POST['articleId']) ? $_POST['articleId'] : null;


        $loggedUser = User::getLogged();

        //$comment = new Comment();
        //$comment->date_despre_user...

        sleep(2);

        echo json_encode(array('success'=>true, 'commentId'=>12));
    }

    public function deleteComment() {

        $commentId = isset($_POST['commentId']) ? $_POST['commentId'] : null;

        if (!$commentId) {
            echo json_encode(array('success'=>false));
        }

        // intarizere intentionata!!
        sleep(2);

        //$comment = new Comment($commentId);
        //$comment->delete();

        echo json_encode(array('success'=>true));
    }

    public function upload() {
        if (!User::isLogged()){
            deg('you are not logged in, so you can\'t upload!');
            return false;
        }
        $output = '';
        if(is_array($_FILES))
        {
          foreach ($_FILES['files']['name'] as $name => $value)
          {
              $file_name = explode(".", $_FILES['files']['name'][$name]);
              $allowed_ext = array("jpg", "jpeg", "png", "gif");
              if(in_array($file_name[1], $allowed_ext))
              {
                    $new_name = md5(rand()) . '.' . $file_name[1];
                    $sourcePath = $_FILES['files']['tmp_name'][$name];
                    $targetPath = "public/uploads/gallery/".$new_name;
                    if(move_uploaded_file($sourcePath, $targetPath))
                    {
                         $output .= '<img src="'.$targetPath.'" width="340px" />&nbsp';
                    }
              }
          }
          echo $output;
        }
    }

    public function getGallery() {
        // set the gallery directory
        $gallery_dir = 'public/uploads/gallery/';
        // scan the directory and remove the structure
        $scanned_directory = array_diff(scandir($gallery_dir), array('..', '.'));
        // define our return array of random images
        $random_images = array();

        // check to see if we have enough images to shuffle them, and top out @ 10 images
        if (count($scanned_directory) < 10) {
            $rand_images = array_rand($scanned_directory, count($scanned_directory));
        } else {
            $rand_images = array_rand($scanned_directory, 10);
        }

        // loop the random values and assign them with full path to our return array
        foreach ($rand_images as $value) {
            array_push($random_images, $gallery_dir . $scanned_directory[$value]);
        }

        // return the JSON with our images with full path
        echo json_encode($random_images);

    }

}