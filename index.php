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
        #preview-area {
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
        <div id="preview-area" class="col-md-6 col-md-offset-3 mt-4"></div>
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
    /**
     * Initializes the Croppie image cropper and handles image upload, cropping, and displaying the cropped result.
     */
    $(document).ready(function () {
        var croppieInstance;

        /**
         * Initializes the Croppie instance when an image is uploaded.
         * 
         * @param {Event} event - The change event triggered when an image file is selected.
         */
        $('#upload-image').on('change', function (event) {
            var reader = new FileReader();
            reader.onload = function (e) {
                if (croppieInstance) {
                    croppieInstance.destroy();
                }
                croppieInstance = $('#preview-area').croppie({
                    viewport: {width: 200, height: 100, type: 'triangle'},
                    boundary: {width: 400, height: 400},
                    url: e.target.result
                });
            };
            reader.readAsDataURL(this.files[0]);
        });

        /**
         * Handles the cropping of the image and displays the cropped result.
         * 
         * @param {Event} event - The click event triggered when the crop button is clicked.
         */

        $('#crop-image').on('click', function (event) {
            croppieInstance.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (croppedImage) {
                $('#cropped-result').attr('src', croppedImage);
                // Optionally, you can send `croppedImage` to the server via AJAX
            });
        });
    });
</script>

</body>
</html>
