<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-sanitize.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
<script src="/assets/js/jquery_validator/extend.js?v=1.1.0"></script>
<script src="/assets/js/jquery_validator/messages-ar.js?v=1.1.0"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
toastr.options.closeButton = true;
toastr.options.progressBar = true;
toastr.options.positionClass = "toast-bottom-left";
toastr.options.timeOut = 5000;
toastr.options.preventDuplicates = true;
</script>


<link rel="stylesheet" href="../assets/css/app.css">
<script href="/assets/js/custom_functions.js?v=1.0.0"></script>
<script src="../assets/js/storage.js?v=1.0.0"></script>
<!-- <script href="/assets/js/storage.js?v=1.0.0"></script> -->
<script>
// const storage = new storage();
// const userdata = storage.get('userdata');
const retailer = JSON.parse(localStorage.getItem('retailerData'));
if (!retailer) location.replace('./login.php');
</script>