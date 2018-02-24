<template>
    <div class="alert alert-danger alert-flash" role="alert" v-show="this.show">
      {{ body }}
    </div>
</template>

<script>
export default {
  props: ['message'],

  data() {
      return {
          body: this.message,
          show: false,
      }
  },

  created() {
      if (this.message) {
          this.flash(this.message);
      }

      window.events.$on('flash', message => {
          this.flash(message);
      });

  },

  methods: {
      flash(message) {
          this.body = message;
          this.show = true;
          this.hide();
      },

      hide() {
          setTimeout(() => {
              this.show = false;
          }, 3000);
      }
  }
}
</script>

<style>
    .alert-flash {
        position: fixed;
        text-align: center;
        top: 15%;
        width:100%;
        z-index: 30000;
    }
</style>
