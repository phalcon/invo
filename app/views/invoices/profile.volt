
{{ content() }}

<div class="profile left">
    {{ form('invoices/profile', 'id': 'profileForm', 'onbeforesubmit': 'return false') }}
        <div class="clearfix">
            <label for="name">Your Full Name:</label>
            <div class="input">
                {{ text_field("name", "size": "30", "class": "span6") }}
                <div class="alert" id="name_alert">
                    <strong>Warning!</strong> Please enter your full name
                </div>
            </div>
        </div>
        <div class="clearfix">
            <label for="email">Email Address:</label>
            <div class="input">
                {{ text_field("email", "size": "30", "class": "span6") }}
                <div class="alert" id="email_alert">
                    <strong>Warning!</strong> Please enter your email
                </div>
            </div>
        </div>
        <div class="clearfix">
            <input type="button" value="Update" class="btn btn-primary btn-large btn-info" onclick="Profile.validate()">
            &nbsp;
            {{ link_to('invoices/index', 'Cancel') }}
        </div>
    </form>
</div>