<html lang="en">

<head>
	<title>Robot Da Vinci</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<?php
	$mensaje = '';
	$ocultarLogin = '';
	$ocultarOpciones = 'style="display: none;"';
	if (isset($_POST['login']) && !empty($_POST['usuario']) && !empty($_POST['contrasenia'])) {

		$sqlBusquedaUsuario = "select * from HDOC_DAVINCI_empleados where upper(dni)=upper('" . $_POST['usuario'] . "') ";
		//echo $sqlBusquedaUsuario."<br>";
		$queryBusquedaUsuario = oci_parse($conn, $sqlBusquedaUsuario);
		oci_execute($queryBusquedaUsuario);
		$usuarioAutorizado = false;
		while ($row = oci_fetch_array($queryBusquedaUsuario, OCI_ASSOC)) {
			$usuarioAutorizado = true;
			$rol = utf8_encode($row['TIPOEMPLEADO']);
		}
		if ($usuarioAutorizado == true) {
			$site = "10.35.53.23";
			$port = 6772;
			set_time_limit(0);
			$fp = fsockopen($site, $port, $errno, $errstr, 10);
			if (!$fp) {
				//echo "$errstr ($errno)\n";
			} //if(!$fp){
			else {
				//echo "fsockopen funciona";					
				$myObj = new stdClass();
				$myObj->user = $_POST['usuario'];
				$myObj->password = $_POST['contrasenia'];
				$myJSON = json_encode($myObj);
				$a = fwrite($fp, $myJSON);
				while (!feof($fp)) {
					//echo $a;
					$output = fgets($fp, 2048);
					//echo $output;
				} //while(!feof( $fp)){
				$json = $output;
				$obj = json_decode($json);
				//echo $obj->usuario;
				//echo $obj->error;
				//echo $obj->rol;
				//echo $obj->nombre;
				//echo $obj->apellidos;
			} //else-if(!$fp){
			if ($obj->error == null && $obj->rol != 'Sin permisos') {
				$_SESSION['valid'] = true;
				$_SESSION['timeout'] = time();
				$_SESSION['usuario'] = $obj->usuario;
				$_SESSION['rol'] = $rol;
				$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
				$_SESSION['nombre'] = $obj->nombre;
				$_SESSION['apellidos'] = $obj->apellidos;
				$mensaje = 'Bienvenido ' . $obj->nombre . ' ' . $obj->apellidos . '.<br>Tu rol es: ' . $rol . '.<br>Estas conectado desde la ip: ' . $_SERVER['REMOTE_ADDR'];
				$ocultarLogin = 'style="display: none;"';
				$ocultarOpciones = '';
				//header('Refresh: 0; URL = Inicio.php');
				$sqlInsertLog = "insert into HDOC_DAVINCI_LOGS (idlog,operacion,fechaoperacion,usuario,password,observacion,ip) values (S_HDOC_DAVINCI_LOGS.nextval,'Login',sysdate,'" . $_POST['usuario'] . "','" . $_POST['contrasenia'] . "','Login correcto','" . $_SERVER['REMOTE_ADDR'] . "')";
				$queryLog = oci_parse($conn, $sqlInsertLog);
				oci_execute($queryLog);
			} //if($obj->error==null&&$obj->rol!='Sin permisos'){
			else {
				if ($obj->error == null && $obj->rol == 'Sin permisos') {
					$mensaje = 'Usuario sin permisos';
					$sqlInsertLog = "insert into HDOC_DAVINCI_LOGS (idlog,operacion,fechaoperacion,usuario,password,observacion,ip) values (S_HDOC_DAVINCI_LOGS.nextval,'Login',sysdate,'" . $_POST['usuario'] . "','" . $_POST['contrasenia'] . "','" . $mensaje . "','" . $_SERVER['REMOTE_ADDR'] . "')";
					$queryLog = oci_parse($conn, $sqlInsertLog);
					oci_execute($queryLog);
				} //if($obj->error==null&&$obj->rol=='Sin permisos'){
				else {
					$mensaje = 'Usuario o contraseÃ±a incorrecto';
					$sqlInsertLog = "insert into HDOC_DAVINCI_LOGS (idlog,operacion,fechaoperacion,usuario,password,observacion,ip) values (S_HDOC_DAVINCI_LOGS.nextval,'Login',sysdate,'" . $_POST['usuario'] . "','" . $_POST['contrasenia'] . "','" . $mensaje . "','" . $_SERVER['REMOTE_ADDR'] . "')";
					//echo $sqlInsertLog;
					$queryLog = oci_parse($conn, $sqlInsertLog);
					oci_execute($queryLog);
				} //else-if($obj->error==null&&$obj->rol=='Sin permisos'){
			} //else-if($obj->error==null&&$obj->rol!='Sin permisos'){
		} //if($usuarioAutorizado==true){	
		else {
			$mensaje = 'Usuario no autorizado';
			$sqlInsertLog = "insert into HDOC_DAVINCI_LOGS (idlog,operacion,fechaoperacion,usuario,password,observacion,ip) values (S_HDOC_DAVINCI_LOGS.nextval,'Login',sysdate,'" . $_POST['usuario'] . "','" . $_POST['contrasenia'] . "','" . $mensaje . "','" . $_SERVER['REMOTE_ADDR'] . "')";
			$queryLog = oci_parse($conn, $sqlInsertLog);
			oci_execute($queryLog);
		}
	} //if(isset($_POST['login'])&& !empty($_POST['usuario'])&& !empty($_POST['contrasenia'])){
	else {
		if (isset($_SESSION['valid'])) {
			header('Refresh: 0; URL = Inicio.php');
		} //if(isset($_SESSION['valid'])){
		else {
			$sqlLogs = "insert into HDOC_DAVINCI_LOGS (idlog,operacion,fechaoperacion,usuario,observacion,ip) values (S_HDOC_DAVINCI_LOGS.nextval,'Login',sysdate,'Alguien sin loguear','','" . $_SERVER['REMOTE_ADDR'] . "')";
			//echo $sqlLogs;	
			$queryLogs = oci_parse($conn, $sqlLogs);
			oci_execute($queryLogs);
			oci_free_statement($queryLogs);
		}



	} //else-if(isset($_POST['login'])&& !empty($_POST['usuario'])&& !empty($_POST['contrasenia'])){
	
	oci_close($conn);
	?>


	<div class="form-style-5" <?php echo $ocultarLogin; ?>>
		<legend><span class="titulo">LOGIN</span>Reserva simulador Da Vinci</legend>
		<h4>
			<?php echo $mensaje; ?>
		</h4>
		<form role="form" <?php echo $ocultarLogin; ?> action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
			method="post">
			<input type="text" name="usuario" placeholder="Usuario del dominio SALUD" required autofocus></br>
			<input type="password" name="contrasenia" placeholder="ContraseÃ±a del dominio SALUD" required></br>
			<input type="submit" name="login" />
		</form>
	</div>

	<div class="form-style-5" <?php echo $ocultarOpciones; ?>>
		<legend><span class="titulo">LOGIN</span>Simulador Da Vinci</legend>
		<h4>
			<?php echo $mensaje; ?>
		</h4>
		<form action="/DaVinci/Reservar.php">
			<input type="submit" value="Reservar hora" />
		</form>
		<form action="/DaVinci/Anular.php">
			<input type="submit" value="Anular hora reservada" />
		</form>
		<form action="/DaVinci/Listado.php">
			<input type="submit" value="Lista de horas reservadas" />
		</form>
		<form action="/DaVinci/Logout.php">
			<input type="submit" value="Cerrar sesi&oacute;n." />
		</form>
	</div>

</body>

</html>