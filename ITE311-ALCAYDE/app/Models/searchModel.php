<?php
namespace App\Models;

use CodeIgniter\Model;

class searchModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','name','email','role','status', 'created_at'];
    protected $useTimestamps = false;
}
