# jQuery Select2 Field ([view demo](http://ivaynberg.github.com/select2/))

## Enable it in your app configuration :
``` yml
# app/config/config.yml
px_form:
    select2: ~
```


## Download the plugin and include its assets : http://ivaynberg.github.com/select2/

## Default Usage:

You can use all the core choice types from Symfony (choice, country, ...) and
``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // ...
        ->add('choice', 'gpx_select2_choice', array(
            'choices' => array(
                'foo' => 'Foo',
                'bar' => 'Bar',
            )
        ))
        ->add('country', 'px_select2_country')
        ->add('entity', 'px_select2_entity', array(
            'class' => 'MyBundle\Entity\Class',
            'property' => 'name',
        ))
    ;
}
```

