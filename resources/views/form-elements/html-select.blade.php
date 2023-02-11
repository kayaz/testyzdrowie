<div class="form-group row">
    @isset($required)
        {!! Form::label($name, '<div class="text-end">'.$label.' <span class="text-danger d-inline">*</span></div>', ['class' => 'col-3 col-form-label control-label required'], false) !!}
    @else
        {!! Form::label($name, '<div class="text-end">'.$label.'</div>', ['class' => 'col-3 col-form-label control-label required'], false) !!}
    @endisset
    <div class="@isset($class) {{ $class }} @else {{ 'col-4' }} @endisset">
        @if(isset($selected))
            {!! Form::select($name, $select, $selected, array('class' => 'form-select')) !!}
        @else
            {!! Form::select($name, $select, [], array('class' => 'form-select')) !!}
        @endif
        @if($errors->first($name))<div class="invalid-feedback d-block">{{ $errors->first($name) }}</div>@endif
    </div>
</div>
