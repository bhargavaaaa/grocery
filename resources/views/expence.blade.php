@extends('layouts.master')
@section('page_title')
    {{ 'Expence - ' . config('app.name') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Expences</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ route('expence.add') }}"><button class="btn btn-primary" style="float:right;"><i
                                        class="fas fa-plus"></i> Create Expence / Item</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Expence amount</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!--/. container-fluid -->
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
        $(document).ready(function() {
            var datatable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('expence.getData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                order: [
                    [2, "desc"]
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $(document).on('click', '.delete', function(e) {
                let delId = $(this).data('id');
                if (delId != '') {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('expence.delete') }}",
                                type: "POST",
                                data: {
                                    id: delId
                                },
                                success: function(response) {
                                    if (response) {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: "Expence has been deleted.",
                                            icon: 'success',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Okay'
                                        });
                                        datatable.ajax.reload();
                                    }
                                },
                            });

                        }
                    });
                }

            });
        });
    </script>
@endsection
