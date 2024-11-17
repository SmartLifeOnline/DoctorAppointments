import { createStore } from 'vuex';
import axios from 'axios';

interface State {
    items: any[];
}

export default createStore<State>({
    state: {
        items: [],
    },
    mutations: {
        setDoctors(state, items: any[]) {
            state.items = items;
        },
        setTimeSlots(state, items: any[]) {
            state.items = items;
        },
        setAppointments(state, items: any[]) {
            state.items = items;
        },
        setMyAppointments(state, items: any[]) {
            state.items = items;
        },
        addAppointment(state, item: any) {
            state.items.push(item);
        },
    },
    actions: {
        async fetchDoctors({ commit }) {
            try {
                const response = await axios.get('/api/get_doctors');
                commit('setDoctors', response.data);
            } catch (error) {
                console.error('Request Fehler:', error);
            }
        },
        async fetchTimeSlots({ commit }, doctorId) {
            console.log(doctorId);
            try {
                const response = await axios.get('/api/' + doctorId + '/get_time_slots');
                commit('setTimeSlots', response.data);
            } catch (error) {
                console.error('Request Fehler:', error);
            }
        },
        async fetchMyAppointments({ commit }, doctorId) {
            try {
                const response = await axios.get('/api/' + doctorId + '/get_my_appointments');
                commit('setMyAppointments', response.data);
            } catch (error) {
                console.error('Request Fehler:', error);
            }
        },
        async addAppointment({ commit }, {doctorId, appointment}) {
            try {
                const response = await axios.post('/api/' + doctorId + '/new_time_slots', appointment);
                commit('addAppointment', response.data);
            } catch (error) {
                console.error('Request Fehler:', error);
            }
        },
    },
    getters: {
        allItems: (state) => state.items,
    },
});
