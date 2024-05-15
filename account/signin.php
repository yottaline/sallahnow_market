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
                <form id="storeForm" method="POST" action="http://127.0.0.1:8000/api/stores/submit">

                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="mb-3">
                                <label for="StoreName">Store Name</label>
                                <input type="text" class="form-control" name="name" maxlength="200" required
                                    id="StoreName">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="OfficialName">Official Name</label>
                                <input class="form-control" name="official_name" type="text" id="OfficialName" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control" name="mobile" maxlength="24" required
                                    id="mobile" />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" maxlength="24" required
                                    id="phone" />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="TaxNumber">Tax Number</label>
                                <input type="text" class="form-control" name="tax_store" maxlength="70" id="TaxNumber"
                                    required />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="CrNumber">Commercial Record Number</label>
                                <input type="text" class="form-control" name="cr_store" maxlength="70" id="CrNumber"
                                    required />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="CrPhoto">Commercial Record Photo</label>
                                <input type="file" class="form-control" name="cr_photo" id="CrPhoto" />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Country</label>
                                <select name="country_id" id="country" class="form-select" required>
                                    <option value="default">-- select country --</option>
                                    <option data-ng-repeat="country in countries" data-ng-value="country.location_id"
                                        data-ng-bind="jsonParse(country.location_name)['en']"></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>State</label>
                                <select name="state_id" id="state" class="form-select" required>
                                    <option value="default">-- select state --</option>
                                    <option data-ng-repeat="state in storeModal.states"
                                        data-ng-value="state.location_id"
                                        data-ng-bind="jsonParse(state.location_name)['en']"></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>City</label>
                                <select name="city_id" id="city" class="form-select" required>
                                    <option value="default">-- select city --</option>
                                    <option data-ng-repeat="city in storeModal.cities" data-ng-value="city.location_id"
                                        data-ng-bind="jsonParse(city.location_name)['en']"></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Arae</label>
                                <select name="area_id" id="area" class="form-select" required>
                                    <option value="default">-- select area --</option>
                                    <option data-ng-repeat="area in storeModal.areas" data-ng-value="area.location_id"
                                        data-ng-bind="jsonParse(area.location_name)['en']"></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="addressS">Address</label>
                                <input type="text" class="form-control" name="address" id="addressS" required />
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <button type="submit" class="btn btn-outline-dark btn-sm">CREATE</button>
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
        $scope.countries = [];
        $scope.storeModal = {
            states: [],
            cities: [],
            areas: [],
        };
        $scope.jsonParse = (str) => JSON.parse(str);
        $scope.dataLoader = function(reload = false) {
            var request = {
                _token: '{{ csrf_token() }}'
            };

            $.post("http://127.0.0.1:8000/api/stores/locations", request, function(data) {
                $scope.$apply(() => {
                    $scope.countries = data.data;
                });
            }, 'json');
        }
        $scope.dataLoader();
        scope = $scope;
    });

    $(function() {

        $('#storeForm').on('submit', e => e.preventDefault()).validate({
            rules: {
                country_id: {

                    required: true
                },
                state_id: {

                    required: true
                },
                city_id: {

                    required: true
                },
                area_id: {

                    required: true
                },
                official_name: {
                    required: true
                },
                phone: {
                    digits: true,
                    required: true
                },
                mobile: {
                    digits: true,
                    required: true
                },
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
                        location.replace("signInR.php");
                    } else toastr.error(response.message);
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    toastr.error(jqXHR.responseJSON.message);
                }).always(function() {
                    $(form).find('button').prop('disabled', false);
                });
            }
        });




        $('#country').on('change', function() {
            var val = $(this).val();
            scope.$apply(function() {
                scope.storeModal.states = [];
                scope.storeModal.cities = [];
                scope.storeModal.areas = [];
            });
            locationsLoad(2, val, function(data) {
                scope.$apply(() => scope.storeModal.states = data);
            });
        });

        $('#state').on('change', function() {
            var val = $(this).val();
            scope.$apply(function() {
                scope.storeModal.cities = [];
                scope.storeModal.areas = [];
            });
            locationsLoad(3, val, function(data) {
                scope.$apply(() => scope.storeModal.cities = data);
            });
        });

        $('#city').on('change', function() {
            var val = $(this).val();
            scope.$apply(function() {
                scope.storeModal.areas = [];
            });

            locationsLoad(4, val, function(data) {
                scope.$apply(() => scope.storeModal.areas = data);
            });
        });
    });

    function locationsLoad(type, parent, callback) {
        $.post('http://127.0.0.1:8000/api/locations/load', {
            type: type,
            parent: parent,
            _token: '{{ csrf_token() }}'
        }, callback, 'json');
    };
    </script>
</body>

</html>