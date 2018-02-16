<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="assets/lib/onsenui/css/onsenui.css">
    <link rel="stylesheet" href="assets/lib/onsenui/css/onsen-css-components.min.css">
    <script src="assets/lib/onsenui/js/onsenui.min.js"></script>
    <script src="assets/lib/jquery/js/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
  </head>
  <body>
    <ons-page>
      <ons-toolbar>
        <div class="center">CMSC 207 - Group B - Register</div>
      </ons-toolbar>
      <div style="text-align: center; margin-top: 30px;">
        <p>
          <ons-input id="username" modifier="underbar" placeholder="Username" float></ons-input>
        </p>
        <p>
          <ons-input id="email" modifier="underbar" placeholder="Email Address" float></ons-input>
        </p>
        <p>
          <ons-input id="password" modifier="underbar" type="password" placeholder="Password" float></ons-input>
        </p>
        <p>
          <ons-input id="repeatPassword" modifier="underbar" type="password" placeholder="Repeat Password" float></ons-input>
        </p>
        <p style="margin-top: 30px;">
          <ons-button onclick="login()">Register</ons-button>
        </p>
      </div>
    </ons-page>
  </body>
</html>
