<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="assets/lib/onsenui/css/onsenui.css">
  <link rel="stylesheet" href="assets/lib/onsenui/css/onsen-css-components.min.css">
  <script src="assets/lib/onsenui/js/onsenui.min.js"></script>
  <script src="assets/lib/jquery/js/jquery.min.js"></script>
  <script src="assets/js/common.js"></script>
  <script src="assets/js/forgot.js"></script>
</head>

<body>
  <ons-splitter>
    <ons-splitter-side id="menu" side="left" width="220px" collapse swipeable>
      <ons-page>
        <ons-list>
          <ons-list-item onclick="location.href = 'login.php';" tappable>
            Login
          </ons-list-item>
          <ons-list-item onclick="location.href = 'forgot.php';" tappable>
            Forgot Password
          </ons-list-item>
          <ons-list-item onclick="location.href = 'change.php';" tappable>
            Change Password
          </ons-list-item>
          <ons-list-item onclick="location.href = 'register.php';" tappable>
            Register
          </ons-list-item>
          <ons-list-item onclick="location.href = 'admin.php';" tappable>
            Admin Dashboard
          </ons-list-item>
        </ons-list>
      </ons-page>
    </ons-splitter-side>
    <ons-splitter-content id="content" page="home"></ons-splitter-content>
  </ons-splitter>
  <template id="home">
    <ons-page>
      <ons-toolbar>
        <div class="left">
          <ons-toolbar-button onclick="fn.open()">
            <ons-icon icon="md-menu"></ons-icon>
          </ons-toolbar-button>
        </div>
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
  </template>
</body>

</html>