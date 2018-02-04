
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('weekday', require('./components/Weekday.vue'));
Vue.component('lesson-period', require('./components/LessonPeriod.vue'));
Vue.component('appointment', require('./components/Appointment.vue'));
Vue.component('appointment-modal', require('./components/AppointmentModal.vue'));

const app = new Vue({
    el: '#app',

    data() {
        return {
            modalday: '',
            modalperiod: '',

            day: '',
            period: '',
            newAppointment: false,
            title: '',
            body: '',
            data: '',

        }
    },

    methods: {
        escapeKeyListener (evt) {
            if (evt.keyCode == 27 && this.modalOpen) {
                this.modalOpen = false;
            }
        },
        setAppointment(day, period) {
            this.modalday = day;
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
        }
    },

}
);
