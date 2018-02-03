
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

const app = new Vue({
    el: '#app',

    data() {
        return {
            modalOpen: false,
            day: '',
            period: '',
        }
    },

    methods: {
        escapeKeyListener (evt) {
            if (evt.keyCode == 27 && this.modalOpen) {
                this.modalOpen = false;
            }
        },
        openModal(day, period) {
            this.day = day;
            this.period = period;
            this.modalOpen = true;
        }
    },

    watch: {
        modalOpen: function() {
            var className = 'modal-open';
            if (this.modalOpen) {
                document.body.classList.add(className);
            } else {
                document.body.classList.remove(className);
            }
        }
    },

    created: function() {
        document.addEventListener('keyup', this.escapeKeyListener);
    },

    destroyed: function() {
        document.removeEventListener('keyup', this.escapeKeyListener);
    }

}
);
