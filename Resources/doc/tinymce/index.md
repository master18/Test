# Tinymce Field ([download tinymce](http://www.tinymce.com/))

## Minimal configuration:

``` yml
# app/config/config.yml
px_form:
    tinymce: ~
```

## Default Usage:

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // ...
        ->add('content', 'px_tinymce');
}
```
