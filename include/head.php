<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />


<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-sanitize.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
<!-- <script src="/assets/js/jquery_validator/extend.js?v=1.1.0"></script> -->
<!-- <script src="/assets/js/jquery_validator/messages-ar.js?v=1.1.0"></script> -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
toastr.options.closeButton = true;
toastr.options.progressBar = true;
toastr.options.positionClass = "toast-bottom-left";
toastr.options.timeOut = 5000;
toastr.options.preventDuplicates = true;
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css'>
<script
    src='https://cdnjs.cloudflare.com/ajax/libs/eonasdan-bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js'>
</script>
<script>
const glob_errorMsg = "Error submitting data",
    dtp_opt = {
        icons: {
            time: 'bi bi-clock',
            date: 'bi bi-calendar',
            up: 'bi bi-chevron-up',
            down: 'bi bi-chevron-down',
            previous: 'bi bi-chevron-left',
            next: 'bi bi-chevron-right',
            today: 'bi bi-calendar2-event',
            clear: 'bi bi-eraser',
            close: 'bi bi-x'
        },
        format: "YYYY-MM-DD",
    };
</script>

<link rel="stylesheet" href="../assets/css/app.css">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="./assets/css/style.css">

<!-- <script href="/assets/js/custom_functions.js?v=1.0.0"></script> -->
<!-- <script href="/assets/js/storage.js?v=1.0.0"></script> -->
<script>
const retailer = JSON.parse(localStorage.getItem('retailerData'));
const limit = 24;
</script>