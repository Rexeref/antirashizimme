<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'article';

    protected $allowedFields = ['article_crumb', 'user_id', 'content', 'created_at'];


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
        $query = $this->db->table('article')->join('comment', 'comment.article_crumb = article.crumb')->join('user', 'user.id = comment.user_id')->orderBy('comment.created_at', 'DESC')->where('article.crumb', $crumb)->get();
        return $query->getResult();
    }

    public function insertCommentInArticle($articleCrumb, $content)
    {
        $session = session();

        $userId = $session->get('userId');
        if (!empty($userId) && $content !== "") {
            $data = [
                'article_crumb' => $articleCrumb,
                'user_id'       => $userId,
                'nickname'      => $session->get('userName'),
                'content'       => $content,
                'created_at'    => date("Y-m-d H:i:s"),
            ];
    
            $this->setTable("comment");

            if ($this->insert($data)) {
                return $this->getInsertID();
            } else {
                return false;
            }
        }
    }

}