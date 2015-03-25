
    <div class="row">
        <div class="well well-large col-md-12">
            <div class='col-md-10'>
                <div class='col-md-4'>&nbsp;</div>
                <div class='col-md-8'>{!! HTML::image($imageable->getImagePath() .'/'. $imageable->image->file_name, $imageable->image->alt, array('title' => $imageable->image->title)) !!}</div>
            </div>
        </div>
    </div>
