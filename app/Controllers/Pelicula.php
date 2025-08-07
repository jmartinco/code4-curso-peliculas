<?php

namespace App\Controllers;

use App\Models\PeliculaModel;

class Pelicula extends BaseController
{
    public function index()
    {
        $peliculaModel = new PeliculaModel();

        echo view(
            'index',
            ['peliculas' => $peliculaModel->findAll()]
        );
    }
    public function create()
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->insert([
            'titulo' => $this->request->getPost('titulo'),
            'description' => $this->request->getPost('description'),
        ]);
        echo 'Creado correctamente';
    }
    public function new()
    {
        echo view('pelicula/new', ['pelicula' => [
            'titulo' => '',
            'description' => ''
        ]]);
    }
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();

        echo view(
            'pelicula/show',
            ['pelicula' => $peliculaModel->find($id)]
        );
    }
    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();
        echo view(
            'pelicula/edit',
            ['pelicula' => $peliculaModel->find($id)]
        );
    }
    public function update($id)
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->update($id, [
            'titulo' => $this->request->getPost('titulo'),
            'description' => $this->request->getPost('description'),
        ]);
        echo 'Actualizado correctamente';
    }
    public function delete($id)
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);
        echo 'Eliminado correctamente';
    }
}
