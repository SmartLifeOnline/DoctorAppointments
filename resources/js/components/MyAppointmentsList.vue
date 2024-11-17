<template>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Von</th>
                    <th>Bis</th>
                    <th>Arzt</th>
                    <th>Spezialisierung</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="appointment in appointments" :key="appointment.id" class="body_tr" @click="openCalendar(doctor.id)">
                    <td>{{ appointment.start_time }}</td>
                    <td>{{ appointment.end_time }}</td>
                    <td>{{ appointment.doctor_name }}</td>
                    <td>{{ appointment.specialization_name }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script lang="ts">
import type { PropType } from 'vue'

interface Appointment {
    appointment_id: number
    patient_email: string
    vorname: string
    nachname: string
    start_time: string
    end_time: string
    doctor_name: string
    specialization_name: string
}

export default {
    name: "MyAppointmentsList",
    props: {
        doctorId: Number,
    },
    computed: {
        appointments() {
            return this.$store.getters.allItems;
        },
    },
    mounted() {
        this.$store.dispatch('fetchMyAppointments', this.doctorId);
    },
}
</script>

<style scoped>
.body_tr:hover {
    cursor: pointer;
    outline: forestgreen 2px solid;
}
</style>
