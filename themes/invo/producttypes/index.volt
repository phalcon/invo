<div class="row mb-3">
    <div class="col-xs-12 col-md-6">
        <h2>Search product types</h2>
    </div>
    <div class="col-xs-12 col-md-6 text-right">
        {{ link_to("producttypes/new", "Create product types", "class": "btn btn-primary") }}
    </div>
</div>

<form action="/producttypes/search" role="form" method="get">
    <div class="form-group">
        <label for="id">Id</label>
        {{ numeric_field("id", "size": 10, "maxlength": 10, "class": "form-control") }}
    </div>

    <div class="form-group">
        <label for="name">Name</label>
        {{ text_field("name", "size": 24, "maxlength": 70, "class": "form-control") }}
    </div>

    {{ submit_button("Search", "class": "btn btn-primary") }}
</form>
