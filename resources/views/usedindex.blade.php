@extends('layouts.master')
@section('page_title')
    {{ 'Expence - ' . config('app.name') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Used Stuff</h1>
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
                    "url": "{{ route('products.usedProductsData') }}",
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
                    }
                ],
            });
        });
    </script>
@endsection
