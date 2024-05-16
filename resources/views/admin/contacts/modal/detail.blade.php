<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-detail">
                        <tbody>
                            <tr>
                                <th width="30%">First Name</th>
                                <td>{{ $firstname }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Last Name</th>
                                <td>{{ $lastname }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Email</th>
                                <td>{{ $email }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Phone</th>
                                <td>{{ $phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row my-3">
                    <div class="col-lg-6">
                        <h5>Addresses</h5>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a type="button" class="btn btn-primary btn-sm"
                            href="{{ url('admin/addresses/create/'.$id.'') }}">
                            <i class="fa fa-plus"></i> Add
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-address">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Street</th>
                                <th>City</th>
                                <th>Postal Code</th>
                                <th>Province</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    let dataaddresses = $("#table-address").DataTable({
        ajax: {
            url: urlApi + "contacts/{{$id}}/addresses",
            dataSc: 'data'
        },
        columns: [{
            data: null,
            render: function(data, type, row, meta) {
                return meta.row + 1; // Menambahkan 1 ke indeks baris untuk nomor urut
            }
        }, {
            data: 'street'
        }, {
            data: 'city'
        }, {
            data: 'postal_code'
        }, {
            data: 'province'
        }, {
            data: 'country'
        }, {
            data: null,
            render: function(data, type, row) {
                let token = localStorage.getItem('apiToken');
                return `
                    <a class="btn btn-sm btn-warning" href="{{ url('admin/addresses/edit/'.$id.'/${row.id}?token=${token}') }}"><i class="fa fa-edit"></i></a> 
                    <button class="btn btn-sm btn-danger btn-delete-address"><i class="fa fa-trash"></i></button>
                `;
            }
        }]
    })

    // Event listener untuk tombol delete
    $(document).on('click', '.btn-delete-address', function() {
        let data = dataaddresses.row($(this).parents('tr')).data();

        Swal.fire({
            title: `Are you sure to delete ${data.street}, ${data.city}?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: urlApi + "contacts/{{$id}}/addresses/" + data.id,
                    type: "DELETE",
                    dataType: "json",
                    success: function(response) {
                        // Berikan feedback dan reload tabel atau hapus baris
                        Swal.fire({
                            title: "Success",
                            text: `Success delete ${data.street}, ${data.city}`,
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
});
</script>