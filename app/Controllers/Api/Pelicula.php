<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;

class Pelicula extends ResourceController
{
    protected $modelName = 'App\Models\PeliculaModel';
    protected $format = 'json';

    public function index()
    {
        // Fetch all records from the Pelicula model
        // and return them as a JSON response
        return $this->respond($this->model->findAll());
    }
    public function show($id = null)
    {
        // Fetch a single record by ID
        $data = $this->model->find($id);
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
                'description' => $this->request->getRawInput()['description']
            ]);
        } else {
            
            if($this->validator->getError('titulo')){
                return $this->respond($this->validator->getError('titulo'), 400);
            }
            
            if($this->validator->getError('description')){
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
}