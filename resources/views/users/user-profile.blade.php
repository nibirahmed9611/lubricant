@extends('layouts.dash')

@section('title')
    User Profile
@endsection

@section('block-header')
    <div class="block-header">

        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>User</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">PRHR</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
            </div>            
            {{-- <div class="col-md-6 col-sm-12 text-right hidden-xs">
                <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="">Create Campaign</a>
                <a href="#" class="btn btn-sm btn-success" title="Themeforest"><i class="icon-basket"></i>Fun?</a>
            </div> --}}
        </div>
    </div>
@endsection


@section('main-content')

@if (session('basic_update'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <i class="fa fa-check-circle"></i> Basic Data Changed Sucessfully
    </div>
@endif
@if (session('account_update'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <i class="fa fa-check-circle"></i> Account Data Changed Sucessfully
    </div>
@endif
@if (session('confirm_error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <i class="fa fa-times-circle"></i> Current Password is not correct
    </div>
@endif


@if($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <i class="fa fa-times-circle"></i> {{ $error }}
        </div>
    @endforeach
@endif

<div class="row clearfix">
    <div class="col-md-12">
        <div class="card social">
            <div class="profile-header d-flex justify-content-between justify-content-center">
                <div class="d-flex">
                    <div class="mr-3">
                        <img src="../assets/images/user.png" class="rounded" alt="">
                    </div>
                    <div class="details">
                        <h5 class="mb-0">{{ $user->name ?? '' }}</h5>
                        <span class="text-light">{{ $user->department ? $user->department->name : '' }}</span>
                        {{-- <p class="mb-0"><span>Shift: <strong>{{ $user->shift ? $user->shift->name : '' }}</strong></span> <span>Branch: <strong>{{ $user->branch ? $user->branch->name : '' }}</strong></span></p> --}}
                    </div>                                
                </div>
                {{-- <div>
                    <button class="btn btn-primary btn-sm">Follow</button>
                    <button class="btn btn-success btn-sm">Message</button>
                </div> --}}
            </div>
        </div>                    
    </div>

    <div class="col-xl-4 col-lg-4 col-md-5">
        <div class="card">
            <div class="header">
                <h2>Info</h2>
                <ul class="header-dropdown dropdown">                                
                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        {{-- <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another Action</a></li>
                            <li><a href="javascript:void(0);">Something else</a></li>
                        </ul> --}}
                    </li>
                </ul>
            </div>
            <div class="body">
                <small class="text-muted">Role: </small>
                <p>{{ $user->role ? $user->role->name : "Not Found" }}</p>
                <small class="text-muted">Email address: </small>
                <p>{{ $user->email ?? "Not Found" }}</p>                            
                <hr>
                <small class="text-muted">Mobile: </small>
                <p>{{ $user->cell_no ?? "Not Found" }}</p>
                <hr>
                <small class="text-muted">Shop Name: </small>
                <p class="m-b-0">{{ $user->shop_name ?? 'Not Found' }}</p>
                
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-8 col-md-7">
        <div class="card">
            <div class="header">
                <h2>Basic Information</h2>
                {{-- <ul class="header-dropdown dropdown">                                
                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another Action</a></li>
                            <li><a href="javascript:void(0);">Something else</a></li>
                        </ul>
                    </li>
                </ul> --}}
            </div>
            @php
                if (Auth::user()->role && ( Auth::user()->role->name != "Admin" && Auth::user()->role->name != "Super Admin" ) ){
                    $field = "disabled";
                }else{
                    $field = "";
                }
            @endphp 
            

            {!! Form::open(['route'=>'user_basic_data.update','method'=>'PATCH']) !!}
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">                                                
                            <input {{ $field }} type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">                                                
                            <input {{ $field }} type="text" name="fathers_name" class="form-control" value="{{ $user->fathers_name }}" placeholder="Fathers Name">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <select {{ $field }} class="form-control" name="role_id">
                                @foreach ($roles as $key => $role)
                                    @if ($role == Auth::user()->role->name)
                                        <option selected value="{{ $key }}">{{ $role }}</option>
                                    @else 
                                        <option value="{{ $key }}">{{ $role }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <input {{ $field }} type="text" name="shop_name" value="{{ $user->shop_name ?? '' }}" class="form-control" placeholder="Shop Name">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <input {{ $field }} type="text" name="nid" class="form-control" value="{{ $user->nid ?? "Not Found" }}" placeholder="National ID (NID)">
                        </div>
                    </div> 

                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <input {{ $field }} type="text" name="division" title="division" class="form-control" value="{{ $user->division }}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <input {{ $field }} type="text" name="district" title="district" class="form-control" value="{{ $user->district }}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="form-group">
                            <input {{ $field }} type="text" name="subdistrict" title="subdistrict" class="form-control" value="{{ $user->subdistrict }}">
                        </div>
                    </div>

                    {{-- <div class="col-lg-12 col-md-12">
                        <div class="form-group">                                                
                            <textarea rows="4" type="text" name="address" class="form-control" placeholder="Address">{{ $user->address ?? "Not Found" }}</textarea>
                        </div>
                    </div> --}}
                </div>
                <input type="submit" value="Update" class="btn btn-round btn-primary"> &nbsp;&nbsp;
                {{-- <button type="button" class="btn btn-round btn-default">Cancel</button> --}}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="card">
            <div class="header">
                <h2>Account Data</h2>
            </div>
            {!! Form::open(['route'=>'user_account_data.update','method'=>'PATCH']) !!}
            <div class="body">
                <div class="row clearfix">
                    {{-- <div class="col-lg-4 col-md-12">                                            
                        <div class="form-group">                                                
                            <input type="text" class="form-control" value="{{ $user->username }}" title="username" disabled placeholder="Username">
                        </div>
                    </div> --}}
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <input {{ $field }} type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <input {{ $field }} type="text" name="cell_no" class="form-control" value="{{ $user->cell_no }}" placeholder="Phone Number">
                        </div>
                    </div>                                
                    <div class="col-lg-12 col-md-12">
                        <hr>
                        <h6>Change Password</h6>
                        <div class="form-group">
                            <input type="password" name="current_password" class="form-control" placeholder="Current Password">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-round btn-primary">Update</button> &nbsp;&nbsp;
                <button type="button" class="btn btn-round btn-default">Cancel</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection



@section('custom-footer-prepend')

@endsection