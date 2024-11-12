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
                            <li class="breadcrumb-item active">Edit Employee</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Employee</h4>
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
                                <form method="post" action="{{ route('employee.update') }}" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $employee->id }}">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Employee Info</h5>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">First Name</label>
                                                <input type="text" name="name" value="{{ $employee->name }}" class="form-control"  @error('name') is-invalid  @enderror placeholder="Enter first name">
                                                @error('name')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" value="{{ $employee->email }}" class="form-control" @error('email') is-invalid   @enderror placeholder="Enter email">
                                                @error('email')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control" @error('phone') is-invalid   @enderror placeholder="Enter phone">
                                                @error('phone')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" name="address" value="{{ $employee->address }}" class="form-control" @error('address') is-invalid   @enderror placeholder="Enter address">
                                                @error('address')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                    <label for="example-select" class="form-label">Experience</label>
                                                    <select name="experience" class="form-select" id="example-select">
                                                        <option value="1 years">1 years</option>
                                                        <option value="2 years">2 years</option>
                                                        <option value="3 years">3 years</option>
                                                        <option value="4 years">4 years</option>
                                                        <option value="5 years">5 years</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="salary" class="form-label">salary</label>
                                                <input type="text" name="salary" value="{{ $employee->salary }}" class="form-control" @error('salary') is-invalid   @enderror placeholder="Enter salary">
                                                @error('salary')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="vacation" class="form-label">vacation</label>
                                                <input type="text" name="vacation" value="{{ $employee->vacation }}" class="form-control" @error('vacation') is-invalid   @enderror placeholder="Enter vacation">
                                                @error('vacation')
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">city</label>
                                                <input type="text" name="city" value="{{ $employee->city }}" class="form-control" @error('city') is-invalid   @enderror placeholder="Enter city">
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
                                            <img id="showImage" src="{{ asset($employee->image) }}" class="rounded-circle avatar-lg img-thumbnail"
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