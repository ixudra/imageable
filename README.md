ixudra/imageable
=====================

Custom Laravel imaging package for the Laravel 5 framework - developed by Ixudra.

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

    }

```

This class must extend the `Ixudra\Imageable\Traits\ImageableTrait` trait and must have the `imagePath` property available to it. The `imagePath` property describes the path to where the images need to be stored on the system. The package uses the `public/` directory as the starting point and will append the value of the `imagePath` value to it in order to derive the full path. 

You can create new `Image` models using the `ImageFactory` class which is provided in the package:

```php

    class CardFactory {

        public function create($input)
        {
            $card = Card::create( array( 'name' => $input['name'] ) );
            $imageResponse = App::make('\Ixudra\Imageable\Services\Factories\ImageFactory')
                ->create( $input, $card );

            $response = new BaseModelResponse( null, $input );
            if( !is_null($card) && $imageResponse->isSuccessful() ) {
                $card->save();

                $imageResponse->getModel()->attachToTarget( $imageResponse->getInput()['file'], $card );
            } else {
                return null;
            }

            return $card;
        }

    }

```

It is important to know that the factory does not actually save the the model in the database. This is done to make sure that all data (including the data of the polymorphic model) is valid before actually saving.
 
In order to actually link the `Image` with the polymorphic model, you need to call the `Image::attachToTarget()` method with the correct parameters. This will automatically set all attributes for the polymorphic relationship, move the image to the correct location on disk and finally save the model in the database.

Updating images works similar to creating them. The only difference is that attaching the image via the form is no longer required. Additionally, you also need to make sure that you delete the existing image before attaching the new one:

You can create new `Image` models using the `ImageFactory` class which is provided in the package:

```php

    class CardFactory {

        public function modify($card, $input)
        {
            $card = $card->fill( array( 'name' => $input['name'] ) );
            $imageResponse = App::make('\Ixudra\Imageable\Services\Factories\ImageFactory')
                ->modify( $card->image, $input, $card );

            $response = new BaseModelResponse( $card, $input );
            if( $imageResponse->isSuccessful() ) {
                $card->save();
                $image = $imageResponse->getModel();

                if( array_key_exists( 'file', $imageResponse->getInput() ) ) {
                    $image->remove();
                    $image->attachToTarget( $imageResponse->getInput()['file'], $card );
                }

                $image->save();
            }

            return $card;
        }

    }

```