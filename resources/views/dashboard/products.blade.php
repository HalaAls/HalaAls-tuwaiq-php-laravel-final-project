@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row mt-5">

            <div class="col-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span> Add New Product</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Add New Product</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('createproduct') }}" method="post">
                                <div class="modal-body">
                                    @csrf
                                    <input type="hidden" name="product_id" id="product_id">
                                    {{-- <input type="text" class="form-control" name="product_name"> --}}


                                    <label for="product_name">Product Name</label>
                                    <input type="text" id='product_name'
                                        class="form-control @error('product_name') is-invalid @enderror" name="product_name"
                                        value="{{ old('product_name') }}" name="product_name" placeholder="Product Name">
                                    @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                <a href="{{ route('showproducts') }}" class="btn btn-primary ">
                    <span>Show All Product</span>
                </a>
            </div> --}}
            <div class="col-6">
                <form action="{{ route('products') }}" method="get">
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


        <div class="row mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-border text-center">
                            <thead>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th colspan="2">Actions</th>
                            </thead>

                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>
                                            <a href="{{ route('deleteproduct', ['id' => $item['id']]) }}">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('updateproduct') }}"
                                                onclick="fillEditForm('{{ $item->id }}', '{{ $item->product_name }}')"
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
        function fillEditForm(id, productName) {
            // Set the product name field value
            document.querySelector('input[name="product_name"]').value = productName;
            document.getElementById('product_id').value = id;

            // Set the action attribute of the form with the edit route
            document.querySelector('form').setAttribute('action', '/dashboard/updateproduct');
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
