    
<!DOCTYPE html>
<html>

<head>
  <title>Login | CMSC-207 - Group B - Login Module</title>
  <link rel="stylesheet" href="assets/lib/onsenui/css/onsenui.css">
  <link rel="stylesheet" href="assets/lib/onsenui/css/onsen-css-components.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/lib/onsenui/js/onsenui.min.js"></script>
  <script src="assets/lib/jquery/js/jquery.min.js"></script>
  <script src="assets/js/common.js"></script>
  <script src="assets/js/login.js"></script>
</head>

<body>
  <ons-splitter>
    <ons-splitter-content id="content" page="home"></ons-splitter-content>
  </ons-splitter>
  <template id="home">
    <ons-page>
      <ons-toolbar>
        <div class="left">
          <ons-toolbar-button>
            <img class="logoBorder" src="assets/images/upoulogo.png" alt="UPOU Logo">
          </ons-toolbar-button>
        </div>
        <div class="center">Login</div>
      </ons-toolbar>
      <div style="text-align: center; margin-top: 30px;">
          
        <p>
          <ons-input id="username" modifier="underbar" placeholder="Username" size="35" required float></ons-input>
        </p>
        <p>
          <ons-input id="password" modifier="underbar" type="password" placeholder="Password" size="35" required float></ons-input>
        </p>
        <p style="margin-top: 30px;">
          <ons-button onclick="login()" name="submit">Login</ons-button>
        </p>
      </div>
      <div style="text-align: center; margin-top: 30px;">
        <p>
          <ons-button modifier="quiet" onclick="location.href = 'register.php';">Register</ons-button>
          |
          <ons-button modifier="quiet" onclick="location.href = 'forgot.php';">Forgot Password</ons-button>
        </p>
      </div>
      <div class="footer">
        <p><small>&copy; CMSC 2017 - Group B - Login Module</small></p>
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