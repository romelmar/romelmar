
<form id="my-awesome-dropzone" class="dropzone" method="post" action="{{ route('doc.store') }}" enctype="multipart/form-data" >
    <div class="dropzone-previews"></div> <!-- this is were the previews should be shown. -->
    
    <!-- Now setup your input fields -->
    <input type="text" name="document_id" value="12">
  
    <button type="submit" class="addDocument">Submit data and files!</button>
</form>

@push('js')
<script>
    Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

// The configuration we've talked about above
autoProcessQueue: false,
uploadMultiple: true,
parallelUploads: 100,
maxFiles: 100,

// The setting up of the dropzone
init: function() {
  var myDropzone = this;
  
  this.on("sending", function(file, xhr, formData) {
    //   formData.append("data", "loremipsum");
      console.log(formData.entries);
    });
  // First change the button to actually tell Dropzone to process the queue.
  this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
    // Make sure that the form isn't actually being sent.
    e.preventDefault();
    e.stopPropagation();
    myDropzone.processQueue();
  });

  // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
  // of the sending event because uploadMultiple is set to true.
  this.on("sendingmultiple", function() {
    // Gets triggered when the form is actually being sent.
    // Hide the success button or the complete form.
  });
  this.on("successmultiple", function(files, response) {
    // Gets triggered when the files have successfully been sent.
    // Redirect user or notify of success.
  });
  this.on("errormultiple", function(files, response) {
    // Gets triggered when there was an error sending the files.
    // Maybe show form again, and notify user of error
  });
}

}
</script>
@endpush