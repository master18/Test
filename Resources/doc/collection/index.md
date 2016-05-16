## Minimal configuration:

``` yml
# app/config/config.yml
px_form:
    collection: ~
```

## Default Usage:

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // ...
        ->add('content', 'px_collection');
}
```
