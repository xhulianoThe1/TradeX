<!DOCTYPE html>
<html>
<title>TradeX</title>
<link rel="stylesheet" href="login.css">
<body>

<div> 
<p id = "xuser"> Sign in </p>
<p id = "nuser"> Sign up</p>
<p id="logo"> TradeX</p>
</div>

<!-- sign in modal -->
<div id="myModal" class="modal">
<!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
    <span class="close">&times;</span>
    <h2>Log in</h2>
    </div>
<div class="modal-body">
  <form action="user.php" method="submit">
  <div class="container">
    <label for="uname"><b></b></label>
    <input type="text" placeholder="Enter Username!" name="uname" required>
    <br>
    <label for="psw"><b></b></label>
    <input type="password" placeholder="Enter Password!" name="psw" required>
    <br>
    <button type="submit" name="submit" class="btn btn-primary" id="submit-credentials">Login</button>
    <br>
  </div>
  </form>
</div>    
  </div>
    </div>
<!-- Java script for the modal --> 
<script> 
  // When the user clicks the button, open the modal
  var modal = document.getElementById("myModal");
  var xuser = document.getElementById('xuser')  
  //Closing the modal
  var span = document.getElementsByClassName("close")[0]
  xuser.onclick = function() {
  modal.style.display = "block";
  }
  // When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script> 



<!-------------------------------------------------------------------------> 
<!-- sign up modal -->
<div id="myModal2" class="modal2">
<!-- Modal content -->
  <div class="modal2-content">
    <div class="modal2-header">
    <span class="close2">&times;</span>
    <h2>Sign up</h2>
    </div>
<div class="modal2-body">
  <form action="validate.php" method="post">
  <div class="container">
    <label for="email"><b></b></label>
    <input type="text" placeholder="Email!" name="email" required>
    <br>
    <label for="fname"><b></b></label>
    <input type="text" placeholder="First name!" name="fname" required>
    <br>
    <label for="lname"><b></b></label>
    <input type="text" placeholder="Last name!" name="lname" required>
    <br>
    <label for="uname"><b></b></label>
    <input type="text" placeholder="Username!" name="uname" required>
    <br>
    <label for="psw"><b></b></label>
    <input type="password" placeholder="Password!" name="psw" required>
    <br>
    <label for="psw"><b></b></label>
    <input type="password" placeholder="Re-enter Password!" name="psw" required>
    <br>
    <button type="submit">Sign up</button>
    <br>
  </div>
  </form>
</div>    
  </div>
    </div>
    
<!-- Java script for the signup modal --> 
<script> 
  // When the user clicks the button, open the modal
  var modal2 = document.getElementById("myModal2");
  var nuser = document.getElementById('nuser')  
  //Closing the modal
  var span2 = document.getElementsByClassName("close2")[0]
  nuser.onclick = function() {
  modal2.style.display = "block";
  }
  // When the user clicks on <span> (x), close the modal
span2.onclick = function() {
  modal2.style.display = "none";
}
</script> 
 


