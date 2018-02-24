<template>
    <div class="appointment">
        <span class="appointment-title" v-text="this.title" v-on:click="toggleBody()"></span>
        <div class="appointment-body" :class="this.showBody ? '' : 'hidden'">
            <div class="appt-body"> {{ this.body }} </div>
            <br>

            <div class="appointment-info">
                <u>{{this.type}}</u> <br>
                {{ this.class }} | {{ this.subject }} | {{ this.location }} <br>
                {{ this.creator.name }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['appointment'],
    data() {
        return {
            showBody: false,
            title: this.appointment.title,
            body: this.appointment.body,
            creator: this.appointment.creator,
            class: this.appointment.class,
            location: this.appointment.location,
            type: this.appointment.type,
            subject: this.appointment.subject,
        }
    },

    methods: {
      toggleBody() {
          this.showBody = ! this.showBody;
      }
    }
}
</script>

<style>
    .appointment {
        box-shadow: 0px 24px 3px -24px black;
        margin-bottom: 12px;
        padding-bottom: 6px;
    }

    .appointment:last-of-type {
        box-shadow: none;
    }
</style>
