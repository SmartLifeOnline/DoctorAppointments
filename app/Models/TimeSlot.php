<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $table = 'time_slots';

    protected $fillable = ['doctor_id', 'start_time', 'end_time', 'is_available', 'appointment_id', 'active'];

    protected $casts = ['start_time' => 'datetime', 'end_time' => 'datetime'];

    public static function findActive(int $timeSlotId, array|null $getColumns = null)
    {
        $query = self::where('active', 1)->where('id', $timeSlotId);

        if($getColumns) {
            return $query->first($getColumns);
        }

        return $query->first();
    }

    public static function findActiveAndAvailable(int $timeSlotId, array|null $getColumns = null)
    {
        $query = self::where('active', 1)->where('id', $timeSlotId)->where('is_available', 1);

        if($getColumns) {
            return $query->first($getColumns);
        }

        return $query->first();
    }

    public static function getActive(array|null $getColumns = null)
    {
        $query = self::where('active', 1);

        if($getColumns) {
            return $query->get($getColumns);
        }

        return $query->get();
    }

    public static function getActiveByDoctor(int $doctorId, array|null $getColumns = null)
    {
        $query = self::where('active', 1)->where('doctor_id', $doctorId);

        if($getColumns) {
            return $query->get($getColumns);
        }

        return $query->get();
    }

    public static function getNewDateArray(int $doctorId)
    {
        $timeSlots = self::where('active', 1)->where('doctor_id', $doctorId)->where('is_available', 1)->with('appointment')->get();

        $timeSlotsArray = [];

        foreach($timeSlots as $timeSlot)
        {
            $timeSlotsArray[] = [
                'id' => $timeSlot->id,
                'start_time' => $timeSlot->start_time->format('d.m.Y H:i'),
            ];
        }

        return $timeSlotsArray;
    }

    public function doctor()
    {
        return $this->hasOne('App\Models\Doctor', 'id', 'doctor_id')->where('active', 1);
    }

    public function appointment()
    {
        return $this->hasOne('App\Models\Appointment', 'id', 'appointment_id')->where('active', 1);
    }
}
