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

                    <form 
                        :action="actionURL" 
                        method="POST" 
                        @submit.prevent="newAppointment()" 
                        enctype="multipart/form-data" 
                        autocomplete="off"
                    >

                        <div class="form-group">
                            <label for="title">Titel: </label>
                            <input type="text" class="form-control" id="title" placeholder="Titel" v-model="form.title" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="body">Omschrijving: </label>
                            <textarea id="body" name="body" v-model="form.body" class="form-control" rows="3"
                                      placeholder="Beschijving van het practicum: proefopstelling, lesmateriaal, etc. Bij assistentie: geef ook aan om welk lesdeel het gaat (hele les, eerste deel, tweede deel)"
                                      required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="location">Bijlage(n): </label>
                            <file-uploader />
                        </div>


                        <div class="form-group">
                            <label for="klas">Klas: </label>
                            <input type="text" class="form-control" id="class" name="class" placeholder="3HD" v-model="form.class" required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Vak: </label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Natuurkunde, Scheikunde, etc." v-model="form.subject" required>
                        </div>

                        <div class="form-group">
                            <label for="location">Locatie: </label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="B0-1" v-model="form.place" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="type"><strong>Type: </strong></label>
                            <select class="form-control" id="type" name="type" v-model="form.tasktype" required>
                                <option selected>Kies een optie</option>
                                <option value="voorbereiding">Voorbereiden</option>
                                <option value="assistentie">Assisteren</option>
                                <option value="anders">Anders</option>
                            </select>
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
  props: ["day", "period"],

  data() {
    return {
      form: {}
    };
  },

  methods: {
    newAppointment() {
      axios
        .post(
          this.actionURL,
          {
            title: this.form.title,
            body: this.form.body,
            class: this.form.class,
            subject: this.form.subject,
            location: this.form.place,
            type: this.form.tasktype,
            date: this.day,
            period: this.period
          },
          { headers: { "Content-Type": "multipart/form-data" } }
        )
        .then(response => {
          this.form = {};
          this.$emit("new-appointment");
        })
        .catch(error => flash("Niet alle velden zijn juist ingevuld."));
    },

  },

  computed: {
    actionURL() {
      return "aanvraag/nieuw/" + this.day + "/" + this.period;
    }
  }
};
</script>
