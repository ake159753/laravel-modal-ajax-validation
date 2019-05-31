@extends('layouts.app')

@section('content')

    <div class="container">
        @include('navigation.navigation')
        <p class="text-danger mt-2">Bootstrap Table with: add record by modal, ajax post validation, dynamicly adding data, ajax live search and ajax live insert without page refresh.</p>
    </div>

    <div class="container  mt-2">
        <input id="fisstnameSearch" type="search" placeholder="Firstname" class="form-control-sm col-2 d-inline" onkeyup="firstNameSearch(this)">
        <input id="lastnameSearch" type="search" placeholder="Lastname" class="form-control-sm col-2 d-inline" onkeyup="firstNameSearch(this)">
        <button class="btn btn-sm btn-outline-success" onclick="openModal();" disabled>add by modal</button>
        <button class="btn btn-sm btn-outline-primary add-row">add dynamicly</button>
        <button class="btn btn-sm btn-outline-success"  id ="JSopenModal">add JQ genModal</button>
        <div id="recordsTable">
            @include('recordsTable')
        </div>
        @include('insertModal')
        @include('editModal')
    </div>
    <script>

        $(document).ready(function(){

            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page)
            {
                const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                const firstname = $("#fisstnameSearch").val();
                const lastname = $("#lastnameSearch").val();
                $.ajax({
                    url:"/pagination/fetch_data?page="+page,
                    data:{_token: CSRF_TOKEN,
                        firstname:firstname,
                        lastname:lastname,
                    },
                    success:function(data)
                    {
                        $('#recordsTable').html(data);
                    }
                });
            }

        });

        function firstNameSearch(arg){
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            const firstname = $("#fisstnameSearch").val();
            const lastname = $("#lastnameSearch").val();
            $.ajax({
                type: 'GET',
                url: "/search",
                data:{_token: CSRF_TOKEN,
                    firstname:firstname,
                    lastname:lastname,
                },
                success: function (data) {
                    $('#recordsTable').html(data);
                },
                error: function (data) {

                }
            });
            console.log(firstname);
        }


        $("#JSopenModal").click(function (){
            event.preventDefault();
            $("#JSmodalBody").empty();
            const firstName = "<div class='form-group'><label>Firstname</label><input class='form-control col-12' type='text' id='firstname' name='firstname'><span class='text-danger' id='firstnameError'></span></div>";
            const lastName = "<div class='form-group'><label>Lastname</label><input class='form-control col-12' type='text' id='lastname' name='lastname'><span class='text-danger' id='lastnameError'></span></div>";
            const birthDate = "<div class='form-group'><label>Birth Date</label><input class='form-control col-12' type='date' id='birthdate' name='birthdate'><span class='text-danger' id='birthdateError'></span></div>";
            const status = "<div class='form-group'><label>Status</label><select class='form-control' id='status' name='status'><option></option><option value='Active'>Active</option><option value='Disabled'>Disabled</option></select> <span class='text-danger' id='statusError'></span></div>";
            const cv = "<div class='form-group'><label>CV (pdf)</label><input class='form-control-file col-12' type='file' id='cv' name='cv'><span class='text-danger' id='cvError'></span></div>";
            $("#JSmodalBody").append(firstName, lastName, birthDate, status, cv);
            $('#JSmodal').modal('show')
        });


        //open Modal JSopenModal
        function openModal() {
            $('#userModal').modal('show')
        }
        function editRecord(arg) {
            $('#editModal').modal('show');
            var id = $(arg).attr('data-id');
            var firstname = $(arg).attr('data-firstname');
            var lastname = $(arg).attr('data-lastname');
            var birthdate = $(arg).attr('data-birthdate');
            var status = $(arg).attr('data-status');
            $("#editId").val(id);
            $("#editFirstname").val(firstname);
            $("#editLastname").val(lastname);
            $("#editBirthdate").val(birthdate);
            $("#editStatus").val(status);
        }


        $("#recordsTable").on('click', '.addtrid', function (arg) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id =  "tr" + Math.floor(Math.random() * 999999) + 1;
            $(this).closest('tr').attr("id",id); //add this <tr> random id
            var tr = document.getElementById(id);
            var td = tr.getElementsByTagName("td");
            var tdarr1 = td[1];
            var input = tdarr1.getElementsByTagName("input");
            var inputFirstname = input[0].value;
            var tdarr2 = td[2];
            var input2 = tdarr2.getElementsByTagName("input");
            var inputLastname = input2[0].value;
            var tdarr3 = td[3];
            var input3 = tdarr3.getElementsByTagName("input");
            var inputdate = input3[0].value;
            var selectarr = td[4];
            var input4 = selectarr.getElementsByTagName("select");
            var inputstatus = input4[0].value;
            var tdarr5 = td[5];
            var input5 = tdarr5.getElementsByTagName("input");
            var inputcv = input5[0].files[0];
            var formData = new FormData();
            formData.append('id', id);
            formData.append('firstname', inputFirstname);
            formData.append('lastname', inputLastname);
            formData.append('birthdate', inputdate);
            formData.append('status', inputstatus);
            formData.append('cv', inputcv);
            console.log(formData);

            $.ajax({
                type: 'POST',
                url: "{{route('storeDynamicly')}}",
                data:formData,
                enctype: 'multipart/form-data',
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#recordsTable').html(data.html); //reload only table
                    //or ### location.reload(); ### to reload page
                },
                error: function (data) {

                }
            });
        });



        //dynamicly add <tr>
        $(document).ready(function(){
            $(".add-row").click(function(){
                var addTbody = "<tbody><tr><td><button class='btn btn-sm btn-outline-success addtrid'>save field</button> <button class='btn btn-sm btn-outline-danger btnDelete'>remove</button></td><td><input class='form-control-sm col' type=text id='firstname' name='firstname'></td><td><input class='form-control-sm col' type=text id='lastname' name='lastname'></td><td><input class='form-control-sm col' type=date id='birthdate' name='birthdate'></td><td><select  class='form-control-sm'  id='status' name='status'><option></option><option value='Active'>Active</option><option value='Disabled'>Disabled</option><select></td><td><input class='form-control-sm col' type=file id='cv' name='cv'></td></tr></tbody>";
                $("table").append(addTbody);
            });
        });
        //Remove dynamicly added <tr>
        $("#recordsTable").on('click', '.btnDelete', function () {
            $(this).closest('tr').remove();
        });

        //edit record with ajax post method(edit modal)
        $("#editRecord").on('submit', function(event){
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{route('update')}}",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#editModal').modal('hide');
                    $('#recordsTable').html(data.html); //reload only table
                    //or ### location.reload(); ### to reload page
                },
                error: function (data) {
                    $('#editFirstnameError').addClass('d-none');
                    $('#editLastnameError').addClass('d-none');
                    $('#editBirthdateError').addClass('d-none');
                    $('#editStatusError').addClass('d-none');
                    $('#editCvError').addClass('d-none');
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




        //create record with ajax post method
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
                    $('#JSmodal').modal('hide');
                   /* $('#userModal').modal('hide');*/
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
        //live updating table <tr> data with ajax post method
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
        //remove record with ajax post method
        function deleteRecord(arg) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var id = arg.id;

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'POST',
                            url: "{{route('deleteRecord')}}",
                            data:{_token: CSRF_TOKEN,
                                id:id,
                            },
                            dataType:'JSON',
                            success: function (data) {
                                swal("success! The record file has been deleted!", {
                                    icon: "success",
                                })
                                    .then(
                                        $('#recordsTable').html(data.html)
                                    )
                            }
                        });
                    } else {
                        swal("operation canceled!");
                    }
                });
        }
    </script>

@endsection

