{{ form('products/save') }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("products", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ submit_button("Save", "class": "btn btn-success") }}
    </li>
</ul>

{{ content() }}

<div class="center scaffold">
    <h2>Edit products</h2>


    <input type="hidden" name="id" id="id" value="{{ id }}" />

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
        {{ numeric_field("price", "size": 24, "maxlength": 70, "step": "any") }}
    </div>

    <div class="clearfix">
        <label for="active">Active</label>
        {{ select_static("active", ['Y': 'Y','N': 'N'], "useEmpty": true) }}
    </div>

    </form>
</div>
