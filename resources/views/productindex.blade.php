@extends('layouts.master')
@section('page_title')
    {{ 'Expence - ' . config('app.name') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Available Stuff</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                    <th>Spoiled at</th>
                                    <th>Added at</th>
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
                    "url": "{{ route('products.getData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                order: [
                    [6, "desc"]
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'quantity'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'total_price'
                    },
                    {
                        data: 'expiry_date'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
            });

            $(document).on('change', '.product_state', function () {
                var $th = $(this);
                Swal.fire({
                    title: 'Are you sure want to move product as used?',
                    text: "As that can not be undone it's state as available.",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ route('products.changeState') }}",
                            type: "POST",
                            data: {
                                id: $th.data('id')
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.status != true){
                                    alert("Something went wrong while updating product, try again after reloading the page.");
                                } else {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: "Product state has been changed.",
                                        icon: 'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Okay'
                                    });
                                }
                                datatable.ajax.reload();
                            },
                            error: function() {
                                alert("Something went wrong while updating product, try again after reloading the page.");
                                datatable.ajax.reload();
                            }
                        });
                    } else {
                        datatable1.ajax.reload();
                    }
                });
            });
        });
    </script>
@endsection
