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
        <div class="container-fluid" data-ng-app="myApp" data-ng-controller="myCtrl">
            <div class="mt-5 store">
                <h5 class="mb-3 text-center text-secondary">Create a new account</h5>
                <form id="retailerForm" method="post" action="http://127.0.0.1:8000/api/retailers/register">
                    <div class="row">

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="RetailerName">Your Name</label>
                                <input type="text" class="form-control" name="name" maxlength="200" required
                                    id="RetailerName">
                            </div>
                        </div>

                        <div class="col-12 ">
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" maxlength="24" required
                                    id="phone" />
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="mb-3">
                                <label>Store Name</label>
                                <select name="store" id="store" class="form-select" required>
                                    <option value="default">-- SELECT YOUR STORE --</option>
                                    <option data-ng-repeat="store in stores" data-ng-value="store.store_id"
                                        data-ng-bind="store.store_name"></option>
                                </select>
                            </div>
                        </div>



                        <div class="col-12 ">
                            <div class="mb-3">
                                <label for="retailerEmail">Email</label>
                                <input type="email" class="form-control" name="email" id="retailerEmail" required />
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
                        <button type="submit" class="btn btn-outline-dark btn-sm  me-auto">CREATE</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script>
    var scope,
        app = angular.module('myApp', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });

    app.controller('myCtrl', function($scope) {
        $scope.stores = [];

        $scope.jsonParse = (str) => JSON.parse(str);
        $scope.dataLoader = function(reload = false) {
            var request = {
                _token: '{{ csrf_token() }}'
            };

            $.post("http://127.0.0.1:8000/api/stores/get_stores", request, function(data) {
                $scope.$apply(() => {
                    $scope.stores = data;
                });
            }, 'json');
        }
        $scope.dataLoader();
        scope = $scope;
    });

    $(function() {
        $('#retailerForm').on('submit', e => e.preventDefault()).validate({
            rules: {
                name: {
                    required: true
                },
                phone: {
                    digits: true,
                    required: true
                },
                email: {
                    required: true
                },
                password: {
                    required: true
                },
                stor: {
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
                    console.log(data);
                    if (data.status) {
                        toastr.success(
                            "Your account has been created successfully. The account will be activated after 3 minutes"
                        );
                        setTimeout(location.replace("login.php"), 5000)
                    } else toastr.error(response.message);
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