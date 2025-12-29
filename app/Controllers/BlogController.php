<?php

namespace App\Controllers;
use App\Models\BlogPostsModels;
class BlogController extends BaseController{
    public function index(): string{
        $model = new BlogPostsModels();
        $data = $model->orderBy("id", "desc")->findAll();

        return view('app/blogs.php', ["data" => $data]);
    }
    public function createBlog(): string{
        return view('app/blog_create.php');
    }
    public function saveArticle(){
        helper('upload_helper'); // Asegúrate de cargar tu helper personalizado

        $model = new BlogPostsModels();
        $data = $this->request->getPost();

        // Validación básica
        if (empty($data['title']) || empty($data['slug']) || empty($data['content'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Faltan campos obligatorios: título, slug o contenido'
            ])->setStatusCode(400);
        }

        // Procesar imagen destacada (featured_image)
        $uploadedImageName = null;
        $featuredImage = $this->request->getFile('featured_image');

        if ($featuredImage && $featuredImage->isValid() && !$featuredImage->hasMoved()) {
            $savedImages = save_uploaded_images(
                ['featured_image' => $featuredImage], // <-- este es el parámetro $files
                'img/article',                     // ruta destino
                ['jpg', 'jpeg', 'png', 'gif'],        // tipos permitidos
                true,                                // convertir a WebP
                false                                 // mantener original
            );

            $uploadedImageName = $savedImages["success"][0];
        }

        $insertData = [
            'title' => trim($data['title']),
            'slug' => trim($data['slug']),
            'summary' => trim($data['summary']),
            'content' => trim($data['content']),
            'featured_image' => $uploadedImageName ?? '', // aquí se guarda el nombre de la imagen
            'status' => 1,
            'blog_post_category_id' => $data['category'] ?? null,
        ];

        if ($model->insert($insertData)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Artículo guardado correctamente',
                'id' => $model->getInsertID()
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No se pudo guardar el artículo',
                'errors' => $model->errors()
            ])->setStatusCode(500);
        }

    }
    public function showAll(){

    }
    public function showArticle($slug){
        $model = new BlogPostsModels();
        $article = $model->where('slug', $slug)->first();

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Artículo no encontrado.");
        }

        return view('page/article.php', ['article' => $article]);
    }
}
