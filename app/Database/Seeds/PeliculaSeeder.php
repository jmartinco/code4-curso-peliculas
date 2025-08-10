<?php

namespace App\Database\Seeds;

use App\Models\PeliculaModel;
use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        
        //$this->db->table('Categorias');
        $peliculaModel = new PeliculaModel();
        $peliculaModel->truncate();
        for ($i=0; $i < 5 ; $i++) {
            $peliculaModel->insert(
                [
                    'titulo' => "Pelicula $i",
                    'description' => "Descripcion de la pelicula $i",
                ]
            );
        }

    }
}
