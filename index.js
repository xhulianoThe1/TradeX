var express = require('express');
var app = express();
app.set('port', (process.env.PORT || 5000));

app.use(express.static('CSI418'));
var http = require('http');
var server = http.Server(app);

app.set('view engine', 'ejs');

app.get('/'. function(request, respond){
	response.render('CSI418/index');
});


server.listen(PORT, function() {
  console.log('server running', app.get('port'));
});
/*
var io = require('socket.io')(server);

io.on('connection', function(socket) {
  socket.on('message', function(msg) {
    io.emit('message', msg);
  });
});

/*
const port = 3000;

var express = require('express'),
    app = express();
var bodyParser = require('body-parser');

app.use(express.static(__dirname + '/public'));

app.use(bodyParser.urlencoded({
   extended: false
}));

app.use(bodyParser.json());

app.get('/', function(req, res){
  res.render('form');// if jade
  // You should use one of line depending on type of frontend you are with
  res.sendFile(__dirname + '/form.html'); //if html file is root directory
 res.sendFile("index.html"); //if html file is within public directory
});

app.post('/',function(req,res){
   var username = req.body.username;
   var htmlData = 'Hello:' + username;
   res.send(htmlData);
   console.log(htmlData);
});

app.listen(port);
*/