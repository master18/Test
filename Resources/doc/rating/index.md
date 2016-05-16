# JQueryRating Field ([view demo](http://www.fyneworks.com/jquery/star-rating/#tab-Testing))

![Star rating](https://github.com/genemu/GenemuFormBundle/raw/master/Resources/doc/jquery/rating/images/default.png)

## Installation:
You need to download the resources manually from [here](http://www.fyneworks.com/jquery/star-rating/#tab-Download). Add
the CSS and JS in to your template, and make sure the image paths are correct.

## Default Usage:

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // ...
        ->add('rating', 'px_rating')
        ->add('readonly_rating', 'px_rating', array(
            'configs' => array(
                'readOnly' => true
            )
        ))
}
```
