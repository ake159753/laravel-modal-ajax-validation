<div class="container col-12 col-md-6  p-2 table-bordered mb-5">
    <form action="{{route('addRecord')}}" method="post" enctype="multipart/form-data">
        @CSRF
        <div class="row col-12 col-md-8 justify-content-center offset-md-2">
            @foreach($fields as $field)
                <lable class="{{$field->field_lable_class}}" for="{{$field->field_id}}">{{$field->fieldLable}}</lable>
                <div class="input-group col-12 p-1">
                    @if($field->field_type == "text")
                        <textarea type="{{$field->field_type}}" class="{{$field->fieldClass}}" name ="{{$field->fieldName}}" ></textarea>
                    @else
                        <input type="{{$field->feildType}}" class="{{$field->fieldClass}}" name ="{{$field->fieldName}}">
                    @endif
                        <div class="input-group-append" ng-if="show > 0">
                            <button class="btn btn-sm btn-primary" type="button" id="{{$field->id}}"
                                    data-name="{{$field->fieldName}}" onclick="editField(this)"><i class="fas fa-pen"></i></button>
                        </div>
                    <div class="input-group-append" ng-if="show > 0">
                        <button class="{{$field->field_btn_del}}" type="button" id="{{$field->id}}"
                                data-name="{{$field->fieldName}}" onclick="deleteField(this)"><i class="fas fa-trash"></i></button>
                    </div>

                </div>
            @endforeach
            <button class="btn btn-outline-danger m-1" type="submit">save changes</button>
        </div>
    </form>
</div>
