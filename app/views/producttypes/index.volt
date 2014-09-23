{{ content() }}

<div align="right">
    {{ link_to("producttypes/new", "Create product types", "class": "btn btn-primary") }}
</div>

{{ form("producttypes/search", "autocomplete": "off") }}

<div class="center scaffold">

    <h2>Search product types</h2>

    <div class="clearfix">
        <label for="id">Id</label>
        {{ numeric_field("id", "size": 10, "maxlength": 10) }}
    </div>

    <div class="clearfix">
        <label for="name">Name</label>
        {{ text_field("name", "size": 24, "maxlength": 70) }}
    </div>

    <div class="clearfix">
        {{ submit_button("Search", "class": "btn btn-primary") }}
    </div>

</div>

</form>
