<template>
<div class="container" style="margin:auto; text-align: center">
    <div class="calendar-navigation">
        <button class="btn btn-default" @click="navigateTo(prevDate)">  &lt;&lt; Vorige </button>
        <button class="btn btn-link" @click="navigateTo('now')"> <h4> Huidige Week </h4> </button>
        <button class="btn btn-default" @click="navigateTo(nextDate)"> Volgende &gt;&gt; </button>
    </div>
    </div>
</template>

<script>
export default {
  props: ["date"],

  computed: {
    nextDate: function() {
      return window
        .moment(this.date, "DD-MM-YYYY")
        .add(7, "d")
        .format("DD-MM-YYYY");
    },

    prevDate: function() {
      return window
        .moment(this.date, "DD-MM-YYYY")
        .subtract(7, "d")
        .format("DD-MM-YYYY");
    }
  },

  methods: {
    navigateTo(date) {
      this.$emit("nav-to-date", date);
    }
  }
};
</script>


