
    <div class="row">

        <div class="well well-large col-md-12">
            {!! HTML::image($imageable->getImagePath() .'/'. $imageable->image->file_name, $imageable->image->alt, array('title' => $imageable->image->title)) !!}
        </div>

    </div>
