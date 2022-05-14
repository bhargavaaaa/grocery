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
                    <form action="{{ route('expence.add.post') }}" method="POST">
                    @csrf
                        <div class="card-header">Add expence / item</div>
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
                            <div class="row m-3">
                                <div class="col-6">
                                    <label for="spprice">Single piece price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror all_price_multiply pricesx" placeholder="Enter single piece price" name="price" value="{{ old('quantity', 0) }}" id="spprice">
                                    @error('price')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="price_total">Price Total</label>
                                    <input type="text" class="form-control totalprcset" placeholder="Enter total price" value="{{ old('totalprcset', 0) }}" name="totalprcset" readonly id="price_total">
                                </div>
                            </div>
                            <div class="row m-3">
                                <div class="col-6">
                                    <label for="expiry_date">Expiry Date</label>
                                    <input type="text" id="expiry_date" class="form-control @error('expiry_date') is-invalid @enderror" placeholder="Enter expiry date" name="expiry_date" value="{{ old('expiry_date') }}">
                                    @error('expiry_date')
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

            secondval = parseInt($('.pricesx').val());
            if(isNaN(secondval)) {
                secondval = 0;
                $('.pricesx').val(0);
            }

            thirdval = firstval * secondval;

            $('.totalprcset').val(thirdval);
        });

        $('#expiry_date').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
		});
    });
</script>
@endsection
