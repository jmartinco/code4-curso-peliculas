<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{
    /**
     * Display a list of movies
     */
    public function index()
    {
        $peliculaModel = new PeliculaModel();

        echo view(
            'dashboard/pelicula/index',
            ['peliculas' => $peliculaModel->findAll()]
        );
    }
    public function create()
    {
        $peliculaModel = new PeliculaModel();

        if ($this->validate('peliculas')) {
            $peliculaModel->insert([
                'titulo' => $this->request->getPost('titulo'),
                'description' => $this->request->getPost('description'),
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            return redirect()->back();
        }

        return redirect()->to('/dashboard/pelicula')->with('message', 'Creado correctamente');
    }
    public function new()
    {
        echo view('dashboard/pelicula/new', [
            'pelicula' => new PeliculaModel()
        ]);
    }
    /*     * Show a specific movie by ID
     *
     * @param int $id
     */
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();

        echo view(
            'dashboard/pelicula/show',
            ['pelicula' => $peliculaModel->find($id)]
        );
    }
    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();
        echo view(
            'dashboard/pelicula/edit',
            ['pelicula' => $peliculaModel->find($id)]
        );
    }
    public function update($id)
    {
        $peliculaModel = new PeliculaModel();
        if ($this->validate('peliculas')) {
            $peliculaModel->update($id, [
                'titulo' => $this->request->getPost('titulo'),
                'description' => $this->request->getPost('description'),
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            return redirect()->back()->withInput();
        }

        return redirect()->to('/dashboard/pelicula')->with('message', 'Actualizado correctamente');
    }
    public function delete($id)
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);
        return redirect()->to('/dashboard/pelicula')->with('message', 'Eliminado correctamente');
    }
}
