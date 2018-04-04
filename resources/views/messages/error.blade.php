@if (count($errors) > 0)
    <div class="alert alert-danger">
        <p>{{trans('validation.validation_general_message')}}</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif