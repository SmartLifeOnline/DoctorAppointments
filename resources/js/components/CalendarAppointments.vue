<template>
    <ScheduleXCalendar :calendar-app="calendarApp">
        <template #timeGridEvent="{ calendarEvent }">
            <div class="event">
                {{ calendarEvent.title }}
            </div>
        </template>
    </ScheduleXCalendar>
</template>

<script setup>
//import { ScheduleXCalendar } from '@schedule-x/vue'
import {
    createCalendar,
    createViewDay,
    createViewMonthAgenda,
    createViewMonthGrid,
    createViewWeek,
} from '@schedule-x/calendar'
import '@schedule-x/theme-default/dist/index.css'

// Do not use a ref here, as the calendar instance is not reactive, and doing so might cause issues
// For updating events, use the events service plugin
const calendarApp = createCalendar({
    views: [
        createViewDay(),
        createViewWeek(),
        createViewMonthGrid(),
        createViewMonthAgenda(),
    ],
    events: [
        {
            id: 1,
            title: 'Event 1',
            start: '2024-11-13 09:00',
            end: '2024-11-13 10:30',
        },
        {
            id: 2,
            title: 'Event 2',
            start: '2024-11-13 12:00',
            end: '2024-11-13 13:00',
        },
        {
            id: 3,
            title: 'Freier-Termin',
            start: '2024-11-13 10:30',
            end: '2024-11-13 12:00',
        },
    ],
})
</script>

<script>
    export default {
        name: "CalendarAppointments",
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
