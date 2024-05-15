<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\VideoModel;

class Videos extends ResourceController
{
    public function listAll()
    {
        $model = model(VideoModel::class);

        $videos = $model->getAllVideos();
        return $this->respond($videos);
    }

    public function metadata($metadata)
    {
        $model = model(VideoModel::class);

        $video = $model->getVideo($metadata);
        return $this->respond($video);
    }

    public function search()
    {
        $model = model(ProdottiModel::class);

        $data = [
            'prodotti' => $model->cerca($this->request->getGet("search")),
            'title' => 'Prodotti',
        ];

        return view('templates/header', $data)
            . view('v_list', $data)
            . view('templates/footer');
    }

    public function streamVideo($filename)
    {
        $path = FCPATH . 'videos/' . $filename;  // Path to the video

        
        if (!preg_match('/^[a-zA-Z0-9_\-]+\.(mp4|mov|webm)$/', $filename)) {
            return $this->response->setStatusCode(400, 'Invalid video file name.');
        }

        if (!file_exists($path)) {
            return $this->response->setStatusCode(404, 'Video not found');
        }

        $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $fileInfo->file($path);

        if (ob_get_level() === 0) {
            ob_start();
        }

        $this->response->setHeader('Content-Type', $mime);
        $this->response->setHeader('Content-Length', filesize($path));
        $this->response->setHeader('Content-Disposition', 'inline; filename="' . basename($filename) . '"');
        $this->response->setHeader('Accept-Ranges', 'bytes');


        $handle = fopen($path, 'rb');
        while (!feof($handle)) {
            echo fread($handle, 1024 * 8);
            ob_flush();
            flush();
            if (connection_status() != 0) {
                fclose($handle);
                exit;
            }
        }
        fclose($handle);
        ob_end_clean();
        exit;
    }

    public function details()
    {
        $model = model(VideoModel::class);

        $id = $this->request->getGet('path');

        $item = $model->getVideo($id);

        if (!is_null($item) && isset($item[0])) {
            $data = [
                'oggetti' => $item,
                'title' => $item[0]->nome,
            ];

            return view('templates/header', $data)
                . view('v_product', $data)
                . view('templates/footer');
        } else {
            return redirect()->to("/");
        }
    }
}
