<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Ärzte
                    </div>
                    <div class="card-body">
                        <div id="app">
                            <doctors-list :doctors="doctors"></doctors-list>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import DoctorsList from "../components/DoctorsList.vue";
import type { PropType } from 'vue';

interface Doctor {
    id: number
    name: string
}

export default {
    name: "DoctorsListView",
    components: {DoctorsList},
    props: {
        doctors: Object as PropType<Doctor>
    },
    computed: {
        doctors() {
            return this.$store.getters.allItems;
        },
    },
    mounted() {
        this.$store.dispatch('fetchDoctors', 10);
    }
}
</script>

<style scoped>

</style>
