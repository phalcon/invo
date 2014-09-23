{{ content() }}

<div align="right">
    {{ link_to("products/new", "Create Products", "class": "btn btn-primary") }}
</div>

{{ form("products/search", "autocomplete": "off") }}

<div class="center scaffold">

    <h2>Search products</h2>

    <div class="clearfix">
        <label for="id">Id</label>
        {{ numeric_field("id", "size": 10, "maxlength": 10) }}
    </div>

    <div class="clearfix">
        <label for="product_types_id">Product Type</label>
        {{ select("product_types_id", productTypes, "using": ["id", "name"], "useEmpty": true) }}
    </div>

    <div class="clearfix">
        <label for="name">Name</label>
        {{ text_field("name", "size": 24, "maxlength": 70) }}
    </div>

    <div class="clearfix">
        <label for="price">Price</label>
        {{ text_field("price", "size": 24, "maxlength": 70, "type": "number") }}
    </div>

    <div class="clearfix">
        <label for="active">Active</label>
        {{ select_static("active", ['Y': 'Y', 'N': 'N'], "useEmpty": true) }}
    </div>

    <div class="clearfix">
        {{ submit_button("Search", "class": "btn btn-primary") }}</td>
    </div>

</div>

</form>
