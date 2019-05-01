<table class="table table-sm table-bordered">
    <thead class="bg-info text-white">
    <tr>
        <td>Action</td>
        <td>Firstname</td>
        <td>Lastname</td>
        <td>Birth Date</td>
        <td>Status</td>
        <td>CV (pdf)</td>
    </tr>
    </thead>
    @foreach($personal as $value)
        <tbody>
        <tr>
            <td><button class="btn btn-sm btn-outline-warning">edit</button> <button class="btn btn-sm btn-outline-danger">delete</button></td>
            <td>@if ($value->status == 'Disabled'){{$value->firstname}}
                @else <input class="form-control-sm col" type="text" id="{{$value->id}}" data-name="firstname" value="{{$value->firstname}}" onkeyup="liveInsert(this);"> @endif</td>
            <td>@if ($value->status == 'Disabled'){{$value->lastname}}
                @else <input class="form-control-sm col" type="text" id="{{$value->id}}" data-name="lastname" value="{{$value->lastname}}" onkeyup="liveInsert(this);"> @endif</td>
            <td>@if ($value->status == 'Disabled'){{$value->birthdate}}
                @else <input class="form-control-sm col" type="date" id="{{$value->id}}" data-name="birthdate" value="{{$value->birthdate}}" onchange="liveInsert(this);"> @endif</td>
            <td><select class="form-control-sm" id="{{$value->id}}" data-name="status" onchange="liveInsert(this);">
                    <option value="{{$value->status}}">{{$value->status}}</option>
                    <option value="Active">Active</option>
                    <option value="Disabled">Disabled</option>
                </select></td>
            <td><a href="{{ $url = Storage::url('upload/cv/'.$value->cv) }}">
                    @php
                        if ($value->cv !='')

                            echo ("show cv")
                    @endphp
                </a></td>

        </tr>
        </tbody>
    @endforeach
</table>
