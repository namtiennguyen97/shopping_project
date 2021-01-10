@extends('admin.layouts.master')
@section('content')
    @include('admin.layouts.navbarLeft')
    @include('admin.layouts.rightNavBar')
    @include('admin.layouts.mainSideBar')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Data <button class="btn btn-success" id="createProductButton">Create</button></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product List</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable for Admin</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Vendor</th>
                                        <th>Image</th>
                                        <th>Desc</th>
                                        <th>Category</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                    </thead>
                                    <tbody id="showProductData">

                                    {{--                                   data appen here--}}
                                    @foreach(\App\Models\Product::all() as $row)
                                        <tr class="product-row{{$row->id}}">
                                            <td>{{$row->name}}</td>
                                            <td>{{number_format($row->price)}}</td>
                                            <td>{{$row->vendor}}</td>
                                            <td><img src="{{asset('storage/'. $row->image)}}" style="width: 80px; height: 70px" class="img-thumbnail"></td>
                                            <td><textarea readonly>{{$row->desc}}</textarea></td>
                                            <td><a class="product-category{{$row->id}}">{{$row->productCategory->name}}</a></td>
                                            <td><a data-id="{{$row->id}}"  class='btn btn-danger product-delete-btn'><i  class="fas fa-trash-alt deleteProduct"></i></a></td>
                                            <td><a class='btn btn-info product-edit' data-id="{{$row->id}}" data-name="{{$row->name}}" data-price="{{$row->price}}" data-vendor="{{$row->vendor}}" data-desc="{{$row->desc}}" data-image="{{$row->image}}"><i class="fas fa-edit editProduct "></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Vendor</th>
                                        <th>Image</th>
                                        <th>Desc</th>
                                        <th>Category</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <!-- Modal Create Product -->
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Production</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createProductForm"  enctype="multipart/form-data" >
                        @csrf
                        <table class="table table-dark">
                            <tr>
                                <td>Product Name:</td>
                                <td><input type="text" name="name" placeholder="Input product name"></td>
                            </tr>
                            <tr>
                                <td>Product Price:</td>
                                <td><input type="number" name="price" placeholder="Input product price"></td>
                            </tr>
                            <tr>
                                <td>Product Vendor:</td>
                                <td><input type="text" name="vendor" placeholder="Input product vendor"></td>
                            </tr>
                            <tr>
                                <td>Product Image:</td>
                                <td><input type="file" name="image" id="productImage" onchange="loadFile(event)"></td>
                            </tr>
                            <tr>
                                <td>Image Preview:</td>
                                <td><img id="previewImage" class="img img-thumbnail" width="200"></td>
                            </tr>
                            <tr>
                                <td>Product Desc:</td>
                                <td><textarea id="productDesc" name="desc"></textarea></td>
                            </tr>
                            <tr>
                                <td>Product Categories</td>
                                <td><select name="category_id">
                                        @foreach(\App\Models\Categories::all() as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                    </select></td>
                            </tr>
                        </table>
                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div>
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <script>
         function loadFile(event) {
            let output = document.getElementById('previewImage');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        }

        $('#createProductButton').click(function () {
            $('#createProductModal').modal('show');
        });

         // delete product
        $('#showProductData').on('click','.product-delete-btn', function (e) {
            e.preventDefault();
            let id =  $(this).data('id');
            $.ajax({
                url: "deleteProduct/"+ id,
                method: 'get',
                success: function () {
                    $(".product-row"+ id).remove();
                    alertify.success('Deleted!');
                }
            });
        });

        //create product
        $('#createProductForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('admin.store.product')}}",
                method: 'post',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    console.log('created data: ', data);

                    let deleteClassA = "btn btn-danger product-delete-btn";
                    let updateClass = "btn btn-info product-edit";
                    $('#showProductData').append("<tr class='product-row"+data.id+"'>" +
                        "<td>"+ data.name +"</td>"+
                        "<td>"+ data.price +"</td>"+
                        "<td>"+ data.vendor +"</td>"+
                        "<td><img src='storage/"+data.image+"' style=\"width: 80px; height: 70px\" class=\"img-thumbnail\"></td>" +
                        "<td><textarea readonly>"+ data.desc +"</textarea></td>"+
                        "<td>"+"<a class='product-category"+data.id+"'>data.category_id</a>"+"</td>"+
                        "<td>"+"<a data-id="+ data.id +" class='"+deleteClassA+"'><i class='fas fa-trash-alt deleteProduct'></i></a>"+"</td>"+
                        "<td>"+"<a data-id="+ data.id +" class='"+updateClass+"'><i class='fas fa-edit editProduct'></i></a>"+"</td>"+
                        "</td>");
                    category_render();
                    alertify.success('Product has been created!');
                }
            });
        });

        function category_render() {
            $.ajax({
                url: "{{route('admin.category.render')}}",
                method: 'get',
                success: function (data) {
                    console.log(data.length);
                    for(let i =0; i < data.length; i++){
                        if(data[i].category_id === 1){
                            $('.product-category'+ data[i].id).text('Women Clothes');
                        }
                        if(data[i].category_id === 2){
                            $('.product-category' + data[i].id).text('Men Clothes');
                        }
                        if(data[i].category_id === 3){
                            $('.product-category' + data[i].id).text('Kid Clothes');
                        }
                    }

                }
            });
        }

    </script>
@endsection
