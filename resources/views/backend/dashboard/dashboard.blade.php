@extends('backend.layouts.app')

@section('content')
<div class="row"> 
    <div class="col-md-4 col-sm-3">
        <div class="card">
            <div class="card-body">  
                <h4 class="header-title mt-0 mb-4">Earnings</h4> 
                <div class="widget-chart-1">
                    <div class="  float-start " dir="ltr">
                       <div class="btn btn-soft-primary waves-effect waves-light fs-40">
                           <i class="mdi mdi-cash-multiple"></i>
                       </div>
                    </div>

                    <div class="widget-detail-1 text-end">
                        <h2 class="fw-normal pt-2 mb-1"> $256.00 </h2>
                        <p class="text-muted mb-1">Total Earnings</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
    <div class="col-md-4 col-sm-3">
        <div class="card">
            <div class="card-body">  
                <h4 class="header-title mt-0 mb-4">Customers</h4> 
                <div class="widget-chart-1">
                    <div class="  float-start " dir="ltr">
                       <div class="btn btn-soft-success waves-effect waves-light fs-40">
                           <i class="mdi mdi-account-group-outline"></i>
                       </div>
                    </div>

                    <div class="widget-detail-1 text-end">
                        <h2 class="fw-normal pt-2 mb-1"> 340 </h2>
                        <p class="text-muted mb-1">Total Customers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
    <div class="col-md-4 col-sm-3">
        <div class="card">
            <div class="card-body">  
                <h4 class="header-title mt-0 mb-4">Events</h4> 
                <div class="widget-chart-1">
                    <div class="  float-start " dir="ltr">
                       <div class="btn btn-soft-info waves-effect waves-light fs-40">
                           <i class="mdi mdi-cash-multiple"></i>
                       </div>
                    </div> 
                    <div class="widget-detail-1 text-end">
                        <h2 class="fw-normal pt-2 mb-1"> 541 </h2>
                        <p class="text-muted mb-1">Total Events</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
   
    <!-- end col --> 
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">  
                <h4 class="header-title mt-0 mb-4">Latest Events</h4> 
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr> 
                            <th>Title</th>
                            <th>Client</th>
                            <th> Date</th>
                            <th>Event Location</th>
                            <th>Video </th> 
                            <th>Note</th> 
                            <th>Action</th> 
                        </tr>
                        </thead>
                        <tbody>
                            <tr> 
                                <td>Iphon 11 Pro v1</td>
                                <td> 
                                    <span class="badge bg-primary">Rs Rafi</span>
                                </td>
                                <td>01/01/2022</td>
                                <td> Diplomatic Zone, United Nations Rd, Dhaka 1212 </td> 
                                <td>2</td>
                                <td> </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-soft-success "><i class="fe-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-soft-danger"><i class="fe-trash-2"></i></a>
                                </td>
                            </tr>
                            <tr> 
                                <td>Iphon 11 Pro v1</td>
                                <td> 
                                    <span class="badge bg-primary">Rs Rafi</span>
                                </td>
                                <td>01/01/2022</td>
                                <td> Diplomatic Zone, United Nations Rd, Dhaka 1212 </td> 
                                <td>2</td>
                                <td> </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-soft-success "><i class="fe-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-soft-danger"><i class="fe-trash-2"></i></a>
                                </td>
                            </tr>
                            <tr> 
                                <td>Iphon 11 Pro v1</td>
                                <td> 
                                    <span class="badge bg-primary">Rs Rafi</span>
                                </td>
                                <td>01/01/2022</td>
                                <td> Diplomatic Zone, United Nations Rd, Dhaka 1212 </td> 
                                <td>2</td>
                                <td> </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-soft-success "><i class="fe-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-soft-danger"><i class="fe-trash-2"></i></a>
                                </td>
                            </tr>
                            <tr> 
                                <td>Iphon 11 Pro v1</td>
                                <td> 
                                    <span class="badge bg-primary">Rs Rafi</span>
                                </td>
                                <td>01/01/2022</td>
                                <td> Diplomatic Zone, United Nations Rd, Dhaka 1212 </td> 
                                <td>2</td>
                                <td> </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-soft-success "><i class="fe-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-soft-danger"><i class="fe-trash-2"></i></a>
                                </td>
                            </tr>
                            <tr> 
                                <td>Iphon 11 Pro v1</td>
                                <td> 
                                    <span class="badge bg-primary">Rs Rafi</span>
                                </td>
                                <td>01/01/2022</td>
                                <td> Diplomatic Zone, United Nations Rd, Dhaka 1212 </td> 
                                <td>2</td>
                                <td> </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-soft-success "><i class="fe-edit"></i></a>
                                    <a href="#" class="btn btn-sm btn-soft-danger"><i class="fe-trash-2"></i></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
 

</div>
<!-- end row -->
@endsection