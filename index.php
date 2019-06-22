<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
</head>
<body>

<input type="text" id="nombre" placeholder="nombre"> <br>
<input type="text" id="apellido" placeholder="apellido"> <br>
<button id="guardar">Guardar</button>


<!-- JQUERY -->
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>




<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.2.2/firebase.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyAavr33telrgXJzIUkcclYNfZXYyHhWa8E",
    authDomain: "crud-firebase-6475e.firebaseapp.com",
    databaseURL: "https://crud-firebase-6475e.firebaseio.com",
    projectId: "crud-firebase-6475e",
    storageBucket: "",
    messagingSenderId: "619177160717",
    appId: "1:619177160717:web:443d2df2c007f431"
  };

  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

  var database = firebase.database();
  $('#guardar').click(function(){
  	//Almacenar los valores 
  		var nombre = $('#nombre').val();
  		var apellido = $('#apellido').val();
  	//Generar el id 
  		var id = firebase.database().ref().child('personas').push().key;
  	// Guardar
  	firebase.database().ref('personas/'+id).set({

  		nombre:nombre,
  		apellido:apellido,
  		id:id
  	});
  	//Limpiar el registro
  	$('#nombre').val("");
  	$('#apellido').val("");
  });
  
</script>
</body>
</html>