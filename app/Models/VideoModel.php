<?php

namespace App\Models;
use CodeIgniter\Model;

class VideoModel extends Model
{
    protected $table = 'videos';

    public function getAllVideos()
    {   
        $result = $this->db->query("SELECT *
        FROM videos
        ");
        return $result->getResult();
    }

    public function cerca($ricerca)
    {   
        // Prende un prodotto per
        $sql = "SELECT *
        FROM (
            SELECT
                prodotti.*,
                oggetti.sconto,
                oggetti.id as id_oggetto,
                ROW_NUMBER() OVER (PARTITION BY prodotti.id ORDER BY oggetti.sconto DESC) AS rn
            FROM prodotti
            JOIN oggetti ON prodotti.id = oggetti.id_prodotto
            WHERE id_ordine IS NULL AND nome LIKE ?
        ) AS subquery
        WHERE rn = 1;
        ";
        $binds = ["%" . $ricerca . "%"];
        $result = $this->db->query($sql, $binds);
        return $result->getResult();
    }

    public function getVideo($value)
    {
        $result = $this->db->table('videos')->where('crumb', $value)->get();
        return $result->getResult();
    }

/*

    public function getProdottoConTuttiOggetti($value)
    {
        $sql = "SELECT *
        FROM prodotti
        INNER JOIN oggetti ON (prodotti.id = oggetti.id_prodotto)
        WHERE prodotti.id = ? AND oggetti.id_ordine IS NULL";
        $binds = [$value];

        $result = $this->db->query($sql, $binds);
        return $result->getResult();
    }

    public function getCategorie()
    {
        $sql = "SELECT * FROM categorie";
        $result = $this->db->query($sql, null);
        return $result->getResult();
    }

    public function insertNewProduct($product)
    {
        $sql = "INSERT INTO prodotti (nome, descrizione, prezzo, id_categoria, immagine, id_prodotto)
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $binds = [$product['nome'], $product['descrizione'], $product['prezzo'], $product['id_categoria'], is_null($product['immagine']) ? "noimage.jpg" : $product['immagine'], $product['id_prodotto']];
        
        $result = $this->db->query($sql, $binds);
    
        // Retrieve the last inserted ID
        $lastInsertID = $this->db->insertID();
    
        // Insert into the 'oggetti' table
        $sql = "INSERT INTO oggetti (id_prodotto) VALUES (?)";
        $binds = [$lastInsertID];
        $this->db->query($sql, $binds);
    }

    public function modifyProduct($product)
    {
        $sql = "UPDATE prodotti SET nome = ?, descrizione = ?, prezzo = ?, id_categoria = ?, id_prodotto = ? WHERE id = ?";
        
        $binds = [$product['nome'], $product['descrizione'], $product['prezzo'], $product['id_categoria'], $product['id_prodotto'], $product['id']];
        
        $this->db->query($sql, $binds);
    }
*/

}
