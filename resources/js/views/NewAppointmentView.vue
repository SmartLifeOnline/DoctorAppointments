<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Termineanfrage
                    </div>
                    <div class="card-body">
                        <div id="app">
                            <new-appointment :doctorId="$route.params.doctor_id"></new-appointment>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import NewAppointment from "../components/NewAppointment.vue";

export default {
    name: "NewAppointmentView",
    components: {NewAppointment},
}
</script>

<style scoped>

</style>
