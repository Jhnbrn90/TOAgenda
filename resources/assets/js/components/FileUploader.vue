<template>
  <div id="app">
    
    <file-pond
        name="attachment"
        ref="pond"
        class-name="my-pond"
        label-idle="Klik (of sleep) om bestanden bij te voegen..."
        allow-multiple="true"
        :server="serverOptions"
        v-bind:files="myFiles"
        v-on:init="handleFilePondInit"
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
      myFiles: null,
      uploadedFiles: [],
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
          onload: this.onLoadFile,
        },

        revert: {
          url: "/api/upload",
          method: "DELETE",
          withCredentials: false,
          headers: {
            "X-CSRF-TOKEN": document.head.querySelector(
              'meta[name="csrf-token"]'
            ).content
          },
          onload: this.removeFile,
        }
      }
    };
  },
  methods: {
    handleFilePondInit: function() {
    //   console.log("FilePond has initialized");

    //   // example of instance method call on pond reference
    //   this.getFiles = this.$refs.pond.getFiles();
    },

    handleUndo(file) {
      console.log(file);
      const index = this.uploadedFiles.indexOf(file.filename);
      this.uploadedFiles.splice(index, 1);
      console.log(this.uploadedFiles);
    },

    onLoadFile(response) {
      // Todo: Write the following logic (work needs to be done in FileController)
        // Get a respond from the server with the original filename and the randomly generated one:
        // favicon.ico;ajsndkajsn29 
        // Then separate them into an assoc. array
        // ['favicon.ico' => 'ajsndkajsn29']

        const filename = response.replace(/[\"\"]/g, "")
        this.uploadedFiles.push(filename);
        this.$nextTick(); 

    },

    removeFile(response) {
        // TODO: Write out this function
        console.log(response);
    }
  },

  components: {
    FilePond
  }
};
</script>
