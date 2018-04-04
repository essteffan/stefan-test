@extends("layout")

@section('page_title')Domain @endsection
@section('content')
    <div class="container">
        <div class="content">
            <div class="title">Godaddy Test</div>

            <div class="alert"> </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Id</th>
                    <th scope="col">Domain</th>
                    <th scope="col" class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <form action="{{ route("domain.save") }}" method="post">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        @foreach($domains as $key=>$domain)
                            <tr class="domain_{{ $domain->id }}">
                                <th scope="row">{{ $key +1 }}</th>
                                <td><input type="hidden" class="form-control" name="id[]" value="{{ $domain->id }}">{{ $domain->id }}</td>
                                <td><input type="text" class="form-control" name="name[]" value="{{ $domain->name }}"></td>
                                <td class="text-right">
                                    <a href="{{ route("dns", $domain->id) }}" class="btn btn-default btn-xs"> View</a>
                                    <button type="button" class="btn btn-danger btn-xs deleteDomain" data-id="{{ $domain->id }}" >Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#addNewDomain">Add new entry</a></td>
                            <td colspan="2"><button type="submit" class="btn btn-danger" >save</button></td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addNewDomain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="#" id="form" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new Domain</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script>
        var url = "{{ URL::to('/') }}";

        $("#form").submit(function(e){
            e.preventDefault();
            var id = $('#id').val();
            var name = $('#name').val();
            var type = $('#type').val();
            var value = $('#value').val();
            $.ajax({
                type: "POST",
                url: url + '/api/v1/saveDomain',
                data: {id: id, name: name, type: type, value: value,  _token: "<?php echo csrf_token(); ?>"},
                success: function( msg ) {
                    $("#addNewDomain").modal('toggle');
                    $(".alert").removeClass("alert-danger").addClass("alert-success").html(msg);
                    setTimeout(function(){
                        location.reload();
                    },1000);
                },
                error: function (response) {
                    $(".alert").removeClass("alert-success").addClass("alert-danger").html(response.responseText);
                },
            });
        });

        $(".deleteDomain").on("click", function(){
            var self = $(this);
            var id = self.data("id");
            console.log(id);
            $.ajax({
                type: "DELETE",
                url: url + '/api/v1/deleteDomain',
                data: {id: id,  _token: "<?php echo csrf_token(); ?>"},
                success: function( msg ) {
                    console.log(msg);
                    $(".alert").removeClass("alert-danger").addClass("alert-success").html(msg);
                    $(".domain_"+id).remove();
                    return;
                },
                error: function (response) {
                    $(".alert").removeClass("alert-success").addClass("alert-danger").html(response.responseText);
                },
            });
        });


    </script>
@endsection