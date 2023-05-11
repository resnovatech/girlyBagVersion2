@extends('admin.master.master')
@section('title')
User
@endsection


@section('body')

<div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title-box">
                                <h4 class="font-size-18">User</h4>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="index.php">Resnova</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">User List</a></li>
                                    <li class="breadcrumb-item"><a href="#">Update User</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                    <form action="{{ route('admin.users.update') }}" method="POST">
                      
                      @csrf
                      <div class="form-row">
                          <div class="form-group col-md-6 col-sm-12">
                              <label for="name">User Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $user->name }}">

              <input type="hidden" class="form-control" id="name" name="id" placeholder="Enter Name" value="{{ $user->id }}">
                          </div>
                          <div class="form-group col-md-6 col-sm-12">
                              <label for="email">User Email</label>
                              <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $user->email }}">
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-md-6 col-sm-12">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                          </div>
                          <div class="form-group col-md-6 col-sm-12">
                              <label for="password_confirmation">Confirm Password</label>
                              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-md-6 col-sm-12">
                              <label for="password">Assign Roles</label>
                              <select name="roles[]" id="roles" class="form-control" multiple>
                                  @foreach ($roles as $role)
                                      <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      
                      <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update User</button>
                  </form>

                                    </div>

                                </div>
                            </div>

                            


                            

                          
                        </div> <!-- end col -->
                    



                </div> <!-- container-fluid -->
            </div>




 
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>

     <script>
    /**
         * Check all the permissions
         */
         $("#checkPermissionAll").click(function(){
             if($(this).is(':checked')){
                 // check all the checkbox
                 $('input[type=checkbox]').prop('checked', true);
             }else{
                 // un check all the checkbox
                 $('input[type=checkbox]').prop('checked', false);
             }
         });
         function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');
            if(groupIdName.is(':checked')){
                 classCheckBox.prop('checked', true);
             }else{
                 classCheckBox.prop('checked', false);
             }
            implementAllChecked();
         }
         function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            const classCheckbox = $('.'+groupClassName+ ' input');
            const groupIDCheckBox = $("#"+groupID);
            // if there is any occurance where something is not selected then make selected = false
            if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
                groupIDCheckBox.prop('checked', true);
            }else{
                groupIDCheckBox.prop('checked', false);
            }
            implementAllChecked();
         }
        
</script>

@endsection

 
  

