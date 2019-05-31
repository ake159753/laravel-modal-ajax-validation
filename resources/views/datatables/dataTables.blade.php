@extends('layouts.app')

@section('content')

    <div class="container">
        @include('navigation.navigation')
    </div>
    <div class="container  mt-2">

        <table id="dataTable" class="table table-sm table-bordered table-hover">
            <thead>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </thead>
            <thead class="bg-info text-white">
            <tr>
                <td>Firstname</td>
                <td>Lastname</td>
                <td>Birth Date</td>
                <td>Status</td>
                <td>CV (pdf)</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

    <script>
        $(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('getData')}}',
                columns: [
                    { data: 'firstname', name: 'firstname' },
                    { data: 'lastname', name: 'lastname' },
                    { data: 'birthdate', name: 'birthdate' },
                    { data: 'status', name: 'status' },
                    { data: 'cv', name: 'cv' }
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.header()).empty())
                            .on('keyup', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    });
                }
            });
        });
    </script>
@endsection
