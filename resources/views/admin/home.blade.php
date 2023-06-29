@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <b>Products:</b>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.create') }}">Add Product</a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered" id="product_types_table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Thumbnail</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=0 @endphp
                            @foreach($products as $prod)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $prod->name }}</td>
                                <td>{{ $prod->description }}</td>
                                <td><img class="card-img" src="{{ URL::asset('public/images/'.$prod->thumbnail) }}" alt="{{ $prod->name }}" height="100px"></td>
                                <td>{{ $prod->price }}</td>
                                <td>{{ $prod->is_active == 1  ? "Active" : "In-active" }}</td>
                                <td>
                                    <form action="{{ route('products.destroy', $prod->id) }}" method="POST">
                                        @csrf
                                        <!-- <a href="{{ route('products.show', $prod->id) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i></a> -->
                                        <a href="{{ route('products.edit', $prod->id) }}" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fa fa-trash-o"></i></button>
                                    </form>
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
<script type="text/javascript">
    $(document).ready(function(){
        let table = new DataTable('#product_types_table');
    });
</script>
@endsection