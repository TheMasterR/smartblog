<div class="panel">
  <form id="uploadForm" action="upload.php" method="post">
         <div id="gallery"></div>
         <br />

         <label id="message">Please select the files you wish to upload to the gallery</label>
         <input name="files[]" type="file" id="filesToUpload" multiple />
         <input type="submit" value="Upload" id="submit" />
    </form>

    <script>
    // Run the script once the document has finnished loading
         $(document).ready(function(){
             // cache the form selector
             var $uploadForm = $('#uploadForm');
             var $files = $('#filesToUpload');

        // add event listener for click on submit
          $uploadForm.on('submit', function(e){
               e.preventDefault();
               if ($files.prop('files').length !== 0) {
                    $uploadForm.find('#submit').css('background-color', 'grey');
                    $uploadForm.find('#message').text('uploading images... please wait').css('color','blue');

                    $.ajax({
                        url: "/?page=ajax&action=upload",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        processData:false,
                        success: function(data)
                        {
                             $("#gallery").html(data);
                             $uploadForm.find('#submit').css('background-color', '#4d90f0');
                             $uploadForm.find('#message').text('Uploaded with succes!').css('color','green');

                             //alert("Image(s) Uploaded");
                        }
                    });
               } else {
                   alert('You must select atleast 1 file to upload!');
               }

          });
     });
    </script>
</div>