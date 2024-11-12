@extends('admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Edit instructor</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit instructor</h4>
                </div>
            </div>
        </div>     
        <!-- end page title -->

        <div class="row">
           
            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills nav-fill navtab-bg">
                            <li class="nav-item">
                                <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    Settings
                                </a>
                            </li>
                        </ul>
     
                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{ route('supplier.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <input type="hidden" name="id" value="{{ $supplier->id }}">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> instructor Info</h5>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label"> Full Name</label>
                                                <input type="text" name="name" value="{{ $supplier->name }}" class="form-control"  @error('name') is-invalid   @enderror placeholder="Enter Full Name">
                                                @error('name')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" value="{{ $supplier->email }}" class="form-control" @error('email') is-invalid   @enderror placeholder="Enter email">
                                                @error('email')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" name="phone" value="{{ $supplier->phone }}" class="form-control" @error('phone') is-invalid   @enderror placeholder="Enter phone">
                                                @error('phone')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" name="address" value="{{ $supplier->address }}" class="form-control" @error('address') is-invalid   @enderror placeholder="Enter address">
                                                @error('address')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="shopname" class="form-label">Language Proficiency</label>
                                                <input type="text" name="shopname" value="{{ $supplier->shopname }}" class="form-control" @error('shopname') is-invalid   @enderror placeholder="Language Proficiency">
                                                @error('shopname')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="type" class="form-label">Formation Type</label>
                                                <input type="text" name="type" value="{{ $supplier->type }}" class="form-control" @error('type') is-invalid   @enderror placeholder="Enter Formation Type">
                                                @error('type')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="account_holder" class="form-label">Experience</label>
                                                <input type="text" name="account_holder" value="{{ $supplier->account_holder }}" class="form-control" @error('account_holder') is-invalid   @enderror placeholder="Enter Experience">
                                                @error('account_holder')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="account_number" class="form-label">account_number</label>
                                                <input type="text" name="account_number" value="{{ $supplier->account_number }}" class="form-control" @error('account_number') is-invalid   @enderror placeholder="Enter account_number">
                                                @error('account_number')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="bank_name" class="form-label">bank_name</label>
                                                <input type="text" name="bank_name" value="{{ $supplier->bank_name }}" class="form-control" @error('bank_name') is-invalid   @enderror placeholder="Enter bank_name">
                                                @error('bank_name')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="bank_branch" class="form-label">Country</label>
                                                <input type="text" name="bank_branch" value="{{ $supplier->bank_branch }}" class="form-control" @error('bank_branch') is-invalid   @enderror placeholder="Enter Country">
                                                @error('bank_branch')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">city</label>
                                                <input type="text" name="city" value="{{ $supplier->city }}" class="form-control" @error('city') is-invalid   @enderror placeholder="Enter city">
                                                @error('city')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="example-fileinput" class="form-label">Profile Image</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="example-fileinput" class="form-label"></label>
                                            <img id="showImage" src="{{ asset($supplier->image) }}" class="rounded-circle avatar-lg img-thumbnail"
                                            alt="profile-image">
                                        </div>
                                        <!-- end col -->
                                    
                                </div> <!-- end row -->

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end settings content-->
                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->
</div>

<script type="text/javascript">

$(document).ready(function(){
    $('#image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#showImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});
</script>
@endsection