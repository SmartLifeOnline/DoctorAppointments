<template>
    <div class="row">
        <div class="col-md-6">
            <label>Termin</label>
            <select v-model="time_slot_id" name="time_slot_id" class="form-control">
                <option value="0">Bitte Termin auswählen</option>
                <option v-for="timeSlot in timeSlots" :key="timeSlot.id" :value="timeSlot.id">{{ timeSlot.start_time }}</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>E-Mail-Adresse</label>
            <input v-model="patient_email" name="patient_email" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <label>Vorname</label>
            <input v-model="vorname" name="vorname" class="form-control">
        </div>
        <div class="col-md-6">
            <label>Nachname</label>
            <input v-model="nachname" name="nachname" class="form-control">
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-large btn-primary" style="float: right;" @click="submit">Termin anfragen</button>
        </div>
    </div>
</template>

<script lang="ts">
import type { PropType } from 'vue'
import axios from "axios";

interface TimeSlot {
    title: string
    author: string
    year: number
}

export default {
    name: "NewDate",
    data() {
        return {
            time_slot_id: 0 as Number,
            patient_email: '' as String,
            vorname: '' as String,
            nachname: '' as String,
        }
    },
    props: {
        doctorId: Number,
        timeSlots: Object as PropType<TimeSlot>,
    },
    methods: {
        submit() {
            axios.post('/' + this.doctorId + '/termine', {
                time_slot_id: this.time_slot_id,
                patient_email: this.patient_email,
                vorname: this.vorname,
                nachname: this.nachname,
            }).then((res) => {
                window.location.href = '/';
            }).catch((error) => {
                switch(error.response.data.error) {
                    case 'appointment_not_found':
                        alert('Ihr Termin konnte nicht gefunden werden.');
                        return;
                    case 'doctor_not_found':
                        alert('Der Doktor konnte nicht gefunden werden.');
                        return;
                    case 'no_time_slot_not_available':
                        alert('Es ist kein Termin in diesem Zeitraum verfügbar.');
                        return;
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
