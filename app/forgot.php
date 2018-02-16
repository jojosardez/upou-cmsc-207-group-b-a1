<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="assets/lib/onsenui/css/onsenui.css">
    <link rel="stylesheet" href="assets/lib/onsenui/css/onsen-css-components.min.css">
    <script src="assets/lib/onsenui/js/onsenui.min.js"></script>
    <script src="assets/lib/jquery/js/jquery.min.js"></script>
    <script src="assets/js/forgot.js"></script>
  </head>
  <body>
    <ons-page>
      <ons-toolbar>
        <div class="center">CMSC 207 - Group B - Forgot Password</div>
      </ons-toolbar>
      <div style="text-align: center; margin-top: 30px;">
        <p>
          <ons-input id="usernameOrEmail" modifier="underbar" placeholder="Username or Email Address" float></ons-input>
        </p>
        <p style="margin-top: 30px;">
          <ons-button onclick="reset()">Reset Password</ons-button>
        </p>
      </div>
    </ons-page>
  </body>
</html>
