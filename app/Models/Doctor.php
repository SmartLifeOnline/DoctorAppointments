<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $table = 'doctors';

    protected $fillable = ['name', 'specialization_id', 'active'];

    public static function findActive($doctorId, $getColumns = null)
    {
        $query = self::where('active', 1)->where('id', $doctorId);

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

    public static function getDoctorsListArray($getColumns = null)
    {
        $doctors = self::where('active', 1)->orderBy('name', 'DESC')->with('specialization')->get();

        $doctorsArray = [];

        foreach($doctors as $doctor)
        {
            $doctorsArray[] = [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'specialization' => ($doctor->specialization->name ?? ''),
            ];
        }

        return $doctorsArray;
    }

    public function specialization()
    {
        return $this->hasOne('App\Models\Specialization', 'id', 'specialization_id')->where('active', 1);
    }
}
