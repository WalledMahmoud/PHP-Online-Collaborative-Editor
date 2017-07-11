<?php
/*  
    * Application: WEBW Online Editor 
    * Description: Online Editor With Real-Time Collaborative Editing 
    * Author: Walled Mahmoud Soliman
    * Author Site: https://walledmahmoud.github.io/WalledMahmoud/
    * Version : 1.0.1
    
    * Created By:
      - PHP
      - JavaScript
      - CodeMirror
      - Firebase 
      - FirePad
*/
?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>WEBW Online Editor</title>

    <!-- Main Style -->
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
    <link rel="media/shortcut icon" href="WEBW.ico" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!-- My Style -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- CodeMirror Addons -->
    <link rel="stylesheet" href="js/codemirror/addon/lint/lint.css"/>
    <!-- CodeMirror-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.17.0/codemirror.css" />
    <!-- CodeMirror Style & Theme -->
    <link rel="stylesheet" href="js/codemirror/lib/codemirror.css" />
    <link rel="stylesheet" href="js/codemirror/theme/bespin.css" />
    <link rel="stylesheet" href="js/codemirror/theme/base16-dark.css" />
    <link rel="stylesheet" href="js/codemirror/theme/seti.css" />
    <!-- Firepad -->
    <link rel="stylesheet" href="https://cdn.firebase.com/libs/firepad/1.4.0/firepad.css" />

  </head>

  <body>

      <!-- Navbar -->
      <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="navbar-inner">
              <div class="container">
                  <div class="btn-red btn-code">&#9658; Run</div>
              </div>
          </div>
          <div class="clear"></div>
      </div>

    <!-- Editor, Users, Output -->
    <div class="wrapper">

        <div id="userlist"></div>
        <div id="firepad"></div>
        
        <div id="output">
            <div class="result"></div>
        </div>

    </div><!-- End Wrapper -->
      
    <!-- jQuery -->
    <script src="js/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- The CodeMirror -->
    <script src="js/codemirror/lib/codemirror.js"></script>
    <!-- The CodeMirror Modes - note: for HTML rendering required: xml, css, javasript -->
    <script src="js/codemirror/mode/xml/xml.js"></script>
    <script src="js/codemirror/mode/clike/clike.js"></script>
    <script src="js/codemirror/mode/javascript/javascript.js"></script>
    <script src="js/codemirror/mode/css/css.js"></script>
    <script src="js/codemirror/mode/php/php.js"></script>
    <script src="js/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <!-- CodeMirror Addons -->
    <script src="js/codemirror/addon/selection/active-line.js"></script>
    <script src="js/codemirror/addon/lint/lint.js"></script>
  

    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/4.1.3/firebase.js"></script>
    <!-- FirePad -->
    <script src="https://cdn.firebase.com/libs/firepad/1.4.0/firepad.min.js"></script>
    <script src="js/firepad/firepad-userlist.js"></script>
    <script src="https://cdn.firebase.com/libs/firepad/1.4.0/firepad.min.js"></script>


    <!-- My Script -->
    <script src="js/main.js"></script>

  </body>
</html>
