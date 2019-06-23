<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
</head>
<body>

<!--INICIO FORMULARIO -->
<input type="text" id="nombre" placeholder="nombre"> <br>
<input type="text" id="apellido" placeholder="apellido"> <br>
<input type="text" id="id"><br>
<button id="guardar">Guardar</button>
<button id="actualizar">Actualizar</button>
<!--FIN DEL FORMULARIO -->

<!--INICIO CREAR UNA TABLA PARA MOSTRAR LOS DATOS -->

	<table id="datos" border="1">
		<th>Nombre</th>
		<th>Apellido</th>
		<th></th>
		<th></th>
	</table>

<!--FIN CREAR UNA TABLA PARA MOSTRAR LOS DATOS -->

<!-- JQUERY INICIO-->
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<!-- JQUERY FIN-->



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

//INICIO GUARDAR LOS DATOS EN FIREBASE
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
//FIN GUARDAR LOS DATOS EN FIREBASE

//INICIO MOSTRAR DATOS
	database.ref('personas').on('child_added',function(data){
		const row = '<tr id="'+data.val().id+'">'+
		'<td>'+data.val().nombre+'</td>'+
		'<td>'+data.val().apellido+'</td>'+
		'<td><button value="'+data.val().id+'" onclick="editar(this.value)">Editar</button></td>'+
		'<td><button value="'+data.val().id+'" onclick="eliminar(this.value)">Eliminar</button></td>'+
		'</tr>';
		$('#datos').append(row);
	});

//FIN MOSTRAR DATOS

//INICIO FUNCIÓN CHILD_CHANGED
database.ref('personas').on('child_changed',function(data){

		$('#'+data.val().id).remove();

		const row = '<tr id="'+data.val().id+'">'+
		'<td>'+data.val().nombre+'</td>'+
		'<td>'+data.val().apellido+'</td>'+
		'<td><button value="'+data.val().id+'" onclick="editar(this.value)">Editar</button></td>'+
		'<td><button value="'+data.val().id+'" onclick="eliminar(this.value)">Eliminar</button></td>'+
		'</tr>';
		$('#datos').append(row);
	});
//FIN FUNCIÓN CHILD_CHANGED

//INICIO EDITAR DATOS
	function editar(id){
		firebase.database().ref('personas/'+ id).once('value').then(function(snapshot){

			var nombre = snapshot.val().nombre;
			var apellido = snapshot.val().apellido;
			var id = snapshot.val().id;
			$('#nombre').val(nombre);
			$('#apellido').val(apellido);
			$('#id').val(id);
		});
	}

//FIN EDITAR DATOS

//INICIO ACTUALIZAR BOTON
$('#actualizar').click(function(event){
	//Guardar en variales los valores 
	var id = $('#id').val();
	var nombre = $('#nombre').val();
	var apellido = $('#apellido').val();
	
	var post = {
		nombre: nombre,
		apellido: apellido
	};

	database.ref('personas/'+id).update(post);

	//limpiar valores 
	$('#id').val('');
	$('#nombre').val('');
	$('#apellido').val('');


});
//FIN ACTUALIZAR BOTON
</script>
</body>
</html>