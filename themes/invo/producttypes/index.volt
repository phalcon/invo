<div class="row mb-3">
    <div class="col-xs-12 col-md-6">
        <h2>Search product types</h2>
    </div>
    <div class="col-xs-12 col-md-6 text-right">
        {{ tag.a(url('producttypes/new'), 'Create product types', ['class':'btn btn-primary']) }} 
    </div>
</div>

<form action="{{ url('producttypes/search') }}" role="form" method="post">
    <div class="form-group">
        <label for="id">Id</label>
        {{ tag.inputNumeric('id', '', ['size': 10, 'maxlength': 10, 'class': 'form-control']) }} 
    </div>

    <div class="form-group">
        <label for="name">Name</label>
        {{ tag.inputText('name', '', ['size': 24, 'maxlength': 70, 'class': 'form-control']) }} 
    </div>

    {{ tag.inputSubmit('Search', null, ['class': 'btn btn-primary', 'id': null, 'name': null, 'value': 'Search']) }} 
</form>
