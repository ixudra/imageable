ixudra/imageable
=====================

Custom Laravel imaging package for the Laravel 4 framework - developed by Ixudra.

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom workflow. It may not suit your project perfectly and modifications may be in order.



## Installation

Pull this package in through Composer:

```js

    {
        "require": {
            "ixudra/imageable": "1.*"
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

You can create new `Image` models using the `ImageFactory` class which is provided in the package:

```php

    class CardFactory {

        public function createFromUserInput($input)
        {
            $input = $this->preProcessInput($input);
    
            $card = Card::create( array( 'name' => $input['name'] ) );
            $imageResponse = App::make('\Ixudra\Imageable\Services\Factories\ImageFactory')
                ->create( $input, $cardResponse->getModel() );
    
            $response = new BaseModelResponse( null, $input );
            if( $cardResponse->isSuccessful() && $imageResponse->isSuccessful() ) {
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

