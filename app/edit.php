<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="assets/lib/onsenui/css/onsenui.css">
  <link rel="stylesheet" href="assets/lib/onsenui/css/onsen-css-components.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/lib/onsenui/js/onsenui.min.js"></script>
  <script src="assets/lib/jquery/js/jquery.min.js"></script>
  <script src="assets/js/common.js"></script>
  <script src="assets/js/edit.js"></script>
</head>

<body>
  <ons-splitter>
    <ons-splitter-side id="menu" side="left" width="220px" collapse swipeable>
      <ons-page>
        <ons-list>
          <ons-list-item onclick="location.href = 'admin.php';" tappable>
            Dashboard
          </ons-list-item>
          <ons-list-item onclick="location.href = 'change.php';" tappable>
            Change Password
          </ons-list-item>
          <ons-list-item onclick="location.href = 'login.php';" tappable>
            Logout
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
            <img class="logoBorder" src="assets/images/upoulogo.png" alt="UPOU Logo">
          </ons-toolbar-button>
        </div>
        <div class="center">Edit Account</div>
      </ons-toolbar>
      <div style="text-align: center; margin-top: 30px;">
        <p>
          <ons-input id="username" modifier="underbar" placeholder="Username" size="35" required float></ons-input>
        </p>
        <p>
          <ons-input id="email" modifier="underbar" placeholder="Email Address" size="35" required float></ons-input>
        </p>
        <p>
          <ons-input id="password" modifier="underbar" type="password" placeholder="Password" size="35" required float></ons-input>
        </p>
        <p>
          <ons-input id="repeatPassword" modifier="underbar" type="password" placeholder="Repeat Password" size="35" required float></ons-input>
        </p>
        <p style="margin-top: 30px;">
          <ons-button onclick="register()">SAVE</ons-button>
        </p>
      </div>
      <div class="footer">
        <p><small>&copy; CMSC 2017 - Group B - Login Module</small></p>
      </div>
      <ons-modal direction="up">
        <div style="text-align: center">
          <p>
            <ons-icon icon="md-spinner" size="28px" spin></ons-icon> Loading...
          </p>
        </div>
      </ons-modal>
    </ons-page>
  </template>
</body>

</html>