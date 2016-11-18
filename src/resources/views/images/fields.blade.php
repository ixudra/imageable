    <div class="well well-large">
        <div class='form-group {{ $errors->has($prefix .'file') ? 'has-error' : '' }} {{ in_array( $prefix .'file', $requiredFields ) ? 'required' : '' }}'>
            {!! Form::label($prefix .'file', Translate::recursive('members.file') .': ', array('class' => 'control-label col-lg-3')) !!}
            <div class="col-lg-8">
                {!! Form::file($prefix .'file', array('class' => 'form-control')) !!}
            </div>
            <div class="col-lg-12">
                <div class="col-lg-3">&nbsp;</div>
                <div class="col-lg-8">
                    {!! $errors->first($prefix .'file', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class='form-group {{ $errors->has($prefix .'title') ? 'has-error' : '' }} {{ in_array( $prefix .'title', $requiredFields ) ? 'required' : '' }}'>
            {!! Form::label($prefix .'title', Translate::recursive('members.title') .': ', array('class' => 'control-label col-lg-3')) !!}
            <div class="col-lg-8">
                {!! Form::text($prefix .'title', $input[$prefix . 'title'], array('class' => 'form-control')) !!}
            </div>
            <div class="col-lg-12">
                <div class="col-lg-3">&nbsp;</div>
                <div class="col-lg-8">
                    {!! $errors->first($prefix .'title', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class='form-group {{ $errors->has($prefix .'alt') ? 'has-error' : '' }} {{ in_array( $prefix .'alt', $requiredFields ) ? 'required' : '' }}'>
            {!! Form::label($prefix .'alt', Translate::recursive('members.alt') .': ', array('class' => 'control-label col-lg-3')) !!}
            <div class="col-lg-8">
                {!! Form::text($prefix .'alt', $input[$prefix . 'alt'], array('class' => 'form-control')) !!}
            </div>
            <div class="col-lg-12">
                <div class="col-lg-3">&nbsp;</div>
                <div class="col-lg-8">
                    {!! $errors->first($prefix .'alt', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>