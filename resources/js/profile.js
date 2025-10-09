
document.getElementById("fileupload").addEventListener("change", function(event) {
  var file = event.target.files[0];
  var reader = new FileReader();

  reader.onload = function(e) {
    document.getElementById("upload-img").src = e.target.result;
  };

  reader.readAsDataURL(file);
  console.log(event);
});
