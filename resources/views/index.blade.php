@extends('admin_dashboard')
@section('admin')
    
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                       
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            @php
    $month = date("F");
    $expensemonth = App\Models\Expense::where('month',$month)->sum('amount');
    @endphp

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-primary border-primary border shadow">
                                        <i class="fe-heart font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1">$<span data-plugin="counterup">{{ $expensemonth }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Total expense</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                                        <i class="fe-users font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                    @php
                                    $employeeCount = App\Models\Employee::count(); // Assuming you have an Employee model
                                    @endphp

                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $employeeCount }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Employees</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                                        <i class="fe-users font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                    @php
                                    $customerCount = App\Models\Customer::count(); // Dynamically fetch customer count
                                    @endphp

                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $customerCount }}</span></h3>
                                        <p class="text-muted mb-1  text-truncate">Customers</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                                <i class="fe-eye font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                        <div class="text-end">
                                        @php
                                    $supplierCount = App\Models\Supplier::count(); // Dynamically fetch supplier count
                                    @endphp

                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $supplierCount }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Instructor</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

           

</div> <!-- container -->

</div> <!-- content -->


             <!-- Start Content-->
             <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        
                                    </div>
                                    <h4 class="page-title">All training</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                     
                    
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>instructor</th>
                                <th>Code</th>
                                <th>Price</th>
                                
                            </tr>
                        </thead>
                    
    
         <tbody> 
        	@foreach($product as $key=> $item)
            @if ($item['category'] && $item['supplier']) <!-- Ensure both are not null -->
            <tr>
                <td>{{ $key+1 }}</td>
                <td> <img src="{{ asset($item->product_image) }}" style="width:50px; height: 40px;"> </td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item['category']['category_name'] }}</td>
                <td>{{ $item['supplier']['name'] }}</td>
                
                <td>{{ $item->product_code }}</td>
                <td>{{ $item->selling_price }}</td>
              
            </tr>
            @endif
            @endforeach
        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    
</div> <!-- container -->

</div> <!-- content -->

    @endsection

