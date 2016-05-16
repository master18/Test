# JQueryChosen Field ([view demo](http://harvesthq.github.io/chosen/)) 

## Default Usage:

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // ...
        ->add('country', 'px_chosen_country')
        ->add('timezone', 'px_chosen_timezone')
        ->add('language', 'px_chosen_language');
}
```

