<?php

namespace App\Models;

use CodeIgniter\Model;
/* * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <https://codeigniter.com>
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

/**
 * CategoriaModel
 *
 * This model handles the database interactions for the 'categorias' table.
 */
class CategoriaModel extends Model
{
    protected $table = 'categorias';
    protected $returnType = 'object';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo'];
}
