@extends('user.layouts.main')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-6">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">{{ $title }}</h1>
                    </div>
                    <form id="form-registrasi">
                        @csrf
                        <div class="form-group">
                            <input type="username" class="form-control form-control-user" id="username" name="username" placeholder="Enter Username...">
                            <div class="invalid-feedback errusername"></div>
                        </div>
                        <div class="form-group">
                            <input type="name" class="form-control form-control-user" id="name" name="name" placeholder="Enter Name...">
                            <div class="invalid-feedback errname"></div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password">
                            <div class="invalid-feedback errpassword"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block btnsubmit" tabindex="4">
                            Registrasi
                        </button>
                        <hr>
                    </form>
                    <div class="text-center">
                        <span class="small">Have an Account? </span> <a class="small" href="{{ url('login') }}">
                            Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function() {

        $("#form-registrasi").submit(function(e) {
            e.preventDefault();
            let formdata = $(this).serialize();
            $.ajax({
                type: "post",
                url: urlApi + "users",
                data: formdata,
                dataType: "json",
                success: function(response) {
                    Toast.fire({
                        icon: "success",
                        title: "Registration Success",
                    }).then((result) => {
                        window.location = "login";
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    if (xhr.status === 400) {
                        if (xhr.responseJSON.errors) {
                            let errusername = xhr.responseJSON.errors.username;
                            let errname = xhr.responseJSON.errors.name;
                            let errpassword = xhr.responseJSON.errors.password;

                            if (errusername) {
                                $("#username").addClass("is-invalid");
                                $(".errusername").html(errusername);
                            } else {
                                $("#username").removeClass("is-invalid");
                                $(".errusername").html("");
                            }
                            if (errname) {
                                $("#name").addClass("is-invalid");
                                $(".errname").html(errname);
                            } else {
                                $("#name").removeClass("is-invalid");
                                $(".errname").html("");
                            }
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
    })
</script>
@endsection