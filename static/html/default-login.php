<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <div class="avatar" id = "modal-avatar">
                    <img src="<?php echo SITE_CONFIGURATIONS["IMG_FOLDER"].'logo-big.png'; ?>" alt="<?php echo $home_page_site_name; ?> logo">
                </div>
                <h4 class="modal-title">Account login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <fieldset id = "default-login-fieldset">
                    <form id = "default-login-form" action="#" method="post" enctype="application/x-www-form-urlencoded" accept-charset="utf-8" autocomplete="on">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id = "default-login-username" placeholder="username" />
                            <span class="signup-errors contact-errors help-block" id = "default-login-username-error"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id = "default-login-phone" name="phone" placeholder="Phone number" required="required">
                            <span class="contact-errors help-block signup-errors" id = "default-login-phone-number-error"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
                        </div>
                    </form>
                </fieldset>
            </div>
            <div class="modal-footer">
                <a href="/forgotUsername">Lost account?</a>
            </div>
        </div>
    </div>
</div>