<!-------------------------------------------------------------------------> 
<!-- The following is for the HYPONOS-->
    <style>
      * {
        margin: 0;
        padding: 0;
      }
      html, body {
        height: 100%;
      }
      canvas {
        display: block;
        
        margin: 0px auto;
      }
      p {
        position: relative;
        text-align: center;
        margin-top: 10px;
        font-family: monospace;
      }
    </style>
    <link href='https://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'>
  </head>
  <body>

    <div class="main-container">
      <canvas></canvas>
    </div>

    <script>
      (function() {
        var canvas = document.querySelector( 'canvas' ),
          context = canvas.getContext( '2d' ),
          width = window.innerWidth * 0.7,
          height = window.innerHeight * 0.7,
          radius = Math.min( width, height ) * 0.5,
          // Number of layers
          quality = 180,
          // Layer instances
          layers = [],
          // Width/height of layers
          layerSize = radius * 0.25,
          // Layers that overlap to create the infinity illusion
          layerOverlap = Math.round( quality * 0.1 );
        function initialize() {
          for( var i = 0; i < quality; i++ ) {
            layers.push({
              x: width/2 + Math.sin( i / quality * 2 * Math.PI ) * ( radius - layerSize ),
              y: height/2 + Math.cos( i / quality * 2 * Math.PI ) * ( radius - layerSize ),
              r: ( i / quality ) * Math.PI
            });
          }
          resize();
          update();
        }
        function resize() {
          canvas.width = width;
          canvas.height = height;
        }
        function update() {
          requestAnimationFrame( update );
          step();
          clear();
          paint();
        }
        // Takes a step in the simulation
        function step () {
          for( var i = 0, len = layers.length; i < len; i++ ) {
            layers[i].r += 0.01;
          }
        }
        // Clears the painting
        function clear() {
          context.clearRect( 0, 0, canvas.width, canvas.height );
        }
        // Paints the current state
        function paint() {
          // Number of layers in total
          var layersLength = layers.length;
          // Draw the overlap layers
          for( var i = layersLength - layerOverlap, len = layersLength; i < len; i++ ) {
            context.save();
            context.globalCompositeOperation = 'destination-over';
            paintLayer( layers[i] );
            context.restore();
          }
          // Cut out the overflow layers using the first layer as a mask
          context.save();
          context.globalCompositeOperation = 'destination-in';
          paintLayer( layers[0], true );
          context.restore();
          // // Draw the normal layers underneath the overlap
          for( var i = 0, len = layersLength; i < len; i++ ) {
            context.save();
            context.globalCompositeOperation = 'destination-over';
            paintLayer( layers[i] );
            context.restore();
          }
        }
        // Pains one layer
        function paintLayer( layer, mask ) {
          size = layerSize + ( mask ? 10 : 0 );
          size2 = size / 2;
          context.translate( layer.x, layer.y );
          context.rotate( layer.r );
          // No stroke if this is a mask
          if( !mask ) {
            context.strokeStyle = '#000';
            context.lineWidth = 1;
            context.strokeRect( -size2, -size2, size, size );
          }
          context.fillStyle = '#fff'; 
          context.fillRect( -size2, -size2, size, size );
        }
        /**
         * rAF polyfill.
         */
        (function() {
          var lastTime = 0;
          var vendors = ['ms', 'moz', 'webkit', 'o'];
          for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
            window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
            window.cancelAnimationFrame = 
              window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
          }
          if (!window.requestAnimationFrame)
            window.requestAnimationFrame = function(callback, element) {
              var currTime = new Date().getTime();
              var timeToCall = Math.max(0, 16 - (currTime - lastTime));
              var id = window.setTimeout(function() { callback(currTime + timeToCall); }, 
                timeToCall);
              lastTime = currTime + timeToCall;
              return id;
            };
          if (!window.cancelAnimationFrame)
            window.cancelAnimationFrame = function(id) {
              clearTimeout(id);
            };
        }());
        initialize();
      })();
    </script>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

    <!----------------------------------End of HYPNOS----------------------------------------------------------------->  

  <!-----------------------------------background--------------------------------------------------------------------->
  <link rel='stylesheet' id='screen-css'  href='https://www.clarium.com/themes/clarium-intranet/assets/styles/screen.css?ver=1570399193' type='text/css' media='all' />
  <script type="text/javascript">
      if( typeof window.globals != 'object' ) {
        window.globals = {
          urls : {"site":"https:\/\/www.clarium.com","template":"https:\/\/www.clarium.com\/themes\/clarium-intranet","scripts":"https:\/\/www.clarium.com\/themes\/clarium-intranet\/assets\/scripts","styles":"https:\/\/www.clarium.com\/themes\/clarium-intranet\/assets\/styles","images":"https:\/\/www.clarium.com\/themes\/clarium-intranet\/assets\/images","lib":"https:\/\/www.clarium.com\/themes\/clarium-intranet\/helper","prototype":"https:\/\/www.clarium.com\/themes\/clarium-intranet\/prototype"}        };
      } 
    </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
  <script src="https://www.clarium.com/themes/clarium-intranet/assets/scripts/plugins.js?1570399193"></script>
  <script src="https://www.clarium.com/themes/clarium-intranet/assets/scripts/global.js?1570399193"></script>
  <!-----------------------------------End of Background-------------------------------------------------------------------->

  </body>
  </html> 
 
 <!--  <footer>
    <p class="copyright">© GROUP Z 2019</p>
</footer>
<style>
    footer {
        position: relative;
        height: 25px;
        width: 100%;
        background-color: #333333;
    }

    p.copyright {
        position: absolute;
        width: 100%;
        color: #fff;
        line-height: 40px;
        font-size: 1em;
        text-align: center;
        bottom:0;
    }
</style> -->

<!-- 
    <form action="create.php" method="post">
    <button type="submit">New User? Create an account here!</button>
    </form>
 -->    