@extends('layouts.app')

@section('content')

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link text-white font-weight-bold" href="#">Ajax</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Pricing</a>
                    </li>

                </ul>
            </div>
        </nav>
        <p class="text-danger mt-2">Table with ajax post, validation, errors, live search, live insert. without page refresh.</p>
    </div>
    <div class="container  mt-2">
        <button class="btn btn-sm btn-outline-success" onclick="openModal();">add</button>
        <div id="recordsTable">
            @include('recordsTable')
        </div>
        @include('insertModal')
    </div>
    <script>
        function openModal() {
            $('#userModal').modal('show')
        }

        $("#createRecord").on('submit', function(event){
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{route('store')}}",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#userModal').modal('hide');
                    $('#recordsTable').html(data.html); //reload only table
                    //or ### location.reload(); ### to reload page
                },
                error: function (data) {
                    $('#firstnameError').addClass('d-none');
                    $('#lastnameError').addClass('d-none');
                    $('#birthdateError').addClass('d-none');
                    $('#statusError').addClass('d-none');
                    $('#cvError').addClass('d-none');
                    var errors = data.responseJSON;
                    if($.isEmptyObject(errors) == false) {
                        $.each(errors.errors,function (key, value) {
                            var ErrorID = '#' + key +'Error';
                            $(ErrorID).removeClass("d-none");
                            $(ErrorID).text(value)
                        })
                    }
                }
            });
        });

        function liveInsert(arg) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = arg.id;
            var name = $(arg).attr('data-name');
            var input = arg.value;
            $.ajax({
                type: 'POST',
                url: "{{route('livestore')}}",
                data:{_token: CSRF_TOKEN,
                    id:id,
                    name:name,
                    input:input,
                },
                dataType:'JSON',
                success: function (data) {
                    $('#recordsTable').html(data.html);
                }
            })

        }

    </script>

@endsection
