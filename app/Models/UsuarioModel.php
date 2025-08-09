<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['usuario', 'email', 'contrasena'];

    public function contrasenaHash($contrasenaHash)
    {
        // Hash the password using bcrypt
        return password_hash($contrasenaHash, PASSWORD_DEFAULT);
    }

    public function contrasenaVerify($contrasena, $contrasenaHash)
    {
        // Verify the password against the hash
        return password_verify($contrasena, $contrasenaHash);
    }
}
