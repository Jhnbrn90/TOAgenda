<template>
  <div id="app">
    
    <file-pond
        name="attachment"
        ref="pond"
        class-name="my-pond"
        label-idle="Klik (of sleep) om bestanden bij te voegen..."
        allow-multiple="true"
        :server="serverOptions"
        v-on:removefile="handleUndo"
    />
    
  </div>
</template>

<script>
// Import FilePond
import vueFilePond from "vue-filepond";

// Import plugins
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js";
import FilePondPluginImagePreview from "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js";

// Import styles
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

// Create FilePond component
const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
  FilePondPluginImagePreview
);

export default {
  name: "app",
  data: function() {
    return {
      uploadedFiles: {},

      serverOptions: {
        process: {
          url: "/api/upload",
          method: "POST",
          withCredentials: false,
          headers: {
            "X-CSRF-TOKEN": document.head.querySelector(
              'meta[name="csrf-token"]'
            ).content
          },
          onload: this.fileHasBeenUploaded,
        },

        revert: {
          url: "/api/upload/delete",
          method: "POST",
          withCredentials: false,
          headers: {
            "X-CSRF-TOKEN": document.head.querySelector(
              'meta[name="csrf-token"]'
            ).content
          },
          onload: null,
        }
      }
    };
  },

  methods: {
    handleUndo(file) {
      // get the key of the file in the uploadedFiles object
      let key = this.getKeyByValue(this.uploadedFiles, file.filename);

      // remove the item with this key from the uploadedFiles object
      axios.delete(`/api/uploads/${key}`)
      .then(response => { delete this.uploadedFiles[key]; });
    },

    fileHasBeenUploaded(response) {
        let strippedFilename = response.replace(/[\"\"]/g, "");

        let hashedFilename = strippedFilename.split(';')[0]; 
        let originalFilename = strippedFilename.split(';')[1]; 

        this.uploadedFiles[hashedFilename] = originalFilename;

        this.$nextTick(); 

        return hashedFilename; 
    },

    getKeyByValue(object, value) {
      return Object.keys(object).find(key => object[key] === value);
    },

  },

  components: {
    FilePond
  }
};
</script>
