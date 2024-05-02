<?php 

namespace App\Controllers;
use App\Models\ArticleModel;

class Article extends BaseController {
    public function listLast()
    {
        $model = model(ArticleModel::class);

        $data = [
            'title' => "All Articles",
            'articles' => $model->getLastArticles(),
        ];

        return view('templates/header', $data) 
        . view("lastArticles")
        . view("templates/footer");
    }

    public function search()
    {
        $model = model(ArticleModel::class);

        if(isset($_GET["search"])) {
            $data = [
                'title' => 'Cercando "' . $_GET["search"] . '"',
                'articles' => $model->searchArticle($_GET["search"]),
            ];
        }
        else {
            $data = [
                'title' => "All Articles",
                'articles' => $model->getAllArticles(),
            ];
        }

        return view('templates/header', $data) 
                . view("allArticles", $data)
                . view("templates/footer");
    }

    public function single($crumb)
    {
        $model = model(ArticleModel::class);

        $data = [
            'title' => $model->getArticle($crumb)->title,
            'article' => $model->getArticle($crumb),
            'comments' => $model->getAllCommentsFromArticle($crumb),
            'comments'
        ];

        return view('templates/header', $data) 
                . view("singleArticle", $data)
                . view("templates/footer");
    }

}