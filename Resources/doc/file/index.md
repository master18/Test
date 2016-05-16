# JQueryFile Field ([download uploadify](http://www.uploadify.com))

# app/config/config.yml
px_form:
    file:
        enabled:    true
        cancel_img: '/bundles/pxform/images/cancel.png'
        folder:     '/upload'
```

## Default Usage:

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // ...
        ->add('download', 'px_file')

}
```
