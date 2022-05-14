@extends('layouts.master')
@section('page_title')
    {{ 'Expence - ' . config('app.name') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Purchase List</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('purchase-list.store') }}" method="POST">
                    @csrf
                        <div class="card-header">Add item to purchase list</div>
                        <div class="card-body table-responsive">
                            <div class="row m-3">
                                <div class="col-6">
                                    <label for="name">Item Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter item name" name="name" value="{{ old('name') }}" id="name">
                                    @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="squantity">Quantity</label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror all_price_multiply quantityx" placeholder="Enter quantity" name="quantity" value="{{ old('quantity', 0) }}" id="squantity">
                                    @error('quantity')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-success btn-lg">Update</button>
                            <button type="button" class="btn btn-danger btn-lg" onclick="window.history.back()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
<script>
    $(document).ready(() => {
        $(document).on('keyup', '.all_price_multiply', () => { 
            firstval = parseInt($('.quantityx').val());
            if(isNaN(firstval)) {
                firstval = 0;
                $('.quantityx').val(0);
            }
        });
    });
</script>
@endsection
