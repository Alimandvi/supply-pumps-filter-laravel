<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Supply Pumps</title>
    <style>
        .no-pump-found {
            font-weight: 600;
            font-size: 20px;
            position: fixed;
            top: 35%;
            left: 45%;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-12">
                <div class="mt-4 text-center">
                    <h2>Find the suitable pump</h2>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                <span class="font-weight-bold">Filter as per your preference</span>
                <div id="accordion" style="margin-top: 5px!important;">
                    <div class="card">
                        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span class="mb-0 font-weight-bold">Size</span>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body size-card-body">
                                @foreach($size_data as $key => $s_value)
                                    <div class="form-check">
                                        <input class="form-check-input size-checkbox" type="checkbox" data-size="{{$s_value}}" value="size[]" id="size_{{$key}}">
                                        <label class="form-check-label" for="size_{{$key}}">{{$s_value}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span class="mb-0 font-weight-bold">Body</span>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body body-card-body">
                                <p class="text-center m-0">Kindly select pump size first.</p>
                                {{-- @foreach($pumps_data as $key => $b_value)
                                    <div class="form-check">
                                        <input class="form-check-input body-checkbox" type="checkbox" data-body="{{$b_value->body}}" value="body[]" id="body_{{$key}}">
                                        <label class="form-check-label" for="body_{{$key}}">{{$b_value->body}}</label>
                                    </div>
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <span class="mb-0 font-weight-bold">Elastomer</span>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body elastomer-card-body">
                                <p class="text-center m-0">Kindly select pump size first.</p>
                                {{-- @foreach($pumps_data as $key => $e_value)
                                    <div class="form-check">
                                        <input class="form-check-input elastomer-checkbox" type="checkbox" data-elastomer="{{$e_value->elastomer}}" value="elastomer[]" id="elastomer_{{$key}}">
                                        <label class="form-check-label" for="elastomer_{{$key}}">{{$e_value->elastomer}}</label>
                                    </div>
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <input type="button" value="Filter data" class="btn btn-primary filter-data">
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-12 d-flex pumps-section">
                <div class="row pumps_data">
                    @foreach($pumps_data as $key => $pumps_value)
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{ asset('images/pump.jpg') }}" alt="Card image cap" style="position: relative; left: 1rem; width: 89%">
                                <div class="card-body">
                                    <h5>Brand: {{$pumps_value->brand}}</h5>
                                    <p class="card-text">
                                        Size: {{$pumps_value->size}} <br>
                                        Body: {{$pumps_value->body}} <br>
                                        Elastomer: {{$pumps_value->elastomer}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    jQuery(document).ready(function ($) {
        let sizeArray = [];
        let bodyArray = [];
        let elastomerArray = [];
        let payload = {
            size: [],
            body: [],
            elastomer: []
        };
        
        $(document).on('change', '.size-checkbox', function(e){
            const checkBoxVal = $(this).data('size');
            if($(this).is(':checked')) {
                sizeArray.push(checkBoxVal);
            } else {
                const getIndex = sizeArray.indexOf(checkBoxVal);
                sizeArray.splice(getIndex, 1);
            }
            
            $.ajax({
                type: "GET",
                url: "{{ route('pumpsBySize') }}",
                data: {size: JSON.stringify(sizeArray)},
                dataType: "json",
                success: function (response) {
                    let body = '';
                    let elastomer = ''
                    if(response.body.length > 0) {
                        for (let index = 0; index < response.body.length; index++) {
                            body += `
                                <div class="form-check">
                                    <input class="form-check-input body-checkbox" type="checkbox" data-body="${response.body[index]}" value="body[]" id="body_${index}">
                                    <label class="form-check-label" for="body_${index}">${response.body[index]}</label>
                                </div>`;
                        }
                    }

                    if(response.elastomer.length > 0) {
                        for (let index = 0; index < response.elastomer.length; index++) {
                            elastomer += `
                                <div class="form-check">
                                    <input class="form-check-input elastomer-checkbox" type="checkbox" data-elastomer="${response.elastomer[index]}" value="elastomer[]" id="elastomer_${index}">
                                    <label class="form-check-label" for="elastomer_${index}">${response.elastomer[index]}</label>
                                </div>`;
                        }
                    }

                    $('.body-card-body').html(body);
                    $('.elastomer-card-body').html(elastomer);
                }
            })

            payload = {...payload, size: sizeArray};
            // sendFilterRequest(payload)
        })

        $(document).on('change', '.body-checkbox', function(e){
            const checkBoxVal = $(this).data('body');
            if($(this).is(':checked')) {
                bodyArray.push(checkBoxVal);
            } else {
                const getIndex = bodyArray.indexOf(checkBoxVal);
                bodyArray.splice(getIndex, 1);
            }
            payload = {...payload, body: bodyArray};
            // sendFilterRequest(payload)
        })
        
        $(document).on('change', '.elastomer-checkbox', function(e){
            const checkBoxVal = $(this).data('elastomer');
            if($(this).is(':checked')) {
                elastomerArray.push(checkBoxVal);
            } else {
                const getIndex = elastomerArray.indexOf(checkBoxVal);
                elastomerArray.splice(getIndex, 1);
            }
            payload = {...payload, elastomer: elastomerArray};
            // sendFilterRequest(payload)
        })

        $(document).on('click', '.filter-data', function(e){
            sendFilterRequest(payload)
        })

        function sendFilterRequest(payload) {
            $.ajax({
                type: "GET",
                url: "{{ route('allPumps') }}",
                data: {filterData: JSON.stringify(payload)},
                dataType: "json",
                success: function (response) {
                    let html = '';
                    if(response.length > 0) {
                        for (let index = 0; index < response.length; index++) {
                            const element = response[index];
                            const style = (index === 1 && response.length === 2) ? '5rem' : '';
                            html += `<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-3" style="margin-left: ${style}">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{ asset('images/pump.jpg') }}" alt="Card image cap" style="position: relative; left: 1rem; width: 89%">
                                    <div class="card-body">
                                        <h5>Brand: ${element.brand}</h5>
                                        <p class="card-text">
                                            Size: ${element.size} <br>
                                            Body: ${element.body} <br>
                                            Elastomer: ${element.elastomer}
                                        </p>
                                    </div>
                                </div>
                            </div>`;
                        }
                    } else {
                        html += `<div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-3 no-pump-found">
                                <p>Kindly select different option to get desired pump.</p>
                            </div>`;
                    }
                    $('.pumps_data').html(html);
                }
            });
        }
    });
</script>
</html>