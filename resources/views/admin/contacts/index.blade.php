@extends('admin.layouts.main')

@section('style')
<style>
/* Menghilangkan spinner pada browser berbasis WebKit (Chrome, Safari, Edge) */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
@endsection
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h6 class="m-0 font-weight-bold text-primary">Data Contact</h6>
                        </div>
                        <div class="col-lg-6 text-right">
                            <button class="btn btn-primary" id="btn-add"><i class="fa fa-plus"></i> Add
                                Contact</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-contacts" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="viewModal"></div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    let datacontacts = $('#table-contacts').DataTable({
        ajax: {
            url: urlApi + "contacts",
            dataSrc: 'data'
        },
        columns: [{
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + 1; // Menambahkan 1 ke indeks baris untuk nomor urut
                }
            },
            {
                data: 'firstname'
            },
            {
                data: 'lastname'
            },
            {
                data: 'email'
            },
            {
                data: 'phone'
            },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                    <button class="btn btn-sm btn-info btn-detail"><i class="fa fa-info-circle"></i></button> 
                    <button class="btn btn-sm btn-warning btn-edit"><i class="fa fa-edit"></i></button> 
                    <button class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                    `;
                }
            }
        ]
    });

    $('#btn-add').on('click', function() {
        $.ajax({
            url: baseUrl + '/admin/contacts/create',
            type: "GET",
            dataType: "json",
            success: function(response) {
                // Tampilkan modal
                $(".viewModal").html(response.success);
                $('#addModal').modal('show');
            }
        })
    });

    // Event listener untuk tombol Edit
    $('#table-contacts tbody').on('click', '.btn-edit', function() {
        let data = datacontacts.row($(this).parents('tr')).data();

        $.ajax({
            url: baseUrl + '/admin/contacts/' + data.id,
            type: "GET",
            dataType: "json",
            success: function(response) {
                // Tampilkan modal
                $(".viewModal").html(response.success);
                $('#editModal').modal('show');
            }
        })
    });

    $('#table-contacts tbody').on('click', '.btn-detail', function() {
        let data = datacontacts.row($(this).parents('tr')).data();

        $.ajax({
            url: baseUrl + '/admin/contacts/detail/' + data.id,
            type: "GET",
            dataType: "json",
            success: function(response) {
                // Tampilkan modal
                $(".viewModal").html(response.success);
                $('#detailModal').modal('show');
            }
        })
    });

    // Event listener untuk tombol delete
    $(document).on('click', '.btn-delete', function() {
        let data = datacontacts.row($(this).parents('tr')).data();

        Swal.fire({
            title: `Are you sure to delete ${data.firstname} ${data.lastname}?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: urlApi + 'contacts/' + data.id,
                    type: "DELETE",
                    dataType: "json",
                    success: function(response) {
                        // Berikan feedback dan reload tabel atau hapus baris
                        Swal.fire({
                            title: "Success",
                            text: `Success delete ${data.firstname} ${data.lastname}`,
                            icon: "success"
                        }).then((result) => {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error: ' + error);
                    }
                });
            }
        })
    });
})
</script>
@endsection