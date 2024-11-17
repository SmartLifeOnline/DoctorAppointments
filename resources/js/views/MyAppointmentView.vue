<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Meine Termine
                    </div>
                    <div class="card-body">
                        <div id="app">
                            <my-appointments-list :doctorId="$route.params.doctor_id"></my-appointments-list>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import MyAppointmentsList from "../components/MyAppointmentsList.vue";

export default {
    name: "MyAppointmentView",
    components: {MyAppointmentsList},
}
</script>

<style scoped>

</style>
