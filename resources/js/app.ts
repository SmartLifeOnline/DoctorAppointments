import 'bootstrap/dist/css/bootstrap.min.css';

import { createApp } from 'vue';
import router from './router';
import store from './store';
import App from './App.vue';

const app = createApp(App).use(router).use(store).mount('#app');

/*import DoctorsList from "./components/DoctorsList.vue";
import NewAppointment from './components/NewAppointment.vue';
import CalendarAppointments from './components/CalendarAppointments.vue';

app.component('doctors-list', DoctorsList);
app.component('new-appointment', NewAppointment);
app.component('calendar-appointments', CalendarAppointments);

app.mount('#app');*/
