
require('./bootstrap');


window.Vue = require('vue');

Vue.component('weekday', require('./components/Weekday.vue'));
Vue.component('lesson-period', require('./components/LessonPeriod.vue'));
Vue.component('appointment', require('./components/Appointment.vue'));
Vue.component('appointment-modal', require('./components/AppointmentModal.vue'));
Vue.component('appt', require('./components/Appt.vue'));


const app = new Vue({
    el: '#app',

    data() {
        return {
            appointments: '',
            weekdays: '',

            modalday: '',
            modalperiod: '',

            day: '',
            period: '',
            newAppointment: false,
            title: '',
            body: '',
            data: '',

            days: ''


        }
    },

    mounted() {
      axios.get('/api/appointments').then(response => this.appointments = response.data);
      axios.get('/api/weekdays').then(response => this.days = response.data);
    },

    methods: {
        escapeKeyListener (evt) {
            if (evt.keyCode == 27 && this.modalOpen) {
                this.modalOpen = false;
            }
        },

        setAppointment(date, period) {
            this.modalday = date;
            this.modalperiod = period;
        },

        onNewAppointment(title, body, day, period, data) {
            $('#myModal').modal('hide');
            this.newAppointment = true;
            this.title = title;
            this.body = body;
            this.day = day;
            this.period = period;
            this.data = data;
            axios.get('/api/appointments').then(response => this.appointments = response.data);
        }
    },

}
);
