<template>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Spezialisierung</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="appointment in appointments" :key="appointment.id" class="body_tr" @click="openCalendar(doctor.id)">
                    <td>{{ appointment.start_time }}</td>
                    <td>{{ appointment.end_time }}</td>
                    <td>{{ appointment.doctor_name }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script lang="ts">
import type { PropType } from 'vue'

interface Appointment {
    title: string
    author: string
    year: number
}

export default {
    name: "MyAppointmentsList",
    props: {
        appointments: Object as PropType<Appointment>,
    },
}
</script>

<style scoped>
.body_tr:hover {
    cursor: pointer;
    outline: forestgreen 2px solid;
}
</style>
