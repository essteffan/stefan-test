@extends("layout")

@section('page_title')Domain DNS @endsection
@section('content')
    <div class="container">
        <div class="content">
            <div class="title">Domain: {{ $domain->name }}</div>
                <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Type</th>
                    <th scope="col">IP</th>
                    <th scope="col">Domain</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    <div class="message alert "> </div>
                    <form action="#" method="post">
                        <!-- CSRF Token -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        @foreach($dns as $key=>$item)
                            <tr class="item_{{ $item->id }}">
                                <input type="hidden" name="id[]" value="{{ $item->id }}">
                                <th scope="row">{{ $key +1 }} <input type="hidden" name="domain_id[]" value="{{ $item->domain_id }}"></th>
                                <td>
                                    <input type="text" name="name[]" class="form-control" value="{{ $item->name }}">
                                </td>
                                <td>
                                    <select id="type" name="type[]" class="form-control">
                                        <option @if($item->type == 'A') selected @endif value="A">A</option>
                                        <option @if($item->type == 'AAAA') selected @endif value="AAAA">AAAA</option>
                                        <option @if($item->type == 'CNAME') selected @endif value="CNAME">CNAME</option>
                                        <option @if($item->type == 'SRV') selected @endif value="SRV">SRV</option>
                                        <option @if($item->type == 'TXT') selected @endif value="TXT">TXT</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="value[]" class="form-control" value="{{ $item->value }}"
                                </td>
                                <td>
                                    <a href="#" class="btn btn-xs btn-danger deleteItem" data-id="{{ $item->id }}"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#addNewItem">Add new entry</a></td>
                            <td colspan="2"><button type="submit" class="btn btn-danger" >save</button></td>
                        </tr>
                        <tr>
                            <td colspan="5"><a href="{{ route("home") }}" class="btn btn-default">Go back</a></td>
                        </tr>
                    </form>
                </tbody>
            </table>


            <!-- Modal -->
            <div class="modal fade" id="addNewItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="#" id="form" method="post">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">

                                            <!-- CSRF Token -->
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <input type="hidden" name="id" id="id" value="{{ $domain->id }}">

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="type">Type</label>
                                                <select id="type" class="form-control">
                                                    <option selected="selected" value="A">A</option>
                                                    <option value="AAAA">AAAA</option>
                                                    <option value="CNAME">CNAME</option>
                                                    <option value="SRV">SRV</option>
                                                    <option value="TXT">TXT</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="value">IP</label>
                                                <input type="text" name="value" class="form-control" id="value" value="">
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
                url: url + '/api/v1/saveDNS',
                data: {id: id, name: name, type: type, value: value,  _token: "<?php echo csrf_token(); ?>"},
                success: function( msg ) {
                    $("#addNewItem").modal('toggle');
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

        $(".deleteItem").on("click", function(){
            var self = $(this);
            var id = self.data("id");
            console.log(id);

            $.ajax({
                type: "DELETE",
                url: url + '/api/v1/deleteItem',
                data: {id: id,  _token: "<?php echo csrf_token(); ?>"},
                success: function( msg ) {
                    $(".message").removeClass("alert-danger").addClass("alert-success").html(msg);
                    $(".item_"+id).remove();

                },
                error: function (response) {
                    $(".message").removeClass("alert-success").addClass("alert-danger").html(response.responseText);
                },
            });
        });
    </script>
@endsection