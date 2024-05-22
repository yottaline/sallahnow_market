{{-- <x-guest-layout>

</x-guest-layout> --}}
{{-- <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-primary-button class="ms-4">
            {{ __('Register') }}
        </x-primary-button>
    </div>
</form> --}}

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login | Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />

    <link rel="stylesheet" href="/assets/css/style.css?v=1.0.0">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-sanitize.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        toastr.options.closeButton = true;
        toastr.options.progressBar = true;
        toastr.options.positionClass = "toast-bottom-left";
        toastr.options.timeOut = 5000;
        toastr.options.preventDuplicates = true;
    </script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        #wrapper {
            padding-top: 150px;
        }

        .form-container {
            max-width: 400px;
            margin: auto;
        }

        * {
            box-sizing: border-box;
        }

        .store {
            border: 1px solid #eee;
            box-shadow: 2px 3px 2px #d9cece;
            border-radius: 10px;
            padding: 50px;
            width: 600px;
            margin: auto;
        }
    </style>
</head>

<body>
    <div id=" wrapper">
        <div class="container" data-ng-app="myApp" data-ng-controller="myCtrl">
            <div class="mt-5 store">
                <h2 class="mb-3 text-center text-secondary">Create a new account</h2>
                <form id="retailerForm" method="post" action="retailer_register">
                    @csrf
                    <div class="row">
                        {{-- retailer full name --}}
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="RetailerName">Full Name</label>
                                <input type="text" class="form-control" name="full_name" maxlength="200" required
                                    id="RetailerName">
                            </div>
                        </div>
                        {{-- retailer phone --}}
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="retailerPhone">Phone</label>
                                <input type="text" class="form-control" name="retaile_phone" maxlength="24" required
                                    id="retailerPhone" />
                            </div>
                        </div>
                        {{-- retailer password --}}
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="retailerPass">Password</label>
                                <input type="password" class="form-control" name="retailer_password" id="retailerPass"
                                    required />
                            </div>
                        </div>
                        {{-- retailer email --}}
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="retailerEmail">Email</label>
                                <input type="email" class="form-control" name="retailer_email" id="retailerEmail"
                                    required />
                            </div>
                        </div>

                        {{-- store name --}}
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="StoreName">Store Name</label>
                                <input type="text" class="form-control" name="store_name" maxlength="200" required
                                    id="StoreName">
                            </div>
                        </div>
                        {{-- store official name --}}
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="OfficialName">Official Name Store</label>
                                <input class="form-control" name="official_name" type="text" id="OfficialName"
                                    required>
                            </div>
                        </div>
                        {{-- store mobile --}}
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="storeMobile">Mobile Store</label>
                                <input type="text" class="form-control" name="store_mobile" maxlength="24" required
                                    id="storeMobile" />
                            </div>
                        </div>
                        {{-- store phine --}}
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="storePhone">Phone Store</label>
                                <input type="text" class="form-control" name="store_phone" maxlength="24" required
                                    id="storePhone" />
                            </div>
                        </div>
                        {{-- store tx number --}}
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="TaxNumber">Tax Number</label>
                                <input type="text" class="form-control" name="tax_store" maxlength="70"
                                    id="TaxNumber" required />
                            </div>
                        </div>
                        {{-- store cr number --}}
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="CrNumber">Commercial Record Number</label>
                                <input type="text" class="form-control" name="cr_store" maxlength="70"
                                    id="CrNumber" required />
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
                                    <option data-ng-repeat="country in countries" data-ng-value="country.location_id"
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
                                    <option data-ng-repeat="area in storeModal.areas" data-ng-value="area.location_id"
                                        data-ng-bind="jsonParse(area.location_name)['en']"></option>
                                </select>
                            </div>
                        </div>
                        {{-- store address --}}
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="addressS">Address</label>
                                <input type="text" class="form-control" name="address" id="addressS" required />
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
                                "Your account has been created successfully. The account will be activated after 3 minutes"
                            );
                            setTimeout(location.replace("./login"), 300000)
                        } else toastr.error(data.message);
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        toastr.error(jqXHR.responseJSON.message);
                    }).always(function() {
                        $(form).find('button').prop('disabled', false);
                    });
                }
            });

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
</body>

</html>
