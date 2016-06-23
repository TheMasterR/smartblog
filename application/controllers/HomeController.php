<?php

class HomeController extends BaseController
{
    public function index()
    {
        // aici o sa luam articolele

        // paginare
        $p = isset($this->params['p']) ? $this->params['p'] : 1;

        // set how many articles per page to load
        $articlePerPage = 5;
        $limitStart = ($p-1)*$articlePerPage;

        // compute total pages, from all published articles
        $totalArticles = count(Article::getAll("WHERE status='published'")); // se poate implementa cu count din sql - sa nu umplem aiurea memoria
        $totalPages = ceil($totalArticles / $articlePerPage);

        // get all the articles per page
        $articles = Article::getAll(
        "WHERE status='published' ORDER by date_created ASC
         LIMIT {$limitStart},{$articlePerPage}
        "
        );

        // loop the articles array and add the user name, then the nr. of comments
        foreach ($articles as $key => $article)
        {
            $user = new User($article['user_id']);
            $articles[$key]['username'] = $user->name;
        }

        foreach ($articles as $key => $article)
        {
            $comments = Comment::getAll('WHERE article_id='.$article['id']);
            $articles[$key]['numberOfComments'] = count($comments);
        }

        $this->output['articles'] = $articles;
        $this->output['p'] = $p; // trimitem p in vars
        $this->output['totalPages'] = intval($totalPages); // convert to int
        $this->output['templatePath'] = APP_PATH . 'templates/home.php';

    }
} // END OF CLASS
