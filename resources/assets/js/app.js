window.Vue = require("vue");
require("./bootstrap");
window.moment = require("moment");

Vue.component("flash", require("./components/Flash.vue"));
Vue.component("weekday", require("./components/Weekday.vue"));
Vue.component("lesson-period", require("./components/LessonPeriod.vue"));
Vue.component("appointment", require("./components/Appointment.vue"));
Vue.component(
  "my-appointments-button",
  require("./components/MyAppointmentsButton.vue")
);
Vue.component(
  "appointment-modal",
  require("./components/AppointmentModal.vue")
);
Vue.component("appt", require("./components/Appt.vue"));
Vue.component("nav-buttons", require("./components/NavButtons.vue"));

const app = new Vue({
  el: "#app",

  data() {
    return {
      startDate: "now",
      moment: moment,
      appointments: [],
      days: [],
      modalday: "",
      modalperiod: "",
      search: "",
      filter: false
    };
  },

  mounted() {
    let appointmentApi = "/api/appointments/" + this.startDate;

    if (this.filter) {
      appointmentApi = "/api/appointments/filter/" + this.startDate;
    }

    axios
      .get(appointmentApi)
      .then(response => (this.appointments = response.data));
    axios
      .get("/api/weekdays/" + this.startDate)
      .then(response => (this.days = response.data));
  },

  watch: {
    startDate: function(date) {
      let appointmentApi = "/api/appointments/" + this.startDate;

      if (this.filter) {
        appointmentApi = "/api/appointments/filter/" + this.startDate;
      }

      axios
        .get(appointmentApi)
        .then(response => (this.appointments = response.data));
      axios
        .get("/api/weekdays/" + this.startDate)
        .then(response => (this.days = response.data));
    },

    filter: function(date) {
      let appointmentApi = "/api/appointments/" + this.startDate;

      if (this.filter) {
        appointmentApi = "/api/appointments/filter/" + this.startDate;
      }

      axios
        .get(appointmentApi)
        .then(response => (this.appointments = response.data));
      axios
        .get("/api/weekdays/" + this.startDate)
        .then(response => (this.days = response.data));
    }
  },

  methods: {
    escapeKeyListener(evt) {
      if (evt.keyCode == 27 && this.modalOpen) {
        this.modalOpen = false;
      }
    },

    setAppointment(date, period) {
      this.modalday = date;
      this.modalperiod = period;
    },

    onNewAppointment() {
      $("#myModal").modal("hide");
      axios
        .get("/api/appointments/" + this.startDate)
        .then(response => (this.appointments = response.data));
    },

    switchDate(date) {
      this.startDate = date;
    },

    toggleFilter() {
      this.filter = !this.filter;
    }
  }
});
