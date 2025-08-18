<?php


namespace App\Controllers\Blog;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{
    public function index()
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        //  $db = \Config\Database::connect();
        //  $peliculaModel = $db->table('peliculas');

        $peliculas = $peliculaModel
            ->when($this->request->getGet('buscar'), static function ($query, $buscar) {
                $query->groupStart()->orLike('peliculas.titulo', $buscar, 'both');
                $query->orLike('peliculas.description', $buscar, 'both')->groupEnd();
            })
            ->when($this->request->getGet('categoria_id'), static function ($query, $categoriaId) {
                $query->where('peliculas.categoria_id', $categoriaId);
            })
            ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiquetas, MAX(imagenes.imagen) as imagen')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
            ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
            ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
            ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left');

        // if ($buscar = $this->request->getGet('buscar')) {
        //     $peliculas = $peliculas->groupStart()->orLike('peliculas.titulo', $buscar, 'both');
        //     $peliculas = $peliculas->orLike('peliculas.descripcion', $buscar, 'both')->groupEnd();
        // }
        // if ($categoriaId = $this->request->getGet('categoria_id')) {
        //     $peliculas = $peliculas->where('peliculas.categoria_id', $categoriaId);
        // }
        if ($etiqueta_id = $this->request->getGet('etiqueta_id')) {
            $peliculas = $peliculaModel->where('etiquetas.id', $etiqueta_id);
        }


        $peliculas = $peliculas->groupBy('peliculas.id')->paginate();

        $categoria_id = $this->request->getGet('categoria_id');

        // $peliculas = $peliculas->getCompiledSelect();
        // exit();
        // echo var_dump($peliculas);
        $data = [
            'peliculas' => $peliculas,
            'categorias' => $categoriaModel->findAll(),
            'etiquetas' => $categoria_id == '' ? [] : $etiquetaModel->where('categoria_id', $categoria_id)->findAll(),
            'pager' => $peliculaModel->pager,
            'categoria_id' => $categoria_id,
            'etiqueta_id' => $this->request->getGet('etiqueta_id'),
            'buscar' => $this->request->getGet('buscar')
        ];
        echo view('blog/pelicula/index', $data);
    }
    public function index_por_categoria($categoria_id)
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();

        $categoria = $categoriaModel->find($categoria_id);

        $peliculas = $peliculaModel

            ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiquetas, MAX(imagenes.imagen) as imagen')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
            ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
            ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
            ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left')
            ->where('peliculas.categoria_id', $categoria_id);
        $peliculas = $peliculas->groupBy('peliculas.id')->paginate();

        $categoria_id = $this->request->getGet('categoria_id');

        // $peliculas = $peliculas->getCompiledSelect();
        // exit();
        // echo var_dump($peliculas);
        $data = [
            'peliculas' => $peliculas,
            'categoria' => $categoria,
            'pager' => $peliculaModel->pager,
        ];
        echo view('blog/pelicula/index_por_categoria', $data);
    }
    public function index_por_etiqueta($etiqueta_id)
    {
        $peliculaModel = new PeliculaModel();
        $etiquetaModel = new EtiquetaModel();

        $etiqueta = $etiquetaModel->find($etiqueta_id);

        $peliculas = $peliculaModel

            ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiquetas, MAX(imagenes.imagen) as imagen')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
            ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
            ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
            ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left')
            ->where('etiquetas.id', $etiqueta_id);
        $peliculas = $peliculas->groupBy('peliculas.id')->paginate();

        $categoria_id = $this->request->getGet('categoria_id');

        // $peliculas = $peliculas->getCompiledSelect();
        // exit();
        // echo var_dump($peliculas);
        $data = [
            'peliculas' => $peliculas,
            'etiqueta' => $etiqueta,
            'pager' => $peliculaModel->pager,
        ];
        echo view('blog/pelicula/index_por_etiqueta', $data);
    }
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();
        $data = [
            'pelicula' => $peliculaModel->select('peliculas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id = peliculas.categoria_id')->find($id),
            'imagenes' => $peliculaModel->getImagesById($id),
            'etiquetas' => $peliculaModel->getEtiquetasById($id)
        ];
        echo view('blog/pelicula/show', $data);
    }

    //*** JSON */
    public function etiquetas_por_categoria($categoria_id)
    {
        $etiquetaModel = new EtiquetaModel();

        return json_encode($etiquetaModel->where('categoria_id', $categoria_id)->findAll());
    }
}
