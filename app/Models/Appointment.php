<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $table = 'appointments';

    protected $fillable = ['doctor_id', 'patient_name', 'patient_email', 'date_time', 'status_id', 'time_slot_id', 'active'];

    protected $casts = ['date_time' => 'datetime'];

    public static function findActive($appointmentId, $getColumns = null)
    {
        $query = self::where('active', 1)->where('id', $appointmentId);

        if($getColumns) {
            return $query->first($getColumns);
        }

        return $query->first();
    }

    public static function getActive($getColumns = null)
    {
        $query = self::where('active', 1)->orderBy('patient_name', 'DESC');

        if($getColumns) {
            return $query->get($getColumns);
        }

        return $query->get();
    }

    public function getRequestSuccessfulArray(int $appointmentId)
    {
        if(!$appointmentId) {
            return [];
        }

        $appointment = self::findActive($appointmentId);

        if(!$appointment) {
            return [];
        }

        $appointments = Appointment::where('active', 1)->where('patient_email', $appointment->patient_email)->with('timeSlot')->get();

        $timeSlotsArray = [];

        foreach($appointments as $appointment)
        {
            $timeSlotsArray[] = [
                'id' => $appointment->id,
                'start_time' => $appointment->timeSlot->start_time->format('d.m.Y H:i'),
                'end_time' => $appointment->timeSlot->end_time->format('d.m.Y H:i')
            ];
        }

        return $timeSlotsArray;
    }

    public function doctor()
    {
        return $this->hasOne('App\Models\Doctor', 'id', 'doctor_id')->where('active', 1);
    }

    public function timeSlot()
    {
        return $this->hasOne('App\Models\TimeSlot', 'id', 'time_slot_id')->where('active', 1);
    }

    public function getStatusLabel()
    {
        return match ($this->status_id) {
            1 => 'Angefragt',
            2 => 'Gebucht',
            3 => 'Wahrgenommen',
            4 => 'Nicht Wahrgenommen',
            5 => 'Storniert',
        };
    }
}
