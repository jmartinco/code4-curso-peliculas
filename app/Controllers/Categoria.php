<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categoria extends BaseController
{
    public function index()
    {

        $categoriaModel = new CategoriaModel();
        echo view('categoria/index', ['categorias' => $categoriaModel->findAll()]);
    }

    public function create()
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->insert([
            'titulo' => $this->request->getPost('titulo')
        ]);
        echo 'Creado correctamente';
    }

    public function new()
    {
        echo view('categoria/new', ['categoria' => [
            'titulo' => ''
        ]]);
    }

    public function show($id)
    {
        $categoriaModel = new CategoriaModel();

        echo view(
            'categoria/show',
            ['categoria' => $categoriaModel->find($id)]
        );
    }

    public function edit($id)
    {
        $categoriaModel = new CategoriaModel();
        echo view(
            'categoria/edit',
            ['categoria' => $categoriaModel->find($id)]
        );
    }

    public function update($id)
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->update($id, [
            'titulo' => $this->request->getPost('titulo')
        ]);
        echo 'Actualizado correctamente';
    }

    public function delete($id)
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->delete($id);
        echo 'Eliminado correctamente';
    }
}
