@extends('layouts.app')
@section('title')Dashboard @endsection
{{-- <link href="{{asset('css/style.css') }}" rel="stylesheet"> --}}
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12 mt-2">
         <div class="card w-100">
            <div class="card-body">
               <h3>Company List</h3>
            </div>
         </div>
         <div id="messageContainer" style="margin-top: 2%; opacity: 0; transition: opacity 3s ease;">
              @if(session('message'))
              <div class="alert alert-success" style="background-color: #008039; border-color: #a94442;color: #fff; font-weight: 700px;">
                  {{ session('message') }}
              </div>
              @endif
              @if(session('error'))
              <div class="alert alert-danger" style="background-color: #802300; border-color: #a94442;color: #fff; font-weight: 700px;">
                  {{ session('error') }}
              </div>
              @endif
          </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-12 mt-5">
         <div class="card w-100">
            <div class="card-body">
               
               <button class="float-right btn btn-success" data-toggle="modal" data-target="#addNewOption">+ Add Company</button>
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>S.no</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Company</th>
                        <th>Created Date</th>
                        <th id="classToInclude">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i=1; ?>
                     @foreach ($data as $new)
                     <tr>
                        <td>{{$i}}</td>
                        <td>{{$new->name}}</td>
                        <td>{{$new->email}}</td>
                        <td>
                           @if($new->logo) 
                           <img style="height:50px;width:50px;"   src="{{env('APP_URL')}}/storage/app/public/company_logo/{{$new->logo}}" alt=""class="thumbnail">
                           @else
                           <img style="height:50px;width:50px;" class="thumbnail" src="https://demo.equalinfotech.com/turner/public/userimage/1682251853.jpg" alt=""class="thumbnail">
                           @endif
                        </td>
                        <td>{{$new->website}}</td>
                         <td>{{ date('d-m-Y', strtotime($new->created_at)) }}</td>

                        <td>
                           <div id="custom-styling">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 102px;">
                                <i class="fas fa-cogs"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item btn btn-success"data-toggle="modal" data-target="#myModal" onclick="showmodal('{{$new->id}}','{{$new->name}}','{{$new->email}}','{{$new->logo}}', '{{$new->website}}');"><i class="fas fa-edit"></i> Edit</button>
                                <a class="dropdown-item" href="{{ route('companies.destroy', $new->id) }}" onclick="return confirm('Are you sure you want to delete this company?')">
                                 <i class="fas fa-trash-alt"></i> Delete
                             </a>
                             
                                <a class="dropdown-item "  href="{{ route('companies.store', $new->id) }}" style=""><i class="fa fa-eye" ></i> View</a>
                                
                            </div>
                        </div>
                        </td>
                        <?php $i++; ?>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="col-md-1"></div>
   </div>
</div>

<!-- add new option -->
<div class="modal fade" id="addNewOption" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Company</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form  method="POST" action="{{route('companies.store')}}" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name" required>
               </div>
               <div class="form-group">
                  <label for="">Email</label>
                  <input type="email" class="form-control" name="email">
                  </div>
               <div class="form-group">
                  <label for="">Logo</label>
                  <input type="file" class="form-control" name="logo">
               </div>
               <div class="form-group">
                  <label for="">Website</label>
                  <input type="text" class="form-control" name="website">
               </div>
                 
               <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header ">
            <h3 >Edit Company</h3>
         </div>

         <?php 
         $id = '1';
         ?>

         <div class="modal-body">
            <form action="{{route('companies.update', $id)}}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')
               <input type="hidden" id="id" name="id">
               <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" id="editname"  class="form-control" require>
               </div>
               <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" name="email" id="editemail"  class="form-control">
               </div>
               <div class="form-group">
                  <label for="">Logo</label>
                  <input type="file" name="logo" id="editlogo"  class="form-control">
               </div>
               <div class="form-group">
                  <label for="">Website</label>
                  <input type="text" name="website" id="editwebsite"  class="form-control">
               </div>
               <button type="submit" class="btn btn-info">Submit</button>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<!-- Modal content-->
@endsection
@section('commscript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script src="{{asset('new_js/js.csript.js')}}"></script>

  
@endsection