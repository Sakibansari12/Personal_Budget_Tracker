@extends('admin.layouts.main')
@section('content')
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-8 align-self-center">
            <!-- <h3 class="page-title mb-0 p-0">{{ isset($edit) ? 'Update Role' : 'Create New Role' }}</h3> -->
        </div>
        <div class="col-md-6 col-4 align-self-center">
            <div class="text-end upgrade-btn">
                <!-- <a href="{{route('role.index')}}"
                    class="btn btn-secondary d-none d-md-inline-block text-white">Role <i class="mdi me-2 mdi-format-list-bulleted"></i></a> -->
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- column -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
<div class="error-body text-center">
    <h1 class="error-title">404</h1>
    <h3 class="text-uppercase error-subtitle">PAGE NOT FOUND !</h3>
    <p class="text-muted mb-4 mt-4">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
    <a href="{{route('admin.dashboard')}}" class="btn btn-info btn-rounded waves-effect waves-light mb-4 text-white">Back to home</a>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
