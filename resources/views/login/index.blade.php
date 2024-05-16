@extends('user.layouts.main')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">{{ $title }}</h1>
                    </div>
                    <form id="form-login">
                        @csrf
                        <div class="form-group">
                            <input type="username" class="form-control form-control-user" id="username" placeholder="Enter Username..." name="username">
                            <div class="invalid-feedback errusername"></div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password">
                            <div class="invalid-feedback errpassword"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block btnsubmit" tabindex="4">
                            Login
                        </button>
                        <hr>
                    </form>
                    <div class="text-center">
                        <a class="small" href="{{ url('registrasi') }}">Create an Account!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $("#form-login").submit(function(e) {
        e.preventDefault();
        let formdata = $(this).serialize();
        $.ajax({
            type: "post",
            url: urlApi + "users/login",
            data: formdata,
            dataType: "json",
            success: function(response) {
                // Menyimpan data pengguna dan token di localStorage
                let userData = response.data;
                localStorage.setItem('apiToken', userData.token);
                Toast.fire({
                    icon: "success",
                    title: "Login Success",
                }).then((result) => {
                    window.location = "admin/dashboard";
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                if (xhr.status === 400) {
                    if (xhr.responseJSON.errors) {
                        let errusername = xhr.responseJSON.errors.username;
                        let errpassword = xhr.responseJSON.errors.password;

                        if (errusername) {
                            $("#username").addClass("is-invalid");
                            $(".errusername").html(errusername);
                        } else {
                            $("#username").removeClass("is-invalid");
                            $(".errusername").html("");
                        }
                        if (errpassword) {
                            $("#password").addClass("is-invalid");
                            $(".errpassword").html(errpassword);
                        } else {
                            $("#password").removeClass("is-invalid");
                            $(".errpassword").html("");
                        }
                    }
                } else if (xhr.status === 401) {
                    if (xhr.responseJSON.errors) {
                        Swal.fire({
                            title: "Error",
                            text: xhr.responseJSON.errors.message,
                            icon: "error"
                        });
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
</script>
@endsection