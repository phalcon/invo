
{{ content() }}

<div class="row">

    <div class="span6">
        <div class="page-header">
            <h2>Log In</h2>
        </div>
        {{ form('session/start') }}
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="email">Username/Email</label>
                    <div class="controls">
                        {{ text_field('email', 'class': "span5") }}
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password">Password</label>
                    <div class="controls">
                        {{ password_field('password', 'class': "span5") }}
                    </div>
                </div>
                <div class="control-group">
                    {{ submit_button('Login', 'class': 'btn btn-primary btn-large') }}
                </div>
            </fieldset>
        </form>
    </div>

    <div class="span6">
        <div class="page-header">
            <h2>Don't have an account yet?</h2>
        </div>

        <p>Create an account offers the following advantages:</p>
        <ul>
            <li>Create, track and export your invoices online</li>
            <li>Gain critical insights into how your business is doing</li>
            <li>Stay informed about promotions and special packages</li>
        </ul>

        <div class="clearfix center">
            {{ link_to('session/register', 'Sign Up', 'class': 'btn btn-primary btn-large btn-success') }}
        </div>
    </div>

</div>
