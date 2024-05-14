<ul class="pager">
    <li class="previous">
        {{ tag.a(url('products'), '&larr; Go Back', [], true) }} 
    </li>
    <li class="next">
        {{ tag.a(url('products/new'), 'Create products') }} 
    </li>
</ul>

{% for product in page.items %}
{% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Product Type</th>
            <th>Name</th>
            <th>Price</th>
            <th>Active</th>
        </tr>
    </thead>
    <tbody>
{% endif %} 
        <tr>
            <td>{{ product.id }}</td>
            <td>{{ product.productTypes.name }}</td>
            <td>{{ product.name }}</td>
            <td>${{ "%.2f"|format(product.price) }}</td>
            <td>{{ product.getActiveDetail() }}</td>
            <td width="7%">{{ tag.a(url('products/edit/' ~ product.id), "<i class=\"glyphicon glyphicon-edit\"></i> Edit", ['class': 'btn btn-default'], true) }}</td>
            <td width="7%">{{ tag.a(url('products/delete/' ~ product.id), "<i class=\"glyphicon glyphicon-remove\"></i> Delete", ['class': 'btn btn-default'], true) }}</td>
        </tr>
{% if loop.last %} 
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ tag.a(url('products/search'), "<i class=\"icon-fast-backward\"></i> First", ['class': 'btn'], true) }} 
                    {{ tag.a(url('products/search?page=') ~ page.getPrevious(), "<i class=\"icon-step-backward\"></i> Previous", ['class': 'btn'], true) }} 
                    {{ tag.a(url('products/search?page=') ~ page.getNext(), "<i class=\"icon-step-forward\"></i> Next", ['class': 'btn'], true) }} 
                    {{ tag.a(url('products/search?page=') ~ page.getLast(), "<i class=\"icon-fast-forward\"></i> Last", ['class': 'btn'], true) }} 
                    <span class="help-inline">{{ page.getCurrent() }} of {{ page.getLast() }}</span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
{% endif %}
{% else %}
    No products are recorded
{% endfor %}
