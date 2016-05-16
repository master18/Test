
## Minimal configuration:

``` yml
# app/config/config.yml
genemu_form:
    image: ~
```
```

## Default Usage:

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // ...
        ->add('image', 'px_image');
}

