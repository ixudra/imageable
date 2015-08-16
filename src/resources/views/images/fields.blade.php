    <div class="well well-large">
        <div class='form-group {{ $errors->has('file') ? 'has-error' : '' }}{{ in_array( 'file', $requiredFields ) ? 'required' : '' }}'>
            {!! Form::label('file', Translate::recursive('members.file') .': ', array('class' => 'control-label col-lg-3')) !!}
            <div class="col-lg-8">
                {!! Form::file('file', array('class' => 'form-control')) !!}
            </div>
            <div class="col-lg-12">
                <div class="col-lg-3">&nbsp;</div>
                <div class="col-lg-8">
                    {!! $errors->first('file', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class='form-group {{ $errors->has('title') ? 'has-error' : '' }} {{ in_array( 'title', $requiredFields ) ? 'required' : '' }}'>
            {!! Form::label('title', Translate::recursive('members.title') .': ', array('class' => 'control-label col-lg-3')) !!}
            <div class="col-lg-8">
                {!! Form::text('title', $input['title'], array('class' => 'form-control')) !!}
            </div>
            <div class="col-lg-12">
                <div class="col-lg-3">&nbsp;</div>
                <div class="col-lg-8">
                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
        <div class='form-group {{ $errors->has('alt') ? 'has-error' : '' }} {{ in_array( 'alt', $requiredFields ) ? 'required' : '' }}'>
            {!! Form::label('alt', Translate::recursive('members.alt') .': ', array('class' => 'control-label col-lg-3')) !!}
            <div class="col-lg-8">
                {!! Form::text('alt', $input['alt'], array('class' => 'form-control')) !!}
            </div>
            <div class="col-lg-12">
                <div class="col-lg-3">&nbsp;</div>
                <div class="col-lg-8">
                    {!! $errors->first('alt', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>