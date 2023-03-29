<?php
require('../../../lib/fpdf185/fpdf.php');

// conecta a la base de datos
require "../../../config/class.pdo.php";

header("charset=utf-8");
$desde=$_GET['desde'];
$hasta=$_GET['hasta'];
class PDF extends FPDF{
	var $widths;
	var $aligns;
	function SetWidths($w)	{
		$this->widths = $w; //Ajuste el ancho de las columnas de la matriz
	}
	function SetAligns($a)	{
		$this->aligns = $a; //Establecer las alineaciones de la columna de la matriz
	}
	function Row($data)	{
		//Calcular la altura de la fila
		$nb = 0;
		for ($i = 0; $i < count($data); $i++)
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h = 5 * $nb;
		//Emitir un salto de página en primer lugar si es necesario
		$this->CheckPageBreak($h);
		//Dibuje las células de la fila
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Guardar la posición actual
			$x = $this->GetX();
			$y = $this->GetY();
			//Dibuja el borde
			$this->Rect($x, $y, $w, $h);
			$this->MultiCell($w, 5, $data[$i], 'LR', $a, 'false'); // esta me deja el color del encabezado
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x + $w, $y);
		}
		//ir a la siguiente linea
		$this->Ln($h);
	}
	function CheckPageBreak($h)	{
		//Si la altura h podría causar un desbordamiento, añadir una nueva página de inmediato
		if ($this->GetY() + $h > $this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}
	function NbLines($w, $txt)	{
		//Calcula el número de líneas de un MultiCell de ancho
		$cw = &$this->CurrentFont['cw'];
		if ($w == 0)
			$w = $this->w - $this->rMargin - $this->x;
		$wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
		$s = str_replace("\r", '', $txt);
		$nb = strlen($s);
		if ($nb > 0 and $s[$nb - 1] == "\n")
			$nb--;
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$nl = 1;
		while ($i < $nb) {
			$c = $s[$i];
			if ($c == "\n") {
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
				continue;
			}
			if ($c == ' ')
				$sep = $i;
			$l += $cw[$c];
			if ($l > $wmax) {
				if ($sep == -1) {
					if ($i == $j)
						$i++;
				} else
					$i = $sep + 1;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
			} else
				$i++;
		}
		return $nl;
	}
	// Cabecera de página
	function Header(){
		$Meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$mes_ex=explode("-",$_GET['desde']);
		$mes_desde=$Meses[$mes_ex['1']-1];
		$anio_desde=$mes_ex['0'];
		$mes_ex_hasta=explode("-",$_GET['hasta']);
		$mes_hasta=$Meses[$mes_ex_hasta['1']-1];
		$anio_hasta=$mes_ex_hasta['0'];
		$this->Image('../../../images/imagen.png', 50, 3, 110, 16);
		$this->SetTextColor(0);
		$this->SetFont('Arial', 'B', 10);
		$this->SetLeftMargin(5);
		$this->SetY(20);
		$this->SetFillColor(239, 239, 239);
		$this->MultiCell(0, 5, (utf8_decode("Secretaría Ejecutiva del SIPINNA Estatal \r\n* Reporte Total Canalización* \nSecretaría de Seguridad Pública\nNúm. de denuncias: $mes_desde de $anio_desde a $mes_hasta de $anio_hasta")), 0, 'C');
		//$this->Text(175, 30, 'Fecha: ' . date('d/m/Y'));
		$this->Ln();
		/*$this->SetY(45);
		$this->SetFont('Arial', 'B', 8);
		$this->Cell(30, 5, 'Nombre', 1, 0, 'C', true);
		$this->Cell(40, 5,  'Apellido', 1, 0, 'C', true);
		$this->Cell(32, 5, 'Email', 1, 0, 'C', true);
		$this->Cell(35, 5, 'Usuario', 1, 0, 'C', true);
		$this->Cell(40, 5, 'Departamento', 1, 0, 'C', true);
		$this->Cell(27, 5, 'Rol', 1, 0, 'C', true); */
	}

	function Footer(){

		$this->SetY(-15); //A que distancia del final de la pagina se pondra
		$this->SetFont('Arial', 'I', 8); //Tipo de letra, tamaño y fuente
		$this->AliasNbPages(); //Añada el numero total de paginas
		//Imprime el numero de la pagina, se decide en que parte ponerlo Centrado, a la izquierda o derecha
		//La etiqueta {nb} induca el total de paginas que hay
		$this->Cell(0, 10, (utf8_decode('Página ')) . $this->PageNo() . ' de {nb}', 0, 0, 'C');
		$this->SetY(-10);
		$this->Cell(0, 10, (utf8_decode('*NOTA: Cabe hacer mención que los casos involucran a más de una niña, niño o adolescente ')) , 0, 0, 'R');
		$this->Image('../../../images/logo_corto.png', 0, $this->SetY(-20), 75, 20);
	}
}
$Meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$mes_ex=explode("-",$_GET['desde']);
$mes_desde=$Meses[$mes_ex['1']-1];
$anio_desde=$mes_ex['0'];
$mes_ex_hasta=explode("-",$_GET['hasta']);
$mes_hasta=$Meses[$mes_ex_hasta['1']-1];
$anio_hasta=$mes_ex_hasta['0'];

