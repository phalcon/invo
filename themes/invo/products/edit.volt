<form action="{{ url('products/save') }}" role="form" method="post">
    <ul class="pager">
        <li class="previous pull-left">
            {{ tag.a(url('products'), '&larr; Go Back', [], true) }} 
        </li>
        <li class="pull-right">
            {{ tag.inputSubmit('Save', 'Save', ['class': 'btn btn-success']) }} 
        </li>
    </ul>

    <h2>Edit products</h2>

    <fieldset>
{% for element in form %}
{% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
        {{ element }} 
{% else %}
        <div class="form-group">
            {{ element.label() }} 
            {{ element.render(['class': 'form-control']) }} 
        </div>
{% endif %}
{% endfor %}
    </fieldset>
</form>
