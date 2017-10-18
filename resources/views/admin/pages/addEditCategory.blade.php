@extends("admin/admin_app")


@section("js")
    <script type="text/javascript" src="{{ URL::asset('admin_assets/js/core/libraries/jquery_ui/interactions.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/uploaders/fileinput.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('admin_assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin_assets/js/pages/form_select2.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin_assets/js/pages/form_inputs.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin_assets/js/pages/components_modals.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('admin_assets/js/pages/category.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            // Basic example
            $('.file-input').fileinput({
                browseLabel: 'Browse',
                browseIcon: '<i class="icon-file-plus"></i>',
                uploadIcon: '<i class="icon-file-upload2"></i>',
                removeIcon: '<i class="icon-cross3"></i>',
                showUpload: false,
                layoutTemplates: {
                    icon: '<i class="icon-file-check"></i>'
                },
                initialCaption: "No file selected"
            });
        });
    </script>
@endsection


@section("content")
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-default">
            <div class="page-header-content">
                <div class="page-title">
                    <h3><span class="text-semibold">Category Details</span></h3>
                </div>
            </div>

            <div class="breadcrumb-line">
                <ul class="breadcrumb">
                    <li><a href="{{ URL::to('/admin/categories')}}"><i class="icon-home2 position-left"></i>Categories</a></li>
                    @if(isset($category))
                        <li class="active">{{ $category->category_id }}</li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content">
            <!-- Error Message -->
            @if (count($errors) > 0)
                <div class="alert alert-danger no-border">
                    <ul>
                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                        @foreach ($errors->all() as $error)
                            <li>
                                <span class="text-semibold">{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <!-- Success Message -->
            @if(Session::has('flash_message'))
                <div class="alert alert-success no-border">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold">{{ Session::get('flash_message') }}</span>
                </div>
            @endif

            <div class="row">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <form class="form-horizontal" action="@if (isset($category)) {{url('/admin/categories/'.$category->category_id.'/update')}} @else {{url('/admin/categories/create')}} @endif" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            
                            <div class="form-group" hidden="true">
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="" name="category_id" value="{{isset($category) ? $category->category_id : ''}}" hidden="true">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2"> Category Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Category Name" name="category_title" value="{{isset($category) ? $category->category_title : ''}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2"> Free or Premium</label>
                                <div class="col-lg-10">
                                    <select class="select" name="lock" required>
                                        <option value="0" 
                                            @if (isset($category))
                                                @if ($category->lock == '0')
                                                    selected
                                                @endif
                                            @endif
                                                    >Free</option>
                                        <option value="1" 
                                            @if (isset($category))
                                                @if ($category->lock == '1')
                                                    selected
                                                @endif
                                            @endif
                                            >Premium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2"> Price</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" placeholder="0" name="price" value="{{isset($category) ? $category->price : ''}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">Category Photo</label>
                                <div class="col-lg-10">
                                    <input type="file" class="file-input" name="thumbnail" accept=".png, .jpg" data-allowed-file-extensions='["png", "jpg"]' data-show-caption="true" @if (!isset($category)) required @endif>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success pull-right col-lg-2">@if (isset($category)) Update Category @else Create Category @endif<i class="icon-arrow-right14 position-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /content area -->
    </div>
    <!-- /main content -->
@endsection



