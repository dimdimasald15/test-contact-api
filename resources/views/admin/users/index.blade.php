@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Data Users</h6>
                </div>
                <div class="card-body">
                    <form id="formuser">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter username"
                                name="username" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
                                required>
                            <div class="invalid-feedback errname"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Password</h6>
                </div>
                <div class="card-body">
                    <form id="formpassword">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password"
                                placeholder="Enter New Password..." name="password" required>
                            <div class="invalid-feedback errpassword"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('script')
    <script>
    function updateData(userData) {
        $('#username').val(userData.username);
        $('#name').val(userData.name);

        $("#formuser").submit(function(e) {
            e.preventDefault();
            let formdata = $(this).serialize();
            $.ajax({
                type: "patch",
                url: urlApi + "users/current",
                data: formdata,
                dataType: "json",
                success: function(response) {
                    Toast.fire({
                        icon: "success",
                        title: "Update Name User Success",
                    }).then((result) => {
                        location.reload()
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    if (xhr.status === 400) {
                        if (xhr.responseJSON.errors) {
                            let errname = xhr.responseJSON.errors.name;
                            if (errname) {
                                $("#name").addClass("is-invalid");
                                $(".errname").html(errname);
                            } else {
                                $("#name").removeClass("is-invalid");
                                $(".errname").html("");
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
    }

    function updatePassword() {
        $("#formpassword").submit(function(e) {
            e.preventDefault();
            let formdata = $(this).serialize();
            $.ajax({
                type: "patch",
                url: urlApi + "users/current",
                data: formdata,
                dataType: "json",
                success: function(response) {
                    Toast.fire({
                        icon: "success",
                        title: "Password has been change",
                    }).then((result) => {
                        logout();
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    if (xhr.status === 400) {
                        if (xhr.responseJSON.errors) {
                            let errpassword = xhr.responseJSON.errors.password;
                            if (errpassword) {
                                $("#password").addClass("is-invalid");
                                $(".errpassword").html(errpassword);
                            } else {
                                $("#password").removeClass("is-invalid");
                                $(".errpassword").html("");
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
    }
    </script>
    @endsection