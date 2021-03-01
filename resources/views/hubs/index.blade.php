@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <a onclick="addHub()" class="btn btn-rounded btn-info pull-right">{{__('Add New Hub')}}</a>
    </div>
</div><br>
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Manage Hub')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Address')}}</th>
                    <th>{{__('Is Enabled')}}</th>
                    <th>{{__('Is Active')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hubs as $key => $hub)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$hub->name}}</td>
                    <td>{{$hub->address}}</td>
                    <td><label class="switch">
                            <input onchange="update_hub_enable(this)" value="{{ $hub->hub_id }}" type="checkbox"
                                <?php if($hub->web_enabled == 1) echo "checked";?>>
                            <span class="slider round"></span></label>
                    </td>
                    <td><label class="switch">
                            <input onchange="update_hub_active(this)" value="{{ $hub->hub_id }}" type="checkbox"
                                <?php if($hub->is_active == 1) echo "checked";?>>
                            <span class="slider round"></span></label>
                    </td>
                    <td>
                        <div class="btn-group dropdown">
                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown"
                                type="button">
                                {{__('Actions')}} <i class="dropdown-caret"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#" onclick="edit({{$hub->hub_id}})">{{__('Edit')}}</a></li>
                                <li><a href="#"
                                        onclick="confirm_modal('{{route('hubs.destroy', $hub->hub_id)}}');">{{__('Delete')}}</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<!--Edit Modal-->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modalLabel"></h4>
            </div>
            <div class="modal-body">
                <form id="editHubForm">
                    <input type="hidden" id="hubId">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hub Name</label>
                        <input type="text" class="form-control" id="hubName" aria-describedby="emailHelp"
                            placeholder="Enter Hub Name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hub Address</label>
                        <input type="text" class="form-control" id="hubAddress" aria-describedby="emailHelp"
                            placeholder="Enter Hub Address" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Unified Hub</label>
                        <select id="hubUnifiedId" class="form-control" required>
                        </select>
                    </div>

                    <button id="submitBtn" type="submit" class="hide"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button onclick="saveHub()" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!--Add Modal-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Hub</h4>
            </div>
            <div class="modal-body">
                <form id="addHubForm">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token" />
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hub Name</label>
                        <input type="text" class="form-control" name="hub_name" aria-describedby="emailHelp"
                            placeholder="Enter Hub Name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hub Address</label>
                        <input type="text" class="form-control" name="hub_address" aria-describedby="emailHelp"
                            placeholder="Enter Hub Address" required>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="unified_checkbox" class="form-check-input" id="unified_checkbox">
                        <label class="form-check-label" for="exampleCheck1">Unified Hub (Optional)</label>
                    </div>

                    <div id="add_unified_id" class="form-group hide">
                        <label for="exampleInputEmail1">Unified Hub</label>
                        <select name="hub_unified_id" id="add_hubUnifiedId" class="form-control">
                        </select>
                    </div>

                    <button id="add_submitBtn" type="submit" class="hide"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button onclick="submitHubHandler()" type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>

    $("#unified_checkbox").change(function(){
        if(this.checked){
            $("#add_hubUnifiedId").empty();
            $("#add_unified_id").attr('class', 'form-group');
            let hubs = {!!collect($hubs)!!};
                    let options = '';
                    for (let i = 0; i < hubs.length; i++) {
                        options += '<option value="'+ hubs[i].hub_id +'">'+ hubs[i].name +'</option>';
                    }
            $("#add_hubUnifiedId").append(options);
        }
        else{
            $("#add_unified_id").attr('class', 'form-group hide');
        }
    });

    function edit(hub_id){
        $.post('{{ route('hubs.edit') }}',{_token:'{{ csrf_token() }}', hub_id:hub_id}, function(data){
                if(data){
                    $("#hubUnifiedId").empty();
                    $("#modalLabel").text("Edit Hub");
                    $("#hubName").val(data.name);
                    $("#hubId").val(data.hub_id);
                    $("#hubAddress").val(data.address);
                    $('#modal').modal('toggle');

                    let hubs = {!!collect($hubs)!!};
                    let options = '';
                    for (let i = 0; i < hubs.length; i++) {
                        if(data.unified_hub_id == hubs[i].hub_id){
                            options += '<option value="'+ hubs[i].hub_id +'" selected>'+ hubs[i].name +'</option>';
                        }
                        else{
                            options += '<option value="'+ hubs[i].hub_id +'">'+ hubs[i].name +'</option>';
                        }
                    }
                    $("#hubUnifiedId").append(options);
                }
        });
    }

    function addHub(){
        $('#addModal').modal('toggle');
    }

    function saveHub(){
        var form = $('#editHubForm');

        // Trigger HTML5 validity.
        var reportValidity = form[0].reportValidity();

        // Then submit if form is OK.
        if(reportValidity){
            $.post('{{ route('hubs.update') }}',{_token:'{{ csrf_token() }}',
                    hub_id: $("#hubId").val(),
                    hub_name: $("#hubName").val(),
                    hub_address: $("#hubAddress").val(),
                    unified_hub_id: $("#hubUnifiedId").val()}, function(data){
                if(data){
                    location.reload();
                }
            });
        }
    }

    function submitHubHandler(){
        var form = $('#addHubForm');

        // Trigger HTML5 validity.
        var reportValidity = form[0].reportValidity();

        // Then submit if form is OK.
        if(reportValidity){
            $.ajax({
                type:"POST",
                url:'{{ route('hubs.store') }}',
                data:$('#addHubForm').serialize(),
                success: function(data){
                    if(data){
                        location.reload();
                    }
                }
            });
        }

    }

    function update_hub_enable(el){
        if(el.checked){
          var status = 1;
        }
        else{
          var status = 0;
        }
        $.post('{{ route('hubs.update_enable') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
          if(data == 1){
            location.reload();
          }
          else{
            showAlert('danger', 'Something went wrong');
          }
        });
    }

    function update_hub_active(el){
        if(el.checked){
          var status = 1;
        }
        else{
          var status = 0;
        }
        $.post('{{ route('hubs.update_active') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
          if(data == 1){
            location.reload();
          }
          else{
            showAlert('danger', 'Something went wrong');
          }
        });
    }
</script>

@endsection
