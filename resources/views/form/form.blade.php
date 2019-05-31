@extends('layouts.app')
@section('content')
    <div class="container">
        @include('navigation.navigation')
    </div>
    <div class="container col-12 col-md-6  p-2 table-bordered mt-5">
        <label>Edit Input Fields:</label>
        <div class="custom-control custom-switch d-inline">
            <input id="permition" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-onstyle="danger" data-offstyle="info"  ng-model="show" >
        </div>
    </div>
    <div id="formInput">
        @include('form.input')
    </div>

    <div class="container col-md-6 p-1 table-bordered" ng-if="show > 0">
        <h4 class="col-12 text-center">Add New Field</h4>

        <form id="createField" action="{{route('addField')}}" method="post" enctype="multipart/form-data" >
            @CSRF
            <div class="row">
                <div class="form-group col-md-8 col-12 offset-md-2">
                    <lable>Field Lable </lable>
                    <input type="text" class="form-control @if ($errors->has('fieldLable')) is-invalid @endif" name="fieldLable">
                    @if ($errors->has('fieldLable'))
                        <small class="text-center text-danger">{{ $errors->first('fieldLable') }}</small>
                    @endif
                </div>

                <div class="form-group col-md-8 col-12 offset-md-2">
                    <lable>Field Name</lable>
                    <input type="text" class="form-control @if ($errors->has('fieldName')) is-invalid @endif" name="fieldName">
                    @if ($errors->has('fieldName'))
                        <small class="text-center text-danger">{{ $errors->first('fieldName') }}</small>
                    @endif
                </div>

                <div class="form-group col-md-8 col-12 offset-md-2" id="feildType">
                    <lable>Field Type</lable>
                    <select  class="form-control @if ($errors->has('feildType')) is-invalid @endif"
                             id="feildType" name="feildType" ng-model="decimal">
                        <option></option>
                        <option value="varchar">small text</option>
                        <option value="text">large text</option>
                        <option value="decimal">decimal</option>
                        <option value="date">date</option>
                        <option value="checkbox">checkbox</option>
                    </select>

                    @if ($errors->has('feildType'))

                        <small class="text-center text-danger">{{ $errors->first('feildType') }}</small>

                    @endif
                </div>
                <div class="form-group col-md-2 col-12 " id="field_length_col" ng-if="decimal == 'decimal'">
                    <lable>Size</lable>
                    <select class="form-control" id="field_length" name="field_length">
                        <option value="6">6,2</option>
                        <option value="8">8,2</option>
                    </select>
                </div>

                <div class="form-group col-md-8 col-12 offset-md-2">
                    <lable>Field Style</lable>
                    <select class="form-control @if ($errors->has('fieldClass')) is-invalid @endif" name="fieldClass">
                        <option selected value="form-control col-auto">medium</option>
                        <option value="form-control-sm col-auto">small</option>
                        <option value="form-control-lg col-auto">Big</option>
                    </select>
                    @if ($errors->has('fieldClass'))

                        <small class="text-center text-danger">{{ $errors->first('fieldClass') }}</small>

                    @endif
                </div>
            </div>
            <div class=" d-flex justify-content-center">
                <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
            </div>
        </form>
    </div>
    <script>
        function editField() {
            alert("not ready yet")
        }

        function deleteField(arg) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = arg.getAttribute('id');
            var fieldName = arg.getAttribute('data-name');

            swal({
                title: "Are you sure?",
                text: "If you Delete this field all data afected to this field will be lost!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('delField')}}",
                            type: 'POST',
                            data: {_token: CSRF_TOKEN, deleteId: id, deleteField: fieldName},
                            success: function (data) {
                                swal("Poof! field is deleted Databace field id Droped", {
                                    icon: "success",
                                })
                                    .then(json => {
                                        $('#formInput').html(data.html);
                                    })
                            }
                        });

                    }
                });
        }
    </script>
@endsection
