@extends('layouts.base')


@section('content')
    <div class="container w-100">
        <div class="row mt-5">
            <div class="col-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span> Add Product Details</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Add New Product Details
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('createproductdetails') }}" method="post" id='productForm'
                                class="productForm">
                                <div class="modal-body">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <div class="row">
                                        <div class="col">
                                            <label for="product_id">Product Name</label>
                                            <select name="product_id" id="product_id"
                                                class="form-control @error('product_id') is-invalid @enderror"
                                                name="product_id" value="{{ old('product_id') }}">
                                                @foreach ($products as $item)
                                                    <option value="{{ $item->id }}">{{ $item->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('product_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col">
                                            <label for="price">Price</label>
                                            <input type="number" id='price'
                                                class="form-control @error('price') is-invalid @enderror" name="price"
                                                value="{{ old('price') }}" name="price" placeholder="Price">
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="color">Color</label>
                                            <input type="text" id="color"
                                                class="form-control @error('color') is-invalid @enderror" name="color"
                                                value="{{ old('color') }}" name="color" placeholder="Color">
                                            @error('color')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="qty">Quantity</label>
                                            <input type="number" id="qty"
                                                class="form-control @error('qty') is-invalid @enderror" name="qty"
                                                value="{{ old('qty') }}" name="qty" placeholder="Quantity">
                                            @error('qty')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="description">Description</label>
                                            <input type="text" id="description"
                                                class="form-control pb-5 @error('description') is-invalid @enderror"
                                                name="description" value="{{ old('description') }}" name="description"
                                                placeholder="Product Description">
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-3">
                <a href="{{ route('showproductdetail') }}" class="btn btn-primary ">
                    <span>Show All Product</span>
                </a>
            </div> --}}
            <div class="col-6">
                <form action="{{ route('productDetails') }}" method="get">
                    @csrf
                    <div class="row ">
                        <div class="col p-0">
                            <input type="text" class="form-control" name="search">
                        </div>
                        <div class="col-auto ">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="row mt-5 ">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-border text-center">
                            <thead>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Color</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th colspan="2">Actions</th>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->product_id }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->color }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>
                                            <a href="{{ route('deleteproductdetail', ['id' => $item->id]) }}">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a {{-- href="{{ route('updateproduct') }}" --}} onclick="fillEditForm({{ json_encode($item) }})"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <i class="fa fa-edit text-success" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function fillEditForm(item) {
            // Set the product name field value
            document.querySelector('input[name="product_id"]').value = item.product_id;
            document.querySelector('input[name="color"]').value = item.color;
            document.querySelector('input[name="description"]').value = item.description;
            document.querySelector('input[name="price"]').value = item.price;
            document.querySelector('input[name="qty"]').value = item.qty;
            document.getElementById('id').value = item.id;

            // Set the action attribute of the form with the edit route
            document.querySelector('form').setAttribute('action', '/dashboard/updateproductdetail');
        }
        var validationErrors = @json($errors->all());
        if (validationErrors.length > 0) {
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                myModal.show();
            });
        }
    </script>
@endsection
