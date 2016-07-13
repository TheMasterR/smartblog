<?php
class AjaxController extends BaseController {
    public function getDate() {
        $now = new DateTime('now');
        $data = new stdclass();
        $data->date = $now->format('c');
        echo json_encode($now);
        echo $now->format('c');
    }
    public function isLogged() {
        echo User::isLogged();
    }
    public function getComments() {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $comments = Comment::getAll(' WHERE article_id='.$_GET['id'].' ORDER BY date_published ASC');

            $data = array();
            foreach ($comments as $key => $comment) {
                $data[$key]['id'] = $comment['id'];
                //$data[$key]['userId'] = $comment['user_id'];

                if($comment['user_id'] == 0) {
                    $data[$key]['userName'] = 'Anonymous';
                    $data[$key]['userId'] = -1;
                } else {
                    $user = new User($comment['user_id']);
                    $data[$key]['userName'] = $user->name;
                    $data[$key]['userId'] = $user->id;
                }
                $data[$key]['userImage'] = './public/img/thumb.png';
                $data[$key]['comment_content'] = $comment['comment_content'];
                $data[$key]['date_published'] = $comment['date_published'];
            }

            echo json_encode($data, JSON_NUMERIC_CHECK);
        }
    }
    public function saveComment() {
        // TO DO:

        $data = $_POST;
        $getTheId;
        $data += ['date_published' => date('Y-m-d H:i:s')];

        $loggedUser = User::getLogged();

        $comment = new Comment();

        $comment->id = isset ($_POST['id']) ? intval($_POST['id']) : null;
        $comment->comment_content = isset($_POST['comment_content']) ? htmlspecialchars($_POST['comment_content']) : null;
        $comment->article_id = isset($_POST['articleId']) ? intval($_POST['articleId']) : null;
        $comment->date_published = date('Y-m-d H:i:s');

        //if no logged user, set id=0, for anonimous users
        $comment->user_id = isset($loggedUser->id) ? $loggedUser->id : 0;

        if ($comment->comment_content !== '' && $comment->article_id !== null){
            $getTheId = $comment->save();
            $data += ['id' => $getTheId];
        } else  {
            echo json_encode(array('success'=>false));
            return false;
        }



        if ($loggedUser) {
            echo json_encode($data);
        } else {
            $data['userName'] = 'Anonymous';
            $data['userImage'] = './public/img/thumb.png';
            echo json_encode($data);
        }
    }
    public function updateComment() {
        // TO DO:

        $data = $_POST;
        $data += ['date_published' => date('Y-m-d H:i:s')];

        $loggedUser = User::getLogged();

        $comment = new Comment(intval($_POST['id']));
        $comment->comment_content = htmlspecialchars($_POST['comment_content']);
        $comment->date_published = date('Y-m-d H:i:s');

        $comment->save();

        echo json_encode(array('success'=>true));
        // echo json_encode($data);
    }
    public function deleteComment() {
        // TO DO:
        // make sure to check if the logged user is allowed to delete the comment
        if (isset($_GET['id'])) {
            $commentId = intval($_GET['id']);

            $comment = new Comment($commentId);
            $comment->remove();
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('success'=>false));
        }
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