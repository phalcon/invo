<ul class="pager">
    <li class="previous">
        {{ tag.a(url('producttypes'), '&larr; Go Back', [], true) }} 
    </li>
    <li class="next">
        {{ tag.a(url('producttypes/new'), 'Create product types', ['class': 'btn btn-primary']) }} 
    </li>
</ul>

{% for producttype in page.items %}
{% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
    {% endif %} 
        <tr>
            <td>{{ producttype.id }}</td>
            <td>{{ producttype.name }}</td>
            <td width="7%">{{ tag.a(url('producttypes/edit/' ~ producttype.id), "<i class=\"glyphicon glyphicon-edit\"></i> Edit", ['class': 'btn btn-default'], true) }}</td>
            <td width="7%">{{ tag.a(url('producttypes/delete/' ~ producttype.id), "<i class=\"glyphicon glyphicon-remove\"></i> Delete", ['class': 'btn btn-default'], true) }}</td>
        </tr>
    {% if loop.last %} 
        <tr>
            <td colspan="4" align="right">
                <div class="btn-group">
                    {{ tag.a(url('producttypes/search'), "<i class=\"icon-fast-backward\"></i> First", ['class': 'btn'], true) }} 
                    {{ tag.a(url('producttypes/search?page=') ~ page.getPrevious(), "<i class=\"icon-step-backward\"></i> Previous", ['class': 'btn'], true) }} 
                    {{ tag.a(url('producttypes/search?page=') ~ page.getNext(), "<i class=\"icon-step-forward\"></i> Next", ['class': 'btn'], true) }} 
                    {{ tag.a(url('producttypes/search?page=') ~ page.getLast(), "<i class=\"icon-fast-forward\"></i> Last", ['class': 'btn'], true) }} 
                    <span class="help-inline">{{ page.getCurrent() }}/{{ page.getLast() }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
    {% endif %}
{% else %}
    No product types are recorded
{% endfor %}
