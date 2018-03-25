<template>
  <button :class="classes" v-on:click="toggleFilter">Mijn afspraken</button>
</template>

<script>
export default {
  data() {
    return {
      filter: false
    };
  },

  methods: {
    toggleFilter() {
      this.filter = !this.filter;
      this.$emit("toggle-filter");
    }
  },

  computed: {
    classes() {
      if (this.filter) {
        return "btn btn-success";
      }
      return "btn btn-info";
    }
  }
};
</script>

