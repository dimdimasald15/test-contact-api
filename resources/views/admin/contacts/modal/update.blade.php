<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-contact">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $id }}">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname"
                            value="{{ $firstname }}">
                        <div class="invalid-feedback errfirstname"></div>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $lastname }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $email }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $phone }}">
                        <div class="invalid-feedback errphone"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#form-edit-contact").submit(function(e) {
        e.preventDefault();
        let formdata = $(this).serialize();
        $.ajax({
            type: "put",
            url: urlApi + "contacts/{{ $id }}",
            data: formdata,
            dataType: "json",
            success: function(response) {
                Swal.fire({
                    title: "Success",
                    text: "Success change contact",
                    icon: "success"
                }).then((result) => {
                    location.reload();
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                if (xhr.status === 400) {
                    if (xhr.responseJSON.errors) {
                        let errfirstname = xhr.responseJSON.errors.firstname;
                        let errphone = xhr.responseJSON.errors.phone;

                        if (errfirstname) {
                            $("#firstname").addClass("is-invalid");
                            $(".errfirstname").html(errfirstname);
                        } else {
                            $("#firstname").removeClass("is-invalid");
                            $(".errfirstname").html("");
                        }
                        if (errphone) {
                            $("#phone").addClass("is-invalid");
                            $(".errphone").html(errphone);
                        } else {
                            $("#phone").removeClass("is-invalid");
                            $(".errphone").html("");
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