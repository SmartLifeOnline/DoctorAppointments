<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{//specializations
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $table = 'specializations';

    protected $fillable = ['name', 'active'];

    public static function findActive($specializationId, $getColumns = null)
    {
        $query = self::where('active', 1)->where('id', $specializationId);

        if($getColumns) {
            return $query->first($getColumns);
        }

        return $query->first();
    }

    public static function getActive($getColumns = null)
    {
        $query = self::where('active', 1)->orderBy('name', 'DESC');

        if($getColumns) {
            return $query->get($getColumns);
        }

        return $query->get();
    }
}
