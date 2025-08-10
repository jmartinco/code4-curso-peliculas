<?php
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;

class Categoria extends ResourceController
{
    protected $modelName = 'App\Models\CategoriaModel';
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
            return $this->failNotFound('Categoria not found');
        }
    }
    public function create()
    {

         if ($this->validate('categorias')) {
            $id = $this->model->insert([
                'titulo' => $this->request->getPost('titulo')
            ]);
        } else {
            return $this->respond($this->validator->getErrors(), 400);
        }

        return $this->respond($id);
    }
    public function update($id = null)
    {
        if ($this->validate('categorias')) {
            $this->model->update($id, [
                'titulo' => $this->request->getRawInput()['titulo']
            ]);
        } else {
            
            if($this->validator->getError('titulo')){
                return $this->respond($this->validator->getError('titulo'), 400);
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