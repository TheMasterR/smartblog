<?php

class ArticleController extends BaseController
{
    public function index()
    {
        // Check and see if the id is set, if not, set it to null
        $id = isset($this->params['id']) ? $this->params['id'] : null;
        $error = null;

        // check to see if the id is set and if the id exists in the DB
        if (isset($this->params['id']))
        {
            $article = new Article();
            $user = new User();

            // verify if the id returns data, otherwise, go to 404
            if ($article->read('id', $id) !== false)
            {
                $user->read('id', $article->user_id);
                 // grab all the comments
                $comments = Comment::getAll(' WHERE article_id='.$article->id.' ORDER BY date_published ASC');
                $nrOfComments = count($comments);

                // loop fro the comments, and add the User_Name to the array
                foreach ($comments as $key => $comment)
                {
                    $user = new User($comment['user_id']);
                    $comments[$key]['username'] = $user->name;
                }
            }
        }

        // if it is post save the comment!
        if (isPost() && User::isLogged())
        {
            if (empty($this->params['add-comment']))
            {
                $error = 'The comment can`t be empty!';
            }

            // if no error, insert the article
            if (!$error)
            {
                $comment = new Comment();
                $comment->article_id = $article->id;
                $comment->comment_content = $this->params['add-comment'];
                $comment->date_published = date("Y-m-d H:i:s");
                $comment->user_id = $_SESSION['loggedUserId'];
                $comment->save();
                redirect('/index.php?page=article&id='.$article->id.'#comments'); // redirect the user to the article that he created
            }

        }

        // verify that the article id exists
        if ($article->id && $article->isPublished())
        {
            $this->output['article'] = $article;
            $this->output['user'] = $user;
            $this->output['error'] = $error;
            $this->output['comments'] = $comments;

            //check and see the nr of comments and return the number if any or NO if no comments exist.
            if ($nrOfComments === 0)
            {
                $this->output['nrOfComments'] = 'No';
            } else
            {
                $this->output['nrOfComments'] = $nrOfComments;
            }

            $this->output['templatePath'] = APP_PATH . 'templates/article.php';
        } else
        {
            $this->output['templatePath'] = APP_PATH . 'templates/components/not-found.php';
        }
    }

    // ADD AN ARTICLE
    public function add()
    {
        $error = false;
        // check to see if the user is logged in
        if (!User::isLogged())
        {
            redirect('/index.php');
        }

        // get the users and user_ID

        if (isPost())
        {
            if (empty($this->params['title']))
            {
                $error = 'Insert title!';
            } elseif (empty($this->params['article-content']))
            {
                $error = 'Insert article content';
            }

            // if no error, insert the article
            if (!$error)
            {
                $article = new Article();
                $article->user_id = User::getLogged()->id; // getLogged returneaza un obiect
                $article->title = $this->params['title'];
                $article->content = $this->params['article-content'];
                $article->media = '1';
                $article->date_published = date("Y-m-d");
                $article->date_created = date("Y-m-d H:i:s");
                if ($this->params['status'] === 'published')
                {
                    $article->status = 'published';
                } else
                {
                    $article->status = 'draft';
                }
                $article->save();
                $article->savePicture(); // upload the picture too
                if ($this->params['status'] === 'published')
                {
                    redirect('/index.php?page=article&id='.$article->id); // redirect the user to the article that he created
                } else
                {
                    redirect('/index.php?page=article&action=myArticles'); // redirect the user to the articles page
                }
            }

        }

        $this->output['templatePath'] = APP_PATH . 'templates/new-article.php';
        $this->output['newArticleError'] = $error;
        $this->output['post'] = $this->params;
    }

    // EDIT AN ARTICLE
    public function edit()
    {
        $error = false;
        $a = array();

        if (isset($this->params['id']))
        {
            $a = new Article();
            $a->read('id',$this->params['id']);

            // if the article with the ID requested does not exist, throw 404
            if ($a === false)
            {
                $this->output['templatePath'] = APP_PATH . 'templates/not-found.php';
            }
        }

        // check to see what user is logged in
        if ($a->user_id === User::getLogged()->id)
        {
            $this->output['post'] = $this->params;
            $this->output['article'] = $a;
        } else
        {
            redirect('/index.php?page=article&id='.$this->params['id']);
        }


        if (isPost())
        {
            if (empty($this->params['title']))
            {
                $error = 'Insert title!';
            } elseif (empty($this->params['article-content']))
            {
                $error = 'Insert article content';
            } elseif (empty($this->params['id']))
            {
                $error = 'No id selected';
            }

            // if no error, insert the article
            if (!$error)
            {
                $articleId = $this->params['id'];
                $a = new Article();
                $a->read('id',$articleId);
                $a->id = $articleId;
                $a->title = $this->params['title'];
                $a->content = $this->params['article-content'];
                if ($this->params['status'] === 'published')
                {
                    $a->status = 'published';
                } else
                {
                    $a->status = 'draft';
                }

                $result = $a->save();
                $a->savePicture(); // upload the picture too

                if ($this->params['status'] === 'published')
                {
                    redirect('/index.php?page=article&id='.$this->params['id']); // redirect the user to the article that he created
                } else
                {
                    redirect('/index.php?page=article&action=myArticles'); // redirect the user to the articles page
                }
            }
        }
        $this->output['templatePath'] = APP_PATH . 'templates/edit-article.php';
        $this->output['newArticleError'] = $error;
    }

    public function myArticles()
    {
        // GET ALL ARTICLES, PUBLISHED OR UNPUBLISHED, by the logged user, and allow EDIT or REMOVE
        if (!User::isLogged())
        {
            redirect('/index.php');
        }

        // paginare
        $p = isset($this->params['p']) ? $this->params['p'] : 1;
        // set how many articles per page to load
        $articlePerPage = 6;
        $limitStart = ($p-1)*$articlePerPage;
        // compute total pages, from all published articles
        $totalArticles = count(Article::getAll(' WHERE user_id=' . User::getLogged()->id)); // se poate implementa cu count din sql - sa nu umplem aiurea memoria
        $totalPages = ceil($totalArticles / $articlePerPage);

        $articles = Article::getAll( ' WHERE user_id=' . User::getLogged()->id. ' ORDER BY date_created DESC ' . " LIMIT {$limitStart},{$articlePerPage}");

        $this->output['articles'] = $articles;
        $this->output['templatePath'] = APP_PATH . 'templates/myArticles.php';
        $this->output['p'] = $p; // trimitem p in vars
        $this->output['totalPages'] = intval($totalPages); // convert to int
        $this->output['totalArticles'] = intval($totalArticles); // convert to int
    }

    // REMOVE ARTICLE
    public function remove()
    {
        $error = false;
        $a = array();

        if (isset($this->params['id']))
        {
            $a = new Article();
            $a->read('id',$this->params['id']);
        }

        // check to see what user is logged in
        if ($a->user_id === User::getLogged()->id)
        {
            if($a->remove())
            {
                $a->deletePicture();
                Comment::removeArticleComments($a->id);
                $error = 'The article with the id=' . $a->id . ' was successfully removed!';
            } else
            {
                $error = 'Something went wrong!';
            }
        } else
        {
            redirect('/index.php?page=article&id='.$this->params['id']);
        }

        $this->output['templatePath'] = APP_PATH . 'templates/remove-article.php';
        $this->output['message-succes'] = $error;
    }


}// END OF CLASS
