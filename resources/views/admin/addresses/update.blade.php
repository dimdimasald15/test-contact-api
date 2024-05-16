@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Update {{$title}}</h6>
                </div>
                <div class="card-body">
                    <form id="formaddress">
                        <input type="hidden" id="id" name="id" value="{{ $address_id }}">
                        <div class="form-group">
                            <label for="street">Street</label>
                            <input type="text" class="form-control" id="street" placeholder="Enter street" name="street" value="{{ $street }}">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" placeholder="Enter city" name="city" value="{{ $city }}">
                        </div>
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" placeholder="Enter Province" name="province" value="{{ $province }}">
                        </div>
                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" placeholder="Enter Postal Code" name="postal_code" value="{{ $postal_code }}">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" placeholder="Enter country" name="country" value="{{ $country }}">
                            <div class="invalid-feedback errcountry"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('script')
    <script>
        $(document).ready(function() {
            $("#formaddress").submit(function(e) {
                e.preventDefault();
                let formdata = $(this).serialize();
                $.ajax({
                    type: "put",
                    url: urlApi + "contacts/{{ $contact_id }}/addresses/{{ $address_id }}",
                    data: formdata,
                    dataType: "json",
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Save Changes Address Success",
                        }).then((result) => {
                            window.location = baseUrl + "/admin/contacts"
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        if (xhr.status === 400) {
                            if (xhr.responseJSON.errors) {
                                let errcountry = xhr.responseJSON.errors.country;
                                if (errcountry) {
                                    $("#country").addClass("is-invalid");
                                    $(".errcountry").html(errcountry);
                                } else {
                                    $("#country").removeClass("is-invalid");
                                    $(".errcountry").html("");
                                }
                            }
                        } else {
                            // Tangani error lainnya
                            alert(
                                xhr.status + "\n" + xhr.responseText + "\n" + thrownError
                            );
                        }
                    },
                });
                return false;
            });
        })
    </script>
    @endsection