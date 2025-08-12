<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;

class Etiqueta extends BaseController
{
    /**
     * Display a list of movies
     */
    public function index()
    {
        $etiquetaModel = new EtiquetaModel();
        $data = [
            'etiquetas' => $etiquetaModel->select('etiquetas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id = etiquetas.categoria_id')
                ->orderBy('etiquetas.id', 'DESC')
                ->findAll()
        ];

        echo view(
            'dashboard/etiqueta/index',
            $data
        );
    }
    public function create()
    {
        $etiquetaModel = new EtiquetaModel();

        if ($this->validate('etiquetas')) {
            $etiquetaModel->insert([
                'titulo' => $this->request->getPost('titulo'),
                'categoria_id' => $this->request->getPost('categoria_id'),
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back();
        }

        return redirect()->to('/dashboard/etiqueta')->with('message', 'Creado correctamente');
    }
    public function new()
    {
        $categoriaModel = new CategoriaModel();
        echo view('dashboard/etiqueta/new', [
            'etiqueta' => new EtiquetaModel(),
            'categorias' => $categoriaModel->find()
        ]);
    }
    /*     * Show a specific movie by ID
     *
     * @param int $id
     */
    public function show($id)
    {
        $etiquetaModel = new EtiquetaModel();

        //var_dump($peliculaModel->getImagesById($id));

        echo view(
            'dashboard/etiqueta/show',
            [
                'etiqueta' => $etiquetaModel->find($id),
            ]
        );
    }
    public function edit($id)
    {

        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        echo view(
            'dashboard/etiqueta/edit',
            [
                'etiqueta' => $etiquetaModel->find($id),
                'categorias' => $categoriaModel->find()
            ]
        );
    }
    public function update($id)
    {
        $etiquetaModel = new EtiquetaModel();
        if ($this->validate('etiquetas')) {
            $etiquetaModel->update($id, [
                'titulo' => $this->request->getPost('titulo'),
                'categoria_id' => $this->request->getPost('categoria_id'),
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);

            return redirect()->back()->withInput();
        }

        return redirect()->to('/dashboard/etiqueta')->with('message', 'Actualizado correctamente');
    }
    public function delete($id)
    {
        $etiquetaModel = new EtiquetaModel();
        $etiquetaModel->delete($id);

        return redirect()->to('/dashboard/etiqueta')->with('message', 'Eliminado correctamente');
    }
}
