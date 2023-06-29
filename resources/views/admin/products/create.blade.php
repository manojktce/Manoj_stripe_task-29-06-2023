@extends('layouts.app')
   
@section('content')
<div class="container">
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('admin.home') }}">Back</a>
	        </div>
	    </div>
	</div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                	@if ($errors->any())
					    <div class="alert alert-danger">
					        There were some problems with your input.<br><br>
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif

                    <form action="{{ route('products.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    	@csrf

                    	<div class="row">
                    		<div class="col-xs-12 col-sm-12 col-md-12">                    			<div class="form-group">
                    				<strong>Title:</strong>
                    				<input type="text" name="name" class="form-control" placeholder="Name of product"><br>
                    			</div>
                    		</div>
                    	</div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    <input type="text" name="description" class="form-control" placeholder="Brand Name"><br>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Price:</strong>
                                    <input type="text" name="price" class="form-control" placeholder="Price"><br>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Quantity:</strong>
                                    <input type="text" name="quantity" class="form-control" placeholder="Quantity"><br>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Thumbnail:</strong>
                                    <input type="file" name="thumbnail" id="prod_thumb" class="form-control" placeholder="Thumbnail">
                                </div>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <img id="preview-image-before-upload" src="" alt="preview image" style="max-height: 250px;">
                            </div>
                        </div>
                    	
                    	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    		<button type="submit" class="btn btn-outline-primary">Submit</button>
                    	</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function (e) {
   $('#prod_thumb').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => { 
            $('#preview-image-before-upload').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
   });
});
</script>
@endsection