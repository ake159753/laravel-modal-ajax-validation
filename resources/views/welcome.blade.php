<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

<div class="container-fluid d-flex justify-content-center">
    <button class="btn btn-outline-success" onclick="openModal();">add</button>
</div>


<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Firstname</label>
                    <input class="form-control col-12" type="text" id="firstname">
                    <span class="text-danger" id="firstnameError"></span>
                </div>

                <div class="form-group">
                    <label>Lastname</label>
                    <input class="form-control col-12" type="text" id="lastname">
                    <span class="text-danger" id="lastnameError"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="storeData();">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    function openModal() {
        $('#userModal').modal('show')
    }
    function storeData() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        $('#firstnameError').addClass('d-none');
        $('#lastnameError').addClass('d-none');
        $.ajax({
            type: 'POST',
            url: "{{route('store')}}",
            data: {_token: CSRF_TOKEN,
                firstname:firstname,
                lastname:lastname,
            },
            success: function (data) {
            },
            error: function (data) {
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
    }
</script>
</body>
</html>

