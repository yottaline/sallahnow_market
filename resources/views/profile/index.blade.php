@extends('index')
@section('title', 'Products')
@section('search')
    <form id="nvSearch" role="search">
        <input type="search" name="q" class="form-control my-3 my-md-0 rounded-pill" placeholder="Search...">
    </form>
@endsection
@section('content')
    <div class="container-fluid" data-ng-app="myApp" data-ng-controller="myCtrl">
        <div class="row">
            <div class="col-12 col-sm-4 col-lg-3">
                <div class="card card-box">
                    <div class="card-body">
                        <h1 style="font-size: 70px" class="text-center my-3"><i
                                class="bi bi-person-circle text-secondary"></i></h1>
                        <h5 class="text-center text-secondary font-monospace small dir-ltr mb-3"
                            data-ng-bind="retailer.store_code"></h5>
                        <hr>
                        <p ng-if="retailer.retailer_name" class="small mb-2"><i
                                class="bi bi-person-circle text-secondary me-2"></i><span class="d-inline-block"
                                data-ng-bind="retailer.retailer_name"></span></p>
                        <p ng-if="retailer.retailer_phone" class="small mb-2"><i
                                class="bi bi-telephone text-secondary me-2"></i><span class="d-inline-block"
                                data-ng-bind="retailer.retailer_phone"></span></p>
                        <p ng-if="retailer.retailer_email" class="small mb-2"><i
                                class="bi bi-envelope-at text-secondary me-2"></i><span class="d-inline-block"
                                data-ng-bind="retailer.retailer_email"></span></p>
                        <hr>
                        <p ng-if="retailer.store_name" class="small mb-2"><i
                                class="bi bi-shop-window text-secondary me-2"></i><span class="d-inline-block"
                                data-ng-bind="retailer.store_name"></span></p>
                        <p ng-if="retailer.store_phone" class="small mb-2"><i
                                class="bi bi-telephone text-secondary me-2"></i><span class="d-inline-block"
                                data-ng-bind="retailer.store_phone"></span></p>
                        <p ng-if="retailer.store_mobile" class="small mb-2"><i
                                class="bi bi-headset text-secondary me-2"></i><span class="d-inline-block"
                                data-ng-bind="retailer.store_mobile"></span></p>
                        <hr>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="postDelete" name="post_delete"
                                ng-value="data.post_deleted" data-ng-model="post_delete"
                                data-ng-change="toggle('post_delete', post_delete)">
                            <label class="form-check-label" for="postDelete">Blacked Your Account</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-8 col-lg-9">
                <div class="card card-box">
                    <div class="card-body">
                        <div class="container">
                            <form id="retailerForm" method="post" action="/retailer_register">
                                @csrf
                                <input type="hidden" class="form-control" name="retailer_id" maxlength="200" required
                                    data-ng-value="retailer.retailer_id">
                                <input type="hidden" class="form-control" name="store_id" maxlength="200" required
                                    data-ng-value="retailer.store_id">
                                <input type="hidden" class="form-control" name="_method" value="put" maxlength="200">
                                <div class="row">
                                    {{-- retailer full name --}}
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="RetailerName">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" maxlength="200"
                                                required id="RetailerName" data-ng-value="retailer.retailer_name">
                                        </div>
                                    </div>
                                    {{-- retailer phone --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="retailerPhone">Phone</label>
                                            <input type="text" class="form-control" name="retaile_phone" maxlength="24"
                                                required id="retailerPhone" data-ng-value="retailer.retailer_phone" />
                                        </div>
                                    </div>
                                    {{-- retailer password --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="retailerPass">Password</label>
                                            <input type="password" class="form-control" name="retailer_password"
                                                id="retailerPass" required />
                                        </div>
                                    </div>
                                    {{-- retailer email --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="retailerEmail">Email</label>
                                            <input type="email" class="form-control" name="retailer_email"
                                                id="retailerEmail" required data-ng-value="retailer.retailer_email" />
                                        </div>
                                    </div>

                                    {{-- store name --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="StoreName">Store Name</label>
                                            <input type="text" class="form-control" name="store_name" maxlength="200"
                                                required id="StoreName" data-ng-value="retailer.store_name">
                                        </div>
                                    </div>
                                    {{-- store official name --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="OfficialName">Official Name Store</label>
                                            <input class="form-control" name="official_name" type="text"
                                                id="OfficialName" required data-ng-value="retailer.store_official_name">
                                        </div>
                                    </div>
                                    {{-- store mobile --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="storeMobile">Mobile Store</label>
                                            <input type="text" class="form-control" name="store_mobile"
                                                maxlength="24" required id="storeMobile"
                                                data-ng-value="retailer.store_mobile" />
                                        </div>
                                    </div>
                                    {{-- store phine --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="storePhone">Phone Store</label>
                                            <input type="text" class="form-control" name="store_phone" maxlength="24"
                                                required id="storePhone" data-ng-value="retailer.store_phone" />
                                        </div>
                                    </div>
                                    {{-- store tx number --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="TaxNumber">Tax Number</label>
                                            <input type="text" class="form-control" name="tax_store" maxlength="70"
                                                id="TaxNumber" required data-ng-value="retailer.store_tax" />
                                        </div>
                                    </div>
                                    {{-- store cr number --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="CrNumber">Commercial Record Number</label>
                                            <input type="text" class="form-control" name="cr_store" maxlength="70"
                                                id="CrNumber" required data-ng-value="retailer.store_cr" />
                                        </div>
                                    </div>
                                    {{-- store cr image --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="CrPhoto">Commercial Record Photo</label>
                                            <input type="file" class="form-control" name="cr_photo" id="CrPhoto" />
                                        </div>
                                    </div>
                                    {{-- store country --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label>Country</label>
                                            <select name="country_id" id="country" class="form-select" required>
                                                <option value="default">-- select country --</option>
                                                <option data-ng-repeat="country in countries"
                                                    data-ng-value="country.location_id"
                                                    data-ng-bind="jsonParse(country.location_name)['en']"></option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- store state --}}
                                    <div class="col-6">
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
                                    {{-- store city --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label>City</label>
                                            <select name="city_id" id="city" class="form-select" required>
                                                <option value="default">-- select city --</option>
                                                <option data-ng-repeat="city in storeModal.cities"
                                                    data-ng-value="city.location_id"
                                                    data-ng-bind="jsonParse(city.location_name)['en']"></option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- store arae --}}
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label>Arae</label>
                                            <select name="area_id" id="area" class="form-select" required>
                                                <option value="default">-- select area --</option>
                                                <option data-ng-repeat="area in storeModal.areas"
                                                    data-ng-value="area.location_id"
                                                    data-ng-bind="jsonParse(area.location_name)['en']"></option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- store address --}}
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="addressS">Address</label>
                                            <input type="text" class="form-control"
                                                data-ng-value="retailer.store_address" name="address" id="addressS"
                                                required />
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <button type="submit" class="btn btn-outline-dark btn-sm  me-auto">UPDATE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var scope,
            app = angular.module('myApp', [], function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');
            });

        app.controller('myCtrl', function($scope) {
            $scope.statusObject = {
                name: ['Unavailable', 'available'],
                color: ['danger', 'success']
            };
            $('.loading-spinner').hide();
            $scope.countries = [];
            $scope.storeModal = {
                states: [],
                cities: [],
                areas: [],
            };
            $scope.jsonParse = (str) => JSON.parse(str);
            $scope.retailer = <?= json_encode($retailer) ?>;
            $scope.dataLoader = function(reload = false) {
                var request = {
                    _token: '{{ csrf_token() }}'
                };

                $.post("locations/get_location", request, function(data) {
                    $scope.$apply(() => {
                        $scope.countries = data;
                    });
                }, 'json');
            }
            $scope.dataLoader();
            scope = $scope;
        });

        $(function() {
            $('#retailerForm').on('submit', e => e.preventDefault()).validate({
                rules: {
                    full_name: {
                        required: true
                    },
                    retaile_phone: {
                        digits: true,
                        required: true
                    },
                    retaile_email: {
                        required: true
                    },
                    retaile_password: {
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
                        if (data.status) {
                            toastr.success(
                                "Your account has been updated successfully"
                            );
                            scope.retailer = data.data;
                            scope.dataLoader(true);
                        } else toastr.error(data.message);
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        toastr.error(jqXHR.responseJSON.message);
                    }).always(function() {
                        $(form).find('button').prop('disabled', false);
                    });
                }
            });

        });

        $('#nvSearch').on('submit', function(e) {
            e.preventDefault();
            scope.$apply(() => scope.q = $(this).find('input').val());
            scope.dataLoader(true);
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

        function locationsLoad(type, parent, callback) {
            $.post('/locations/load/', {
                type: type,
                parent: parent,
                _token: '{{ csrf_token() }}'
            }, callback, 'json');
        };
    </script>
@endsection
