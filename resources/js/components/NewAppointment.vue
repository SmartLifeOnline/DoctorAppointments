<template>
    <div class="row">
        <div class="col-md-6">
            <label>Termin</label>
            <select v-model="appointment.time_slot_id" name="time_slot_id" class="form-control">
                <option value="0">Bitte Termin auswählen</option>
                <option v-for="timeSlot in timeSlots" :key="timeSlot.id" :value="timeSlot.id">{{ timeSlot.start_time }}</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>E-Mail-Adresse</label>
            <input v-model="appointment.patient_email" name="patient_email" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <label>Vorname</label>
            <input v-model="appointment.vorname" name="vorname" class="form-control">
        </div>
        <div class="col-md-6">
            <label>Nachname</label>
            <input v-model="appointment.nachname" name="nachname" class="form-control">
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

interface TimeSlot {
    time_slot_id: number
    patient_email: string
    vorname: string
    nachname: string
}

export default {
    name: "NewAppointment",
    data() {
        return {
            appointment: {
                time_slot_id: 0 as Number,
                patient_email: '' as String,
                vorname: '' as String,
                nachname: '' as String,
            } as TimeSlot
        }
    },
    props: {
        doctorId: Number,
    },
    computed: {
      timeSlots() {
          return this.$store.getters.allItems;
      },
    },
    methods: {
        submit() {
            this.$store.dispatch('addAppointment', {
                appointment: this.appointment,
                doctorId: this.doctorId,
            }).then((res) => {
                this.$router.push({ name: 'MyAppointmentView' })
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

            /*axios.post('/' + this.doctorId + '/termine', {
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
            });*/
        }
    },
    mounted() {
        this.$store.dispatch('fetchTimeSlots', this.doctorId);
    },
}
</script>

<style scoped>

</style>
