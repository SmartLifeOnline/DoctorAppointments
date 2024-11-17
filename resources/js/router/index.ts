import { createRouter, createWebHistory } from 'vue-router';

import DoctorsListView from '../views/DoctorsListView.vue';
import NewAppointmentView from '../views/NewAppointmentView.vue';
import MyAppointmentView from '../views/MyAppointmentView.vue';

const routes = [
    {
        path: '/',
        name: 'DoctorsListView',
        component: DoctorsListView,
    },
    {
        path: '/:doctor_id/termine',
        name: 'NewAppointmentView',
        component: NewAppointmentView,
    },
    {
        path: '/:doctor_id/meine-termine',
        name: 'MyAppointmentView',
        component: MyAppointmentView,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
