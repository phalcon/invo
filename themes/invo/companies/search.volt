<ul class="pager">
    <li class="previous pull-left">
        {{ tag.a(url('companies'), '&larr; Go Back', [], true) }} 
    </li>
    <li class="pull-right">
        {{ tag.a(url('companies/new'), 'Create companies') }} 
    </li>
</ul>

{% for company in page.items %}
{% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Telephone</th>
            <th>Address</th>
            <th>City</th>
        </tr>
    </thead>
    <tbody>
{% endif %} 
        <tr>
            <td>{{ company.id }}</td>
            <td>{{ company.name }}</td>
            <td>{{ company.telephone }}</td>
            <td>{{ company.address }}</td>
            <td>{{ company.city }}</td>
            <td width="7%">{{ tag.a(url('companies/edit/' ~ company.id), "<i class=\"glyphicon glyphicon-edit\"></i> Edit", ['class': 'btn btn-default'], true) }}</td>
            <td width="7%">{{ tag.a(url('companies/delete/' ~ company.id), "<i class=\"glyphicon glyphicon-remove\"></i> Delete", ['class': 'btn btn-default'], true) }}</td>
        </tr>
{% if loop.last %}
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ tag.a(url('companies/search'), "<i class=\"icon-fast-backward\"></i> First", ['class': 'btn btn-default'], true) }} 
                    {{ tag.a(url('companies/search?page=') ~ page.getPrevious(), "<i class=\"icon-step-backward\"></i> Previous", ['class': 'btn btn-default'], true) }} 
                    {{ tag.a(url('companies/search?page=') ~ page.getNext(), "<i class=\"icon-step-forward\"></i> Next", ['class': 'btn btn-default'], true) }} 
                    {{ tag.a(url('companies/search?page=') ~ page.getLast(), "<i class=\"icon-fast-forward\"></i> Last", ['class': 'btn btn-default'], true) }} 
                    <span class="help-inline">{{ page.getCurrent() }}/{{ page.getLast() }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
{% endif %}
{% else %}
    No companies were found...
{% endfor %}
