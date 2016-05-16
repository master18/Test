## Minimal configuration:

``` yml
# app/config/config.yml
genemu_form:
    date: ~
```

## Default Usage:

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // ...
        ->add('createdAt', 'px_date')
}
```
