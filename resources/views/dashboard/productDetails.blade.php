@extends('layouts.base')


@section('content')
    <div class="container w-100">
        <div class="row mt-5">
            <div class="col-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span>{{ __('messages.AddProductDetails') }}</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">
                                    {{ __('messages.AddProductDetails') }}
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('createproductdetails') }}" method="post" id='productForm'
                                enctype="multipart/form-data" class="productForm">
                                <div class="modal-body">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <div class="row">
                                        <div class="col">
                                            <label for="product_id">{{ __('messages.ProductName') }}</label>
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
                                            <label for="price">{{ __('messages.Price') }}</label>
                                            <input type="number" id='price'
                                                class="form-control @error('price') is-invalid @enderror" name="price"
                                                value="{{ old('price') }}" name="price"
                                                placeholder="{{ __('messages.Price') }}">
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col">
                                            <label for="qty">{{ __('messages.Quantity') }}</label>
                                            <input type="number" id="qty"
                                                class="form-control @error('qty') is-invalid @enderror" name="qty"
                                                value="{{ old('qty') }}" name="qty"
                                                placeholder="{{ __('messages.Quantity') }}">
                                            @error('qty')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col">
                                            <label for="category">{{ __('messages.Category') }}</label>
                                            <select name="category" id="category"
                                                class="form-control @error('category') is-invalid @enderror" name="category"
                                                value="{{ old('category') }}">
                                                <option value="Cases">Cases</option>
                                                <option value="Challenges">Challenges</option>
                                                <option value="Questions">Questions</option>
                                            </select>
                                            @error('category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">


                                        <div class="col">
                                            <label for="image">{{ __('messages.Image') }}</label>
                                            <input type="file" name="image" id="image"
                                                class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col">
                                            <label for="file">{{ __('messages.File') }}</label>
                                            <input type="file" name="file" id="file"
                                                class="form-control @error('file') is-invalid @enderror">
                                            @error('file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="description">{{ __('messages.Description') }}</label>
                                            <input type="text" id="description"
                                                class="form-control pb-5 @error('description') is-invalid @enderror"
                                                name="description" value="{{ old('description') }}" name="description"
                                                placeholder="{{ __('messages.Description') }}">
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">{{ __('messages.Close') }}</button>
                                    <button type="submit"
                                        class="btn btn-primary">{{ __('messages.SaveChanges') }}</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
                     <div class="col-6">
                <form action="{{ route('productDetails') }}" method="get">
                    @csrf
                    <div class="row ">
                        <div class="col p-0">
                            <input type="text" class="form-control" name="search">
                        </div>
                        <div class="col-auto ">
                            <button type="submit" class="btn btn-primary">{{ __('messages.Search') }}</button>
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
                                <th>{{ __('messages.ID') }}</th>
                                <th></th>{{ __('messages.ProductName') }}</th>
                                <th>{{ __('messages.Description') }}</th>
                                <th>{{ __('messages.Price') }}</th>
                                <th>{{ __('messages.Quantity') }}</th>
                                <th>{{ __('messages.Category') }}</th>
                                <th>{{ __('messages.Image') }}</th>
                                <th colspan="2">{{ __('messages.Actions') }}</th>
                            </thead>

                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->product_id }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>
                                            <img src="\assets\images\{{ $item->image }}" height="35"
                                                alt="{{ $item->image }}" />
                                        </td>
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
            console.log('first', item);

            // Set the product name field value
            document.querySelector('select[name="product_id"]').value = item.product_id;
            document.querySelector('select[name="category"]').value = item.category;
            document.querySelector('input[name="description"]').value = item.description;
            document.querySelector('input[name="price"]').value = item.price;
            document.querySelector('input[name="qty"]').value = item.qty;
            // document.querySelector('input[name="image"]').value = item.image;
            // document.querySelector('input[name="file"]').value = item.file;
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