$conexion = new Conexion(); //Se crea un nuevo objeto de la clase conexion
$conexion->conectar(); //Se llama la funcion conectar

$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AddPage();//Añade una nueva pagina al documento
$pdf->SetY(42);//POsicion en Y de la hoja

//Preparas la sentencia para mandar a traer los datos que se mostrararan en el PDF asi como la union de 2 tabalas
//$sqlQuery = "SELECT usr.nombre, usr.apellidos, usr.email, usr.usuario, usr.departamento, usr.rol_id, r.rol FROM usuarios AS usr INNER JOIN roles AS r ON r.idRol = usr.rol_id  where id_usuario>0";

// Datos por Municipio
$pdf->SetX(50);
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(115, 5,  utf8_decode("Número de denuncias recibidas del mes de  $mes_desde de $anio_desde a $mes_hasta de $anio_hasta"), 1, 0, 'C', true);
$pdf->Ln();//Salto de Linea
$pdf->SetX(50);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(98, 98, 98);//Relleno de los encabezados
$pdf->SetTextColor(255);//Color del texto
$pdf->Cell(115, 5, utf8_decode('Número de casos'), 1, 0, 'C', true);
$pdf->SetWidths(array(115)); //Especifica el tamaño que tendran las columnas de la tabla a mostrar
$pdf->SetFillColor(255);
$pdf->SetAligns(array('C'));
$pdf->SetTextColor(0);
$pdf->Ln();
$pdf->SetX(50);

$queryMun = "	SELECT 			can_fecha,count(*) as Numero
				FROM			tbl_can_expediente
				WHERE 			can_fecha 
				BETWEEN			?
				AND 			?	
				AND 		activo = ?	
";
$stmtMun = $conexion->dbh->prepare($queryMun);
$stmtMun->execute(array($desde,$hasta,1));



if ($stmtMun->rowCount() > 0) {
	while ($municipio = $stmtMun->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Row(array(utf8_decode($municipio["Numero"])));
	}
	
	
	$pdf->Ln();
} else {
	$pdf->Cell(204, 5,  'No tiene datos', 1, 0, 'C', true);
	$pdf->Ln();
}


