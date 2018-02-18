<template>
    <div class="appointment">
        <span class="appointment-title" v-text="this.title" v-on:click="toggleBody()"></span>
        <div class="appointment-body" :class="this.showBody ? '' : 'hidden'">
            <div class="appt-body"> {{ this.body }} </div>
            <br>
            <small> {{ this.class + ' | ' + this.location + ' | ' + this.creator.name + ' | ' + this.type }} </small>
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

    }

    .appointment:last-of-type {
        box-shadow: none;
    }
</style>
