<template>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        Nieuwe afspraak inplannen
                    </h4>
                </div>
                <div class="modal-body">
                    <p>
                        <strong> Datum: {{ this.day }} </strong>,
                        <strong> Lesuur: {{ this.period }}<sup>e</sup> uur. </strong>
                    </p>

                    <form :action="actionURL" method="POST">

                        <div class="form-group">
                            <label for="title">Titel: </label>
                            <input type="text" class="form-control" id="title" placeholder="Titel" v-model="title" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="body">Omschrijving: </label>
                            <textarea id="body" name="body" v-model="body" class="form-control" rows="3"
                                      placeholder="Beschijving van het practicum: proefopstelling, lesmateriaal, etc. Bij assistentie: geef ook aan om welk lesdeel het gaat (hele les, eerste deel, tweede deel)"
                                      required></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer" style="text-align: left;">
                    <button @click="newAppointment()" class="btn btn-success">Afspraak inplannen</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    props: ['day', 'period'],

    data() {
        return {
            title: '',
            body: '',
        }
    },

    methods: {
      newAppointment() {
          axios.post(this.actionURL, {
              'title': this.title,
              'body': this.body,
              'date': this.day,
              'period': this.period,
          }).then(response => {
              this.title = '';
              this.body = '';
              this.$emit('new-appointment', this.title, this.body, this.day, this.period, response.data);
          });

      }
    },

    computed: {
        actionURL() {
            return  'aanvraag/nieuw/' + this.day + '/' + this.period;
        }
    }
}
</script>