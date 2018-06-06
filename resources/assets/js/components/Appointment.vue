<template>
    <div class="appointment">
        <button class="btn btn-link appointment-title" :class="this.accepted ? 'accepted' : 'waiting' " v-text="this.title" v-on:click="toggleBody()"></button>
        <div class="appointment-body" :class="this.showBody ? '' : 'hidden'">
            <div class="appt-body"> {{ this.body }} </div>
            <br>

            <div class="appointment-info">
                <u>{{ this.type }}</u> <br>
                {{ this.class }} | {{ this.subject }} | {{ this.location }} <br>
                {{ this.creator.name }}
            </div>
            <br>
            <div v-if="attachments" class="appointment-info">
              <u>Bijlage(n):</u> <br />
              <a :href="linkTo(attachment)" v-for="(attachment,index) in attachments" :key="index">
                # {{ index + 1 }} (download)
              </a>
            </div>
            <div class="appointment-delete" v-if="canDelete">
                <button class="btn btn-link btn-danger" @click="deleteAppointment()">Verwijderen</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  props: ["appointment", "past"],

  data() {
    return {
      showBody: false,
      title: this.appointment.title,
      accepted: this.appointment.accepted,
      body: this.appointment.body,
      creator: this.appointment.creator,
      class: this.appointment.class,
      location: this.appointment.location,
      type: this.appointment.type,
      subject: this.appointment.subject,
      attachments: JSON.parse(this.appointment.attachments),
    };
  },

  computed: {
    canDelete() {
      return window.App.user.id == this.appointment.user_id && !this.past;
    },
  },

  methods: {
    toggleBody() {
      this.showBody = !this.showBody;
    },

    deleteAppointment() {
      if (confirm("Weet je het zeker?")) {
        axios.delete(`/aanvraag/${this.appointment.id}`);

        $(this.$el).fadeOut(300, () => {
          flash("De afspraak is verwijderd.");
        });
      }
    },

    linkTo(attachment) {
      return `https://s3.eu-west-3.amazonaws.com/toagenda/uploads/${attachment}`;
    }
  }
};
</script>

<style>
.accepted {
  color: black;
}

.waiting {
  color: lightgrey;
}

.appointment {
  box-shadow: 0px 24px 3px -24px black;
  margin-bottom: 12px;
  padding-bottom: 6px;
}

.appointment:last-of-type {
  box-shadow: none;
}

.appointment-delete > button {
  color: darkred;
}
.appointment-delete > button:hover {
  color: red;
}
</style>
