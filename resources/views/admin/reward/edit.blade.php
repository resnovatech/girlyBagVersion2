@extends('admin.master.master')
@section('title')
Dashboard
@endsection


@section('body')
<div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title-box">
                                <h4 class="font-size-18">Reward Point Name</h4>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Resnova</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                    <li class="breadcrumb-item active">Update Reward Point Name</li>
                                </ol>
                            </div>
                        </div>

                       
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                <form class="custom-validation" action="{{ route('admin.reward.update') }}" method="post">
                            @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                          
                                                <div class="form-group ">
                                                    <label>Reward Point Name:</label>
                                                    <input type="text" class="form-control" name="name" value="{{$cats->name}}"/>
                                                    <input type="hidden" class="form-control" name="id" value="{{$cats->id}}"/>
                                                </div>



                                                <div class="form-group ">
                                                    <label>Reward Point:</label>
                                                    <input type="text" class="form-control" name="point" value="{{$cats->point}}"/>
                                                </div>



                                                <div class="form-group ">
                                                    <label>Amount:</label>
                                                    <input type="text" class="form-control" name="amount" value="{{$cats->amount}}" />
                                                </div>


                                                <div class="form-group ">
                                                <label for="password">Status</label>
                                <select name="status" id="roles" class="form-control">
                                    
                                <option value="1" {{ $cats->status == 1 ? 'selected':'' }}>Active</option>
                <option value="0" {{ $cats->status == 0 ? 'selected':'' }}>InActive</option>
                                   
                                </select>
                                                </div>


                                               

                                            </div>
                                        </div>

                                    </div> <!-- end col -->


                                    <div class="col-lg-12">
                                        <div class="float-right d-none d-md-block">
                                            <div class="form-group mb-4">
                                                <div>
                                                    <button type="submit" class="btn btn-primary btn-lg  waves-effect waves-light mr-1">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </form>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
 
@endsection

@section('scripts')


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

 
  

