<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'article';

    public function getLastArticles()
    {
        $query = $this->db->table('article')
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();

        return $query->getResult();
    }

    public function getArticle($crumb)
    {
        $result = $this->db->table('article')
            ->select('*')
            ->where('article.crumb', $crumb)
            ->get();

        return $result->getFirstRow();
    }
    

    public function getAllArticles()
    {
        $query = $this->db->table('article')->orderBy('created_at', 'DESC')->get();
        return $query->getResult();
    }

    public function searchArticle($ricerca)
    {
        $sql = "SELECT * FROM article WHERE title LIKE ? ORDER BY created_at DESC";
        $binds = ["%" . $ricerca . "%"];
        $result = $this->db->query($sql, $binds);
        return $result->getResult();
    }

    public function getAllCommentsFromArticle($crumb)
    {
        $query = $this->db->table('article')->join('comment', 'comment.article_crumb = article.crumb')->join('user', 'user.id = comment.user_id')->orderBy('comment.created_at', 'DESC')->get();
        return $query->getResult();
    }

}