<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PeliculaEtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaImagenModel;

class Pelicula extends ResourceController
{
    /**
     * @var \CodeIgniter\HTTP\IncomingRequest $request
     */
    protected $modelName = 'App\Models\PeliculaModel';
    protected $format = 'json';

    public function index()
    {
        // Fetch all records from the Pelicula model
        // and return them as a JSON response
        return $this->respond($this->model->findAll());
    }
    public function paginado()
    {
        // Fetch all records from the Pelicula model
        // and return them as a JSON response
        return $this->respond($this->model->paginate(10));
    }
    public function paginado_full()
    {
        $peliculas = $this->model
            ->when($this->request->getGet('buscar'), static function ($query, $buscar) {
                $query->groupStart()->orLike('peliculas.titulo', $buscar, 'both');
                $query->orLike('peliculas.description', $buscar, 'both')->groupEnd();
            })
            ->when($this->request->getGet('categoria_id'), static function ($query, $categoriaId) {
                $query->where('peliculas.categoria_id', $categoriaId);
            })
            ->when($this->request->getGet('etiqueta_id'), static function ($query, $etiquetaId) {
                $query->where('etiquetas.id', $etiquetaId);
            })
            ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiquetas, MAX(imagenes.imagen) as imagen')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
            ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
            ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
            ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left');

        $peliculas = $peliculas->groupBy('peliculas.id')->paginate(10);
        return $this->respond($peliculas);
    }
    public function index_por_categoria($categoria_id)
    {
        $peliculas = $this->model
            ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiquetas, MAX(imagenes.imagen) as imagen')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
            ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
            ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
            ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left')
            ->where('peliculas.categoria_id', $categoria_id);
        $peliculas = $peliculas->groupBy('peliculas.id')->paginate();
        return $this->respond($peliculas);
    }

    public function index_por_etiqueta($etiqueta_id)
    {
        $peliculas = $this->model
            ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiquetas, MAX(imagenes.imagen) as imagen')
            ->join('categorias', 'categorias.id = peliculas.categoria_id')
            ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id = peliculas.id', 'left')
            ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_id', 'left')
            ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id = peliculas.id', 'left')
            ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_id', 'left')
            ->where('etiquetas.id', $etiqueta_id);
        $peliculas = $peliculas->groupBy('peliculas.id')->paginate();

        return $this->respond($peliculas);
    }
    public function show($id = null)
    {
        // Fetch a single record by ID
        $data = [
            'pelicula' => $this->model->select('peliculas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id = peliculas.categoria_id')->find($id),
            'imagenes' => $this->model->getImagesById($id),
            'etiquetas' => $this->model->getEtiquetasById($id)
        ];

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Pelicula not found');
        }
    }
    public function create()
    {
        if ($this->validate('peliculas')) {
            $id = $this->model->insert([
                'titulo' => $this->request->getPost('titulo'),
                'description' => $this->request->getPost('description'),
                'categoria_id' => $this->request->getPost('categoria_id'),
            ]);
        } else {
            return $this->respond($this->validator->getErrors(), 400);
        }

        return $this->respond($id);
    }
    public function update($id = null)
    {

        if ($this->validate('peliculas')) {
            $this->model->update($id, [
                'titulo' => $this->request->getRawInput()['titulo'],
                'description' => $this->request->getRawInput()['description'],
                'categoria_id' => $this->request->getRawInput()['categoria_id']
            ]);
        } else {

            if ($this->validator->getError('titulo')) {
                return $this->respond($this->validator->getError('titulo'), 400);
            }

            if ($this->validator->getError('description')) {
                return $this->respond($this->validator->getError('description'), 400);
            }

            //return $this->respond($this->validator->getErrors(), 400);
        }

        return $this->respond($id);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        return $this->respondDeleted('ok');
    }
    public function etiquetas_post($id)
    {
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();

        $etiquetaId = $this->request->getPost('etiqueta_id');
        $peliculaId = $id;

        $peliculaEtiqueta = $peliculaEtiquetaModel->where('etiqueta_id', $etiquetaId)
            ->where('pelicula_id', $peliculaId)
            ->first();
        if (!$peliculaEtiqueta) { // If the association does not exist, create it
            $peliculaEtiquetaModel->insert([
                'pelicula_id' => $peliculaId,
                'etiqueta_id' => $etiquetaId
            ]);
        }

        return $this->respond($id);
    }
    public function etiqueta_delete($id, $etiquetaId)
    {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta->where('etiqueta_id', $etiquetaId)
            ->where('pelicula_id', $id)->delete();

        return $this->respond('{"mensaje":"Eliminado"}');

        //return redirect()->back()->with('mensaje', 'Etiqueta eliminada');
    }
    function upload($peliculaId)
    {

        helper('filesystem');

        if ($imagefile = $this->request->getFile('imagen')) {
            // upload
            if ($imagefile->isValid()) {

                $validated = $this->validate([
                    'uploaded[imagen]',
                    'mime_in[imagen,image/jpg,image/gif,image/png]',
                    'max_size[imagen,4096]'
                ]);

                if ($validated) {
                    $imageNombre = $imagefile->getRandomName();
                    // $imageNombre = $imagefile->getName();
                    $ext = $imagefile->guessExtension();

                    // $imagefile->move(WRITEPATH . 'uploads/peliculas', $imageNombre);
                    $imagefile->move('../public/uploads/peliculas', $imageNombre);

                    $imagenModel = new ImagenModel();
                    $imagenId = $imagenModel->insert([
                        'imagen' => $imageNombre,
                        'extension' => $ext,
                        'data' => json_encode(get_file_info('../public/uploads/peliculas/' . $imageNombre))
                    ]);

                    $peliculaImagenModel = new PeliculaImagenModel();
                    $peliculaImagenModel->insert([
                        'imagen_id' => $imagenId,
                        'pelicula_id' => $peliculaId,
                    ]);
                    return $this->respond('Imagen cargada con exito');
                } else {
                    return $this->respond('La imagen es requerida 3', 400);
                }
            } else {
                return $this->respond('La imagen es requerida2', 400);
            }
        } else {
            return $this->respond('La imagen es requerida2', 400);
        }

        return $this->respond('La imagen es requerida', 400);
    }

    public function borrar_imagen($imagenId)
    {
        $imagenModel = new ImagenModel();
        $peliculaImagenModel = new PeliculaImagenModel();

        $imagen = $imagenModel->find($imagenId);

        if ($imagen == null) {
            return $this->responde('No existe la imagen');
        }

        $imageRuta = 'uploads/peliculas/' . $imagen->imagen;
        unlink($imageRuta);

        //borrar archivo
        $peliculaImagenModel->where('imagen_id', $imagenId)->delete();
        $imagenModel->delete($imagenId);


        return $this->responde('Ok');
    }
}
