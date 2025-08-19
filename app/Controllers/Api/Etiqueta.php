<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Etiqueta extends ResourceController
{
    protected $modelName = 'App\Models\EtiquetaModel';
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
            return $this->failNotFound('Etiqueta not found');
        }
    }
    public function create()
    {

        if ($this->validate('etiquetas')) {
            $id = $this->model->insert([
                'titulo' => $this->request->getPost('titulo'),
                'categoria_id' => $this->request->getPost('categoria_id')
            ]);
        } else {
            return $this->respond($this->validator->getErrors(), 400);
        }

        return $this->respond($id);
    }
    public function update($id = null)
    {
        if ($this->validate('etiquetas')) {
            $this->model->update($id, [
                'titulo' => $this->request->getRawInput()['titulo'],
                'categoria_id' => $this->request->getRawInput()['categoria_id']
            ]);
        } else {

            if ($this->validator->getError('titulo')) {
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
