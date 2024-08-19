<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Cropper</title>
    <!-- Bootstrap 3 CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Croppie CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" rel="stylesheet">
    <style>
        #croppie-demo {
            width: 100%;
            height: 1cm;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Image Cropper</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <input type="file" id="upload-image" class="form-control">
        </div>
    </div>
    <div class="row">
        <div id="croppie-demo" class="col-md-6 col-md-offset-3 mt-4"></div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center mt-4">
            <button id="crop-image" class="btn btn-success">Crop and Save</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center mt-4">
            <img id="cropped-result" class="img-responsive" alt="Cropped Image">
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap 3 JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Croppie JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

<script>
    $(document).ready(function () {
        var croppieInstance;

        // Initialize Croppie
        $('#upload-image').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                if (croppieInstance) {
                    croppieInstance.destroy();
                }
                croppieInstance = $('#croppie-demo').croppie({
                    viewport: {width: 300, height: 300, type: 'square'},
                    boundary: {width: 400, height: 400},
                    url: e.target.result
                });
            };
            reader.readAsDataURL(this.files[0]);
        });

        // Handle Crop and Save
        $('#crop-image').on('click', function () {
            croppieInstance.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (croppedImage) {
                // Display the cropped image
                $('#cropped-result').attr('src', croppedImage);

                // Send the cropped image data to the server via AJAX
                $.ajax({
                    url: 'save_image.php',
                    type: 'POST',
                    data: {image: croppedImage},
                    success: function (response) {
                        alert('Image saved successfully!');
                    },
                    error: function () {
                        alert('An error occurred while saving the image.');
                    }
                });
            });
        });
    });
</script>
</body>
</html>
