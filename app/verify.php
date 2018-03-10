<!DOCTYPE html>
<html>

<head>
    <title>Verify Account | CMSC-207 - Group B - Login Module</title>
    <link rel="stylesheet" href="assets/lib/onsenui/css/onsenui.css">
    <link rel="stylesheet" href="assets/lib/onsenui/css/onsen-css-components.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/lib/onsenui/js/onsenui.min.js"></script>
    <script src="assets/lib/jquery/js/jquery.min.js"></script>
    <script src="assets/js/common.js"></script>
    <script src="assets/js/verify.js"></script>
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
          <ons-list-item onclick="location.href = 'register.php';" tappable>
            Register
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
                <div class="center">Verify Account</div>
            </ons-toolbar>
            <div style="text-align: center; margin-top: 30px;">
                <div id="message"></div>
            </div>
            <div class="footer">
              <p><small>&copy; CMSC-207 - Group B - Login Module</small></p>
            </div>
        </ons-page>
    </template>
    <ons-modal direction="up">
      <div style="text-align: center">
        <p>
          <ons-icon icon="md-spinner" size="28px" spin></ons-icon>
        </p>
      </div>
    </ons-modal>
</body>

</html>