// Datos por Edades <18
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(204, 5,  'Tabla de casos por edades', 1, 0, 'C', true);
$pdf->Ln();//Salto de Linea
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(98, 98, 98);//Relleno de los encabezados
$pdf->SetTextColor(255);//Color del texto
$pdf->Cell(102, 5, utf8_decode('Edad de niños(as)'), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Número de casos'), 1, 0, 'C', true);
$pdf->SetWidths(array(102,102)); //Especifica el tamaño que tendran las columnas de la tabla a mostrar
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetAligns(array('C','C'));
$pdf->Ln();

$queryEdad = "SELECT 			can_edad_vic AS Edad ,COUNT(*) AS Numero
							
								FROM 			(tbl_can_victimas
								LEFT JOIN		tbl_can_expediente
								ON				tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
								WHERE 			can_fecha 
								BETWEEN			?
								AND 			?
								AND 		activo = ?
								GROUP BY 		can_edad_vic
								ORDER BY 		can_edad_vic ASC
				";
$stmtEdad = $conexion->dbh->prepare($queryEdad);
$stmtEdad->execute(array($desde,$hasta,1));

$queryTotal = "SELECT 		sum(Case When 	can_edad_vic <=18 then 1 ELSE 0 END) AS Total
				FROM 		(tbl_can_victimas 
				LEFT JOIN 	tbl_can_expediente 
				ON 			tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente) 
				WHERE 		can_fecha 
				BETWEEN 	? 
				AND 		? 
				AND 		activo = ?
				";
$stmtTotal = $conexion->dbh->prepare($queryTotal);
$stmtTotal->execute(array($desde,$hasta,1));
$total = $stmtTotal->fetch(PDO::FETCH_ASSOC);
if ($stmtEdad->rowCount() > 0) {
	while ($edades = $stmtEdad->fetch(PDO::FETCH_ASSOC)) {
		if($edades["Edad"]<='18'){
		$pdf->Row(array(utf8_decode($edades["Edad"].' Años'), utf8_decode($edades["Numero"])));
		}
	}

	
	$pdf->Cell(102, 5,  'Total: ', 1, 0, 'C', true);
	$pdf->Cell(102, 5,  $total['Total'].' NNA', 1, 0, 'C', true);
	$pdf->Ln();
	$pdf->Ln();
} else {
	$pdf->Cell(204, 5,  'No tiene datos', 1, 0, 'C', true);
	$pdf->Ln();
}

// Datos por Edades >18
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(204, 5, utf8_decode ('Tabla de casos por edades mayores de 18 años'), 1, 0, 'C', true);
$pdf->Ln();//Salto de Linea
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(98, 98, 98);//Relleno de los encabezados
$pdf->SetTextColor(255);//Color del texto
$pdf->Cell(102, 5, utf8_decode('Edades > 18'), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Número de casos'), 1, 0, 'C', true);
$pdf->SetWidths(array(102,102)); //Especifica el tamaño que tendran las columnas de la tabla a mostrar
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetAligns(array('C','C'));
$pdf->Ln();

$queryEdad = "SELECT 			can_edad_vic AS Edad ,COUNT(*) AS Numero
							
								FROM 			(tbl_can_victimas
								LEFT JOIN		tbl_can_expediente
								ON				tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
								WHERE 			can_fecha 
								BETWEEN			?
								AND 			?
								AND 		activo = ?
								GROUP BY 		can_edad_vic
								ORDER BY 		can_edad_vic ASC
				";
$stmtEdad = $conexion->dbh->prepare($queryEdad);
$stmtEdad->execute(array($desde,$hasta,1));

$queryTotal = "SELECT 		sum(Case When 	can_edad_vic >=19 then 1 ELSE 0 END) AS Total
				FROM 		(tbl_can_victimas 
				LEFT JOIN 	tbl_can_expediente 
				ON 			tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente) 
				WHERE 		can_fecha 
				BETWEEN 	? 
				AND 		? 
				AND 		activo = ?
				";
$stmtTotal = $conexion->dbh->prepare($queryTotal);
$stmtTotal->execute(array($desde,$hasta,1));
$total = $stmtTotal->fetch(PDO::FETCH_ASSOC);
if ($stmtEdad->rowCount() > 0) {
	while ($edades = $stmtEdad->fetch(PDO::FETCH_ASSOC)) {
		if($edades["Edad"]>='19'){
		$pdf->Row(array(utf8_decode($edades["Edad"].' Años'), utf8_decode($edades["Numero"])));
		}
	}

	
	$pdf->Cell(102, 5,  'Total: ', 1, 0, 'C', true);
	$pdf->Cell(102, 5,  $total['Total'].' NNA', 1, 0, 'C', true);
	$pdf->Ln();
} else {
	$pdf->Cell(204, 5,  'No tiene datos', 1, 0, 'C', true);
	$pdf->Ln();
}



//Datos por Personas Vulneradas
$pdf->Ln();
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(204, 5,  'Tabla de casos Personas Vulneradas', 1, 0, 'C', true);
$pdf->Ln();//Salto de Linea
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(98, 98, 98);//Relleno de los encabezados
$pdf->SetTextColor(255);//Color del texto
$pdf->Cell(102, 5, utf8_decode('Personas Vulneradas'), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Número de casos'), 1, 0, 'C', true);
$pdf->SetWidths(array(102,102)); //Especifica el tamaño que tendran las columnas de la tabla a mostrar
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetAligns(array('C','C'));
$pdf->Ln();

$queryPerVul = "SELECT 			sum(Case When 	can_per_tercera_edad then 1 ELSE 0 END) AS persona_tercera,
				sum(Case When 	can_per_violencia then 1 ELSE 0 END) AS persona_violencia,
				sum(Case When 	can_per_discapacidad then 1 ELSE 0 END) AS persona_discapacidad,
				sum(Case When 	can_per_indigena then 1 ELSE 0 END) AS persona_indigena,
				sum(Case When 	can_per_transgenero then 1 ELSE 0 END) AS persona_transgenero
				FROM 			(tbl_can_victimas
				LEFT JOIN		tbl_can_expediente
				ON				tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
				WHERE 			can_fecha 
				BETWEEN			?
				AND 			?	
				AND 		activo = ?	

";
$stmtPerVul = $conexion->dbh->prepare($queryPerVul);
$stmtPerVul->execute(array($desde,$hasta,1));

$queryTotal = "	SELECT persona_tercera,persona_violencia,persona_discapacidad,persona_indigena,persona_transgenero,
						(persona_tercera+persona_violencia+persona_discapacidad+persona_indigena+persona_transgenero) AS Total
				FROM
				(SELECT			sum(Case When 	can_per_tercera_edad then 1 ELSE 0 END) AS persona_tercera,
								sum(Case When 	can_per_violencia then 1 ELSE 0 END) AS persona_violencia,
								sum(Case When 	can_per_discapacidad then 1 ELSE 0 END) AS persona_discapacidad,
								sum(Case When 	can_per_indigena then 1 ELSE 0 END) AS persona_indigena,
								SUM(Case When 	can_per_transgenero then 1 ELSE 0 END) AS persona_transgenero
				FROM 			(tbl_can_victimas 
				LEFT JOIN 	tbl_can_expediente 
				ON 			tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente) 
				WHERE 		can_fecha 
				BETWEEN 		?
				AND 			?
				AND 		activo = ?
				) AS tabla_Z	
				";
$stmtTotal = $conexion->dbh->prepare($queryTotal);
$stmtTotal->execute(array($desde,$hasta,1));
$total = $stmtTotal->fetch(PDO::FETCH_ASSOC);
if ($stmtPerVul->rowCount() > 0) {
	while ($perVul = $stmtPerVul->fetch(PDO::FETCH_ASSOC)) {
		$pdf->Cell(102, 5,  'Otros (personas de la tercera edad) ', 1, 0, 'C', true);
		$pdf->Cell(102, 5,  $perVul['persona_tercera'], 1, 0, 'C', true);
		$pdf->Ln();
		$pdf->Cell(102, 5,  'Persona Indigena ', 1, 0, 'C', true);
		$pdf->Cell(102, 5,  $perVul['persona_indigena'], 1, 0, 'C', true);
		$pdf->Ln();
		$pdf->Cell(102, 5,  'Persona Trangenero', 1, 0, 'C', true);
		$pdf->Cell(102, 5,  $perVul['persona_transgenero'], 1, 0, 'C', true);
		$pdf->Ln();
		$pdf->Cell(102, 5,  'Persona Con alguna discapacidad', 1, 0, 'C', true);
		$pdf->Cell(102, 5,  $perVul['persona_discapacidad'], 1, 0, 'C', true);
		$pdf->Ln();
		$pdf->Cell(102, 5,  'Violencia contra la mujer', 1, 0, 'C', true);
		$pdf->Cell(102, 5,  $perVul['persona_violencia'], 1, 0, 'C', true);
		$pdf->Ln();
		
	}
	
	$pdf->Cell(102, 5,  'Total de personas vulneradas: ', 1, 0, 'C', true);
	$pdf->Cell(102, 5,  $total['Total'], 1, 0, 'C', true);
	$pdf->Ln();
} else {
	$pdf->Cell(204, 5,  'No tiene datos', 1, 0, 'C', true);
	$pdf->Ln();
}

//Datos por Genero
$pdf->Ln();
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(204, 5,  'Tabla de Genero', 1, 0, 'C', true);
$pdf->Ln();//Salto de Linea
$pdf->SetFillColor(98, 98, 98);
$pdf->SetTextColor(255);//Color del texto
$pdf->Cell(102, 5, 'Genero', 1, 0, 'C', true);
$pdf->Cell(102, 5,  'Numero de Casos', 1, 0, 'C', true);
$pdf->SetWidths(array(102,102)); //Especifica el tamaño que tendran las columnas de la tabla a mostrar
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetAligns(array('C','C'));
$pdf->Ln();

$queryGenero = "SELECT 		can_sexo_victima As Genero,
				COUNT(*) AS Numero
				FROM 		(tbl_can_victimas
				LEFT JOIN	tbl_can_expediente
				ON			tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente)
				WHERE 		can_fecha 
				BETWEEN 	? 
				AND 		?
				AND 		activo = ?
				GROUP BY 	can_sexo_victima";
//Se prepara la sentecia para hacer la busqueda en el servidor
$stmtGenero = $conexion->dbh->prepare($queryGenero);
$stmtGenero->execute(array($desde,$hasta,1));

$queryTotal = "SELECT 		COUNT(*) AS Total 
				FROM 		(tbl_can_victimas 
				LEFT JOIN 	tbl_can_expediente 
				ON 			tbl_can_victimas.can_exp_folio_victima=tbl_can_expediente.can_folio_expediente) 
				WHERE 		can_fecha 
				BETWEEN 	? 
				AND 		? 
				AND 		activo = ?
				";
$stmtTotal = $conexion->dbh->prepare($queryTotal);
$stmtTotal->execute(array($desde,$hasta,1));
$total = $stmtTotal->fetch(PDO::FETCH_ASSOC);


//Hace un recorrido en la tabla para buscar todos los datos que contenga
if($stmtGenero->rowCount() > 0){
	while ($genero = $stmtGenero->fetch(PDO::FETCH_ASSOC)) {
			$pdf->Row(array(utf8_decode($genero["Genero"]), utf8_decode($genero["Numero"])));		
	}
	$pdf->Cell(102, 5,  'Total: ', 1, 0, 'C', true);
	$pdf->Cell(102, 5,  $total['Total'].' ', 1, 0, 'C', true);
	$pdf->Ln();
} else {
	$pdf->Cell(204, 5,  'No tiene datos', 1, 0, 'C', true);
	$pdf->Ln(); 
}


// Datos por mes
$pdf->Ln();
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(204, 5,  'Tabla de casos por mes', 1, 0, 'C', true);
$pdf->Ln();//Salto de Linea
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(98, 98, 98);//Relleno de los encabezados
$pdf->SetTextColor(255);//Color del texto
$pdf->Cell(102, 5, utf8_decode('Mes'), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Número de Casos'), 1, 0, 'C', true);
$pdf->SetWidths(array(102,102)); //Especifica el tamaño que tendran las columnas de la tabla a mostrar
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetAligns(array('C','C'));
$pdf->Ln();

$queryMes = "	SELECT 		can_fecha,MONTH(can_fecha)Mes , COUNT(*) AS Numero
			FROM 		tbl_can_expediente
			WHERE		can_fecha BETWEEN ? 
			AND 		?
			AND 		activo = ?
			GROUP BY 	Mes
			ORDER BY	Mes ASC;
			";
$stmtMes = $conexion->dbh->prepare($queryMes);
$stmtMes->execute(array($desde,$hasta,1));
$queryTotal = "SELECT 		COUNT(*) AS Total 
				FROM 		tbl_can_expediente 
				WHERE 		can_fecha 
				BETWEEN 	? 
				AND 		? 
				AND 		activo = ?
				";
$stmtTotal = $conexion->dbh->prepare($queryTotal);
$stmtTotal->execute(array($desde,$hasta,1));
$total = $stmtTotal->fetch(PDO::FETCH_ASSOC);


if ($stmtMes->rowCount() > 0) {
	while ($mes = $stmtMes->fetch(PDO::FETCH_ASSOC)) {
		$Meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

		$Mes=$Meses[$mes["Mes"]-1];
		$pdf->Row(array(utf8_decode($Mes), utf8_decode($mes["Numero"])));
	}
	
	$pdf->Cell(102, 5,  'Total: ', 1, 0, 'C', true);
	$pdf->Cell(102, 5,  $total['Total'], 1, 0, 'C', true);
	$pdf->Ln();
	$pdf->Ln();
} else {
	$pdf->Cell(204, 5,  'No tiene datos', 1, 0, 'C', true);
	$pdf->Ln();
}


// Datos por Municipio
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(204, 5,  'Tabla de casos por Municipio', 1, 0, 'C', true);
$pdf->Ln();//Salto de Linea
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(98, 98, 98);//Relleno de los encabezados
$pdf->SetTextColor(255);//Color del texto
$pdf->Cell(102, 5, utf8_decode('Municipio'), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Número de casos'), 1, 0, 'C', true);
$pdf->SetWidths(array(102,102)); //Especifica el tamaño que tendran las columnas de la tabla a mostrar
$pdf->SetFillColor(255);
$pdf->SetAligns(array('C','C'));
$pdf->SetTextColor(0);
$pdf->Ln();

$queryMun = "SELECT 	can_pais,can_estado,can_otros_estados,estado,can_mun_edo,can_municipio,municipio,COUNT(*) AS Numero
			FROM 		((tbl_can_expediente
			LEFT JOIN 	cat_municipios
			on			tbl_can_expediente.can_municipio=cat_municipios.id_municipio)
			LEFT JOIN 	cat_estados
			ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
			WHERE 		can_fecha 
			BETWEEN 	? AND ?
			AND 		activo=?
			GROUP BY 	can_municipio	
			ORDER BY	can_municipio	
			";
$stmtMun = $conexion->dbh->prepare($queryMun);
$stmtMun->execute(array($desde,$hasta,1));

$queryTotal = 	"SELECT 	sum(Case When can_municipio then 1 ELSE 0 END) AS Total 
				FROM 		(tbl_can_expediente 
				LEFT JOIN 	cat_municipios 
				ON 			tbl_can_expediente.can_municipio=cat_municipios.id_municipio) 
				WHERE 		can_fecha 
				BETWEEN 	? 
				AND 		?
				AND 		activo = ? 
				";
$stmtTotal = $conexion->dbh->prepare($queryTotal);
$stmtTotal->execute(array($desde,$hasta,1));
$total = $stmtTotal->fetch(PDO::FETCH_ASSOC);

if ($stmtMun->rowCount() > 0) {
	while ($municipio = $stmtMun->fetch(PDO::FETCH_ASSOC)) {
		if($municipio["can_municipio"] == '0')
		{

		}
		else{
			$pdf->Row(array(utf8_decode($municipio["municipio"]), utf8_decode($municipio["Numero"])));

		}
	}
	
	$pdf->Cell(102, 5,  'Total: ', 1, 0, 'C', true);
	$pdf->Cell(102, 5,  $total['Total'], 1, 0, 'C', true);
	$pdf->Ln();
} else {
	if($municipio["can_municipio"] == '0')
		{

		}
		else{
			$pdf->Cell(204, 5,  'No tiene datos', 1, 0, 'C', true);

		}
	$pdf->Ln();
}

// Datos por Estado
$pdf->Ln();
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(204, 5,  'Tabla de casos por Estado diferente de veracruz', 1, 0, 'C', true);
$pdf->Ln();//Salto de Linea
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(98, 98, 98);//Relleno de los encabezados
$pdf->SetTextColor(255);//Color del texto
$pdf->Cell(102, 5, utf8_decode('Estado'), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Número de Casos'), 1, 0, 'C', true);
$pdf->SetWidths(array(102,102)); //Especifica el tamaño que tendran las columnas de la tabla a mostrar
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetAligns(array('C','C'));
$pdf->Ln();

$queryEdo = "	SELECT 		can_pais,can_estado,estado,can_mun_edo,COUNT(*) AS Numero			
				FROM 		(tbl_can_expediente
				LEFT JOIN 	cat_estados
				ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
				WHERE 		can_fecha 
				BETWEEN 	? AND ?
				AND			activo =?
				GROUP BY 	can_estado
ORDER BY	can_estado
			";
$stmtEdo = $conexion->dbh->prepare($queryEdo);
$stmtEdo->execute(array($desde,$hasta,1));
$queryTotalEdo = "SELECT 		SUM(can_mun_edo !='') AS Total ,can_mun_edo
				FROM 		tbl_can_expediente 
				WHERE 		can_fecha 
				BETWEEN 	? 
				AND 		? 
				AND 		activo=?
				";
$stmtTotalEdo = $conexion->dbh->prepare($queryTotalEdo);
$stmtTotalEdo->execute(array($desde,$hasta,1));
$total = $stmtTotalEdo->fetch(PDO::FETCH_ASSOC);


if ($stmtEdo->rowCount() > 0) {
	while ($estado_dif = $stmtEdo->fetch(PDO::FETCH_ASSOC)) {
		if($estado_dif["can_estado"] != '30' & $estado_dif["can_estado"] != '0'){
			$pdf->Row(array(utf8_decode($estado_dif["estado"]), utf8_decode($estado_dif["Numero"])));
		}
		else{
			
		}
	}
	
	$pdf->Cell(102, 5,  'Total: ', 1, 0, 'C', true);
	$pdf->Cell(102, 5,  $total['Total'], 1, 0, 'C', true);
	$pdf->Ln();
	$pdf->Ln();
} else {
	$pdf->Cell(204, 5,  'No tiene datos', 1, 0, 'C', true);
	$pdf->Ln();
}

// Datos por Pais
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(204, 5,  'Tabla de casos por Pais diferente de México', 1, 0, 'C', true);
$pdf->Ln();//Salto de Linea
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(98, 98, 98);//Relleno de los encabezados
$pdf->SetTextColor(255);//Color del texto
$pdf->Cell(102, 5, utf8_decode('Pais'), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Número de Casos'), 1, 0, 'C', true);
$pdf->SetWidths(array(102,102)); //Especifica el tamaño que tendran las columnas de la tabla a mostrar
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetAligns(array('C','C'));
$pdf->Ln();

$queryPais = "	SELECT 		can_pais,can_estado,can_otros_estados,estado,can_mun_edo,can_municipio,municipio,COUNT(*) AS Numero
				FROM 		((tbl_can_expediente
				LEFT JOIN 	cat_municipios
				on			tbl_can_expediente.can_municipio=cat_municipios.id_municipio)
				LEFT JOIN 	cat_estados
				ON 			tbl_can_expediente.can_estado=cat_estados.id_estado)
				WHERE 		can_fecha 
				BETWEEN 	? AND ?
				AND 		activo= ?
				GROUP BY 	can_pais	
				ORDER BY	can_pais
			";
$stmtPais = $conexion->dbh->prepare($queryPais);
$stmtPais->execute(array($desde,$hasta,1));
$queryTotalPais = "	SELECT 		can_pais as pais, SUM(can_pais != 'Mexico') AS Total 
					FROM 		(tbl_can_expediente 
					LEFT JOIN 	cat_municipios 
					ON 			tbl_can_expediente.can_municipio=cat_municipios.id_municipio) 
					WHERE 		can_fecha 
					BETWEEN 	? 
					AND 		? 
					AND 		activo =?
				";
$stmtTotalPais = $conexion->dbh->prepare($queryTotalPais);
$stmtTotalPais->execute(array($desde,$hasta,1));
$total = $stmtTotalPais->fetch(PDO::FETCH_ASSOC);


if ($stmtPais->rowCount() > 0) {
	while ($estado_dif = $stmtPais->fetch(PDO::FETCH_ASSOC)) {
		if($estado_dif['can_pais'] != 'México'){
			$pdf->Row(array(utf8_decode($estado_dif["can_pais"]), utf8_decode($estado_dif["Numero"])));
		}
		else{
			
		}
	}
	
	$pdf->Cell(102, 5,  'Total: ', 1, 0, 'C', true);
	$pdf->Cell(102, 5,  $total['Total'], 1, 0, 'C', true);
	$pdf->Ln();
	$pdf->Ln();
} else {
	$pdf->Cell(204, 5,  'No tiene datos', 1, 0, 'C', true);
	$pdf->Ln();
}


/// con true se indica que el archivo esta codificado en UTF-8
$pdf->Output('Informe Sipina ' . date('d/m/Y').'.pdf', 'I', true); 

