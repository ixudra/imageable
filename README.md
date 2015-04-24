ixudra/imageable
=====================

Custom Laravel imaging package for the Laravel 5 framework - developed by [Ixudra](http://ixudra.be).

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom workflow. It may not suit your project perfectly and modifications may be in order.



## Installation

Pull this package in through Composer:

```js

    {
        "require": {
            "ixudra/imageable": "5.*"
        }
    }

```

Run package migrations using artisan:

```php

    php artisan migrate --package="ixudra/imageable"

```

Alternatively, you can also publish the migrations using artisan:

```php

    // Publish all resources from all packages
    php artisan vendor:publish
    
    // Publish only the resources of the package
    php artisan vendor:publish --provider="Ixudra\\Imageable\\ImageableServiceProvider"

```



## Usage

Create a model with a polymorphic relationship to the `Image` model:

```php

    use Ixudra\Imageable\Traits\ImageableTrait;

    class Card extends Eloquent {

        use ImageableTrait;


        protected $imagePath = 'images/cards';


        public function image()
        {
            return $this->morphOne('Ixudra\Imageable\Models\Image', 'imageable');
        }


        public function delete()
        {
            $this->image->delete();

            parent::delete();
        }

    }

```

This class must extend the `Ixudra\Imageable\Traits\ImageableTrait` trait and must have the `imagePath` property available to it. The `imagePath` property describes the path to where the images need to be stored on the system. The package uses the `public/` directory as the starting point and will append the value of the `imagePath` value to it in order to derive the full path. 

You can create new `Image` models using the `ImageFactory` class which is provided in the package. The `ImageFactory` will take care of creating the `Image` model, linking the `Image` to the designated model and moving the uploaded file to the location which is specified in the designated model.

The `ImageFactory` expects a specific set of input parameters:

 - `file` which holds the actual uploaded file
 - `alt` which holds the name of the image (will be used as `alt` when displaying the image)
 - `title` which holds the name of the image (will be used as `title` when displaying the image)
 
The package also provides an `ImageFactoryTrait` which can be used to extract all the information necessary to create an `image` model from a general data array.

Updating images works similar to creating them. All you need to do is provide the correct information and the `ImageFactory` will take care of the rest for you. It is also possible to update the image information without actually updating the uploaded file. This can be done by omitting the `file` attribute from the data that is passed to the factory.

A full example of a factory class that leverages the package functionality can be found in the following example:

```php

    use Ixudra\Imageable\Services\Factories\ImageFactory;
    use Ixudra\Imageable\Traits\ImageFactoryTrait;

    class CardFactory {

        use ImageFactoryTrait;


        protected $imageFactory;


        public function __construct(ImageFactory $imageFactory)
        {
            $this->imageFactory = $imageFactory;
        }


        public function create($input)
        {
            $card = Card::create( array( 'name' => $input['name'] ) );
            $this->imageFactory->make( $this->extractImageInput( $input ), $card );

            return $card;
        }

        public function modify($card, $input)
        {
            $card = $card->update( array( 'name' => $input['name'] ) );
            $this->imageFactory->modify( $card->image, $this->extractImageInput( $input ), $card );

            return $card;
        }

    }

```

Finally, the package also provides several views that can be used:

 - `data.blade.php` which includes a Twitter Bootstrap implementation that will allow you to show the image on a page
 - `fields.blade.php` which includes a Twitter Bootstrap implementation that can be included in forms to create and/or modify the image information
 
Usage example of both cases can be found in the examples below:

```php

    {!! Form::open(array('url' => 'cards/', 'method' => 'POST', 'id' => 'createCard', 'class' => 'form-horizontal', 'role' => 'form', 'files' => true)) !!}

        <div class="well well-large">
            <div class='form-group {{ $errors->has('name') ? 'has-error' : '' }}'>
                {!! Form::label('name', 'Name:', array('class' => 'control-label col-lg-3')) !!}
                <div class="col-lg-6">
                    {!! Form::text('name', $input['name'], array('class' => 'form-control')) !!}
                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>

        @include('imageable::images/fields')

        <div class="action-button">
            {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
            {!! HTML::linkRoute('cards.index', 'Cancel', array(), array('class' => 'btn btn-default')) !!}
        </div>

    {!! Form::close() !!}

```

```php

    <div class="row">
        <div class="well well-large col-md-12">
            <div class='col-md-10'>
                <div class='col-md-4'>Name:</div>
                <div class='col-md-8'>{{ $card->name }}</div>
            </div>
        </div>
    </div>

    @include('imageable::images/data', array('imageable' => $card))

```

The usage of these views is by no means required to take advantage of the functionality in this package. However, it is worth noting that both views leverage the functionality of the [ixudra/translation](http://github.com/ixudra/translation) package by default. The `ixudra/translation` package is not included as a requirement for this package, but must be pulled in via composer in order to take advantage of the views which are provided by default. 

