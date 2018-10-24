

<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 hideable-forms form-steps form-step-1">
    <div class="panel panel-info" >
        <div class="panel-heading">
            <div class="panel-title">Sign In</div>
            <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="/forgotUsername">Forgot username?</a></div>
        </div>

        <div style="padding-top:30px" class="panel-body" >

            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
            <fieldset id = "login-fieldset">
                <form id="loginform" class="form-horizontal" role="form" name = "login-form" enctype="application/x-www-form-urlencoded" method="post" accept-charset="utf-8" autocomplete="on">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input id="login-username" value = "<?php if (isset($profile) != null && !empty($profile)) {echo  $profile["username"]; }?>"
                               type="text" class="form-control" name="username"  placeholder="contact username">

                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input id="login-phone" value = "<?php if(isset($profile) && ! empty($profile)) { echo  $profile["primary_phone"]; }?>"
                               type="text" class="form-control" name="phone"  placeholder="phone number">

                    </div>
                    <span class = "signup-errors contact-errors" id = "login-username-error"></span>



                    <div class="checkbox choose-option" id="login-checkbox-container">
                        <label><input type="checkbox" name="check" id = "remember-me" checked="checked" />Remember me </label>
                    </div>

                    <span class = "signup-errors contact-errors" id = "login-phone-error"></span>


                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <button id="login-button"  type = "submit" class="btn btn-primary steps-buttons" data-next-step = "2" data-current-step = "1"><span id = "login-button-text">&nbsp Next</span><i class = "fa fa-spinner fa-spin" id = "next-loading-icon"></i></button>

                        </div>
                    </div>


                    <div class="form-group" id = "login-buttons-container">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px;top:10px;position:relative; font-size:85%" >
                                Don't have an account?
                                <button id="new-signup-button"  class="btn btn-success steps-buttons" data-next-step = "2" data-current-step = "1">create one!  </button>

                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>


        </div>
    </div>
</div>