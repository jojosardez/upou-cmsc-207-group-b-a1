    
<!DOCTYPE html>
<html>

<head>
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
          <ons-input id="username" modifier="underbar" placeholder="Username" name="user" float></ons-input>
        </p>
        <p>
          <ons-input id="password" modifier="underbar" type="password" placeholder="Password" name="pass" float></ons-input>
        </p>
        <p style="margin-top: 30px;">
          <ons-button onclick="login()" name="submit">Login</ons-button>
        </p>
      </div>

<?php
    if(isset($_COOKIE["login_hold"])){
    echo 'Youre not allowed to login for 30 minutes<br/>';

}
else {    
    if(isset($_POST["submit"])){    
        if(!empty($_POST['user']) && !empty($_POST['pass'])) {  
            $username=$_POST['user'];  
            $password=$_POST['pass'];

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {  
                    $_SESSION['sess_user']=$row['user_name'];
                    echo 'You are currently login now';
                }
            }else {  
                echo "Invalid Username or password!<br/>";  
                $_SESSION['login_attempts'] = $_SESSION['login_attempts'] + 1;
                echo 3 -  $_SESSION['login_attempts'] . ' attempt/s remaining.';
                if($_SESSION['login_attempts'] >= 3){
                    setcookie("login_hold", "hold", time() + (1800));
                    $_SESSION['login_attempts'] = 0; 
                }
            }  

        } else {  
            echo "All fields are required!";  
        }  
    }
}

?>
<!-- end of code-->
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
</body>

</html>