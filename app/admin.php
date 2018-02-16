<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="assets/lib/onsenui/css/onsenui.css">
    <link rel="stylesheet" href="assets/lib/onsenui/css/onsen-css-components.min.css">
    <script src="assets/lib/onsenui/js/onsenui.min.js"></script>
    <script src="assets/lib/jquery/js/jquery.min.js"></script>
    <script src="assets/js/admin.js"></script>
  </head>
  <body>
  <ons-page>
        <ons-toolbar>
            <div class="center">CMSC 207 - Group B - Admin Dashboard</div>
        </ons-toolbar>
        <div style="text-align: center; margin-top: 30px;">
            <ons-list id="users" modifier="inset">
                <ons-list-header>Users</ons-list-header>
                <ons-lazy-repeat id="usersList"></ons-lazy-repeat>
            </ons-list>
        </div>
  </ons-page>
  </body>
</html>
