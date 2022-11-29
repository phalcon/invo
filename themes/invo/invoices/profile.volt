<h2 class="mb-3">Update your profile</h2>

<form action="/invoices/profile" role="form" method="post" id="profileForm">
    <div class="form-group">
        <label for="name">Your Full Name:</label>
        {{ text_field("name", "size": "30", "class": "form-control") }}
        <div class="alert alert-warning" id="name_alert">
            <strong>Warning!</strong> Please enter your full name
        </div>
    </div>

    <div class="form-group">
        <label for="email">Email Address:</label>
        {{ text_field("email", "size": "30", "class": "form-control") }}
        <div class="alert alert-warning" id="email_alert">
            <strong>Warning!</strong> Please enter your email
        </div>
    </div>

    <input type="button" value="Update" class="btn btn-primary btn-large btn-info" onclick="Profile.validate()">
    {{ link_to('invoices/index', 'Cancel', "class": "btn btn-default") }}
</form>
