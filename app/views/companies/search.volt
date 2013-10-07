{{ content() }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("companies/index", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ link_to("companies/new", "Create companies", "class": "btn btn-primary") }}
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
{% endif %}
    <tbody>
        <tr>
            <td>{{ company.id }}</td>
            <td>{{ company.name }}</td>
            <td>{{ company.telephone }}</td>
            <td>{{ company.address }}</td>
            <td>{{ company.city }}</td>
            <td width="12%">{{ link_to("companies/edit/" ~ company.id, '<i class="icon-pencil"></i> Edit', "class": "btn") }}</td>
            <td width="12%">{{ link_to("companies/delete/" ~ company.id, '<i class="icon-remove"></i> Delete', "class": "btn") }}</td>
        </tr>
    </tbody>
{% if loop.last %}
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("companies/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("companies/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn ") }}
                    {{ link_to("companies/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("companies/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }}/{{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
{% endif %}
{% else %}
    No companies are recorded
{% endfor %}
