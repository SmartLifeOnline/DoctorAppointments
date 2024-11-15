<template>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Spezialisierung</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="doctor in doctors" :key="doctor.id" class="body_tr" @click="openCalendar(doctor.id)">
                    <td>{{ doctor.id }}</td>
                    <td>{{ doctor.name }}</td>
                    <td>{{ doctor.specialization }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script lang="ts">
import type { PropType } from 'vue'

interface Doctor {
    id: number
    name: string
}

export default {
    name: "DoctorsList",
    props: {
        doctors: Object as PropType<Doctor>
    },
    methods: {
        openCalendar(doctor_id) {
            window.location.href = '/' + doctor_id + '/termine';
        }
    }
}
</script>

<style scoped>
.body_tr:hover {
    cursor: pointer;
    outline: forestgreen 2px solid;
}
</style>
