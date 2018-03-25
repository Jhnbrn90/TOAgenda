<template>
  <div class="panel panel-default period">
            <div class="panel-body">
                <h3 class="appointment-time">
                    {{ this.time }}<sup>e</sup> uur
                </h3>

                <slot>
                </slot>
                <button class="btn btn-link"
                        @click.prevent="setAppointment"
                        data-toggle="modal" data-target="#myModal" v-show="! this.past"> Inplannen</button>
            </div>
        </div>
</template>

<script>
export default {
  props: ["time", "date", "past"],

  methods: {
    setAppointment() {
      this.$emit("set-date", this.date, this.time);
    }
  }
};
</script>

