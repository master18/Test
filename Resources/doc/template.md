## Example:

``` twig
{% block stylesheets %}
    <link href="{{ asset('css/ui-lightness/jquery-ui-1.8.16.custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/uploadify/uploadify.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/jcrop/jquery.Jcrop.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/tokeninput/token-input-facebook.css') }}" rel="stylesheet" />
    {{ form_stylesheet(form) }}
{% endblock %}

{% block javascripts %}
    <script src="{{ asset('js/jquery-1.7.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui-1.8.16.custom.min.js') }}"></script>
    <script src="{{ asset('tinymce/tiny_mce.js') }}"></script>
    <script src="{{ asset('js/i18n/jquery-ui-i18n.js') }}"></script>

    <script src="{{ asset('js/uploadify/jquery.uploadify.v2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/uploadify/swfobject.js') }}"></script>
    {{ form_javascript(form) }}
{% endblock %}

{% block body %}
    <form action="{{ path('my_route_form') }}" type="post" {{ form_enctype(form) }}>
        {{ form_widget(form) }}

        <input type="submit" />
    </form>
{% endblock %}
```
