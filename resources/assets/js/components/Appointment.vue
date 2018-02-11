<template>
    <div class="appointment">
        <span class="appointment-title" v-text="this.title" v-on:click="toggleBody()"></span>
        <div class="appointment-body" :class="this.showBody ? '' : 'hidden'">
            {{ this.body }}
            <br>
            <small> {{ this.owner.name }} </small>
        </div>
    </div>
</template>

<script>
export default {
    props: ['title', 'body', 'owner'],
    data() {
        return {
            showBody: false,
        }
    },

    methods: {
      toggleBody() {
          this.showBody = ! this.showBody;
      }
    }
}
</script>
