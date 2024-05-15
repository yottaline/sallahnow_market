<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php include_once('../include/head.php') ?>
    <title>تسجيل الدخول</title>

    <style>
    #wrapper {
        padding-top: 150px;
    }

    .form-container {
        max-width: 400px;
        margin: auto;
    }
    </style>
</head>

<body>
    <div id=" wrapper">
        <div class="container-fluid">
            <div class="mt-5 store">
                <h5 class="mb-3 text-center text-secondary">SIGN UP</h5>
                <form id="loginFrom" method="post" action="http://127.0.0.1:8000/api/retailers/login">
                    <div class="row">

                        <div class="col-12 ">
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" maxlength="24" required
                                    id="phone" />
                            </div>
                        </div>

                        <div class="col-12 ">
                            <div class="mb-3">
                                <label for="retailerPass">Password</label>
                                <input type="password" class="form-control" name="password" id="retailerPass"
                                    required />
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <button type="submit" class="btn btn-outline-dark btn-sm  me-auto">SIGN UP</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script>
    $(function() {
        $('#loginFrom').on('submit', e => e.preventDefault()).validate({
            rules: {
                phone: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            submitHandler: function(form) {
                var formData = new FormData(form),
                    action = $(form).attr('action'),
                    method = $(form).attr('method');
                $(form).find('button').prop('disabled', true);

                $.ajax({
                    url: action,
                    type: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                }).done(function(data, textStatus, jqXHR) {

                    console.log(data.data)
                    if (data.status_bool) {
                        localStorage.setItem('retailerData', JSON.stringify(data.data));
                        location.replace("../index.php")
                    } else toastr.error(data.message);
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    toastr.error(jqXHR.responseJSON.message);
                }).always(function() {
                    $(form).find('button').prop('disabled', false);
                });
            }
        });

    });
    </script>
</body>

</html>