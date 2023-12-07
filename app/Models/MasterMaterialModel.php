<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMaterialModel extends Model
{
    use HasFactory;
    protected $table = 'master_material';
    protected $fillable = [
        'material_code',
        'material_description',
        'uom',
        'batch',
        'plant'
    ];
}
