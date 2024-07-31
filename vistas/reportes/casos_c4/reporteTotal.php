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
		$this->MultiCell(0, 5, (utf8_decode("Secretaría Ejecutiva del SIPINNA Estatal \r\n*Denuncias 089 recibidas en el C4  \nSecretaría de Seguridad Pública\nNúm. de denuncias: $mes_desde de $anio_desde a $mes_hasta de $anio_hasta")), 0, 'C');
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

$queryMun = "	SELECT 			c4_fecha_inicio,count(*) as Numero
				FROM			tbl_c4_expedientes
				WHERE 			c4_fecha_inicio 
				BETWEEN			?
				AND 			?
				AND 			activo =?		
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

$queryMun = "	SELECT 		municipio,COUNT(*) AS Numero
					FROM 		((tbl_c4_expedientes
					LEFT JOIN 	cat_municipios
					ON 			tbl_c4_expedientes.c4_mun= cat_municipios.id_municipio)
					LEFT JOIN 	cat_estados
					ON 			tbl_c4_expedientes.c4_edo=cat_estados.id_estado)
					WHERE 		c4_fecha_inicio
					BETWEEN 	? AND ?
					AND 		activo = 1
					AND 		c4_edo = 30
					GROUP BY 	municipio
					ORDER BY	Numero desc
			";
$stmtMun = $conexion->dbh->prepare($queryMun);
$stmtMun->execute(array($desde,$hasta));
// Inicializa variables para contar filas y sumar números
$totalFilasMun = 0;
$totalNumeroMun = 0;
while ($rows = $stmtMun->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Row(array(utf8_decode($rows['municipio']), utf8_decode($rows['Numero'])));
    $totalFilasMun++;
    $totalNumeroMun += $rows['Numero'];
}

$pdf->SetFillColor(255); // Color de la celda de la tabla
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(102, 5, 'Total de Municipio: ' . $totalFilasMun, 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Total: ' . $totalNumeroMun), 1, 0, 'C', true);
$pdf->Ln();
$pdf->Ln();

// Datos por Estado
$pdf->Ln();
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(204, 5,  'Tabla de casos por estado diferente de veracruz', 1, 0, 'C', true);
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

$queryEdo = "	SELECT 	estado,COUNT(*) AS Numero
				FROM 		((tbl_c4_expedientes
				LEFT JOIN 	cat_municipios
				ON 			tbl_c4_expedientes.c4_mun= cat_municipios.id_municipio)
				LEFT JOIN 	cat_estados
				ON 			tbl_c4_expedientes.c4_edo=cat_estados.id_estado)
				WHERE 		c4_fecha_inicio
				BETWEEN 	? AND ?
				AND 		activo = ?
				AND 		c4_edo !=30
				AND 		c4_pais ='México'
				GROUP BY 	municipio
				ORDER BY	Numero desc
			";
$stmtEdo = $conexion->dbh->prepare($queryEdo);
$stmtEdo->execute(array($desde,$hasta,1));
// Inicializa variables para contar filas y sumar números
$totalFilasEdo = 0;
$totalNumeroEdo = 0;
while ($rows = $stmtEdo->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Row(array(utf8_decode($rows['estado']), utf8_decode($rows['Numero'])));
    $totalFilasEdo++;
    $totalNumeroEdo += $rows['Numero'];
}

$pdf->SetFillColor(255); // Color de la celda de la tabla
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(102, 5, 'Total de Estado: ' . $totalFilasEdo, 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Total: ' . $totalNumeroEdo), 1, 0, 'C', true);
$pdf->Ln();
$pdf->Ln();

// Datos por Pais
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(204, 5,  utf8_decode('Tabla de casos por país diferente de México'), 1, 0, 'C', true);
$pdf->Ln();//Salto de Linea
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(98, 98, 98);//Relleno de los encabezados
$pdf->SetTextColor(255);//Color del texto
$pdf->Cell(102, 5, utf8_decode('País'), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Número de Casos'), 1, 0, 'C', true);
$pdf->SetWidths(array(102,102)); //Especifica el tamaño que tendran las columnas de la tabla a mostrar
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetAligns(array('C','C'));
$pdf->Ln();

$queryPais = "SELECT 		c4_pais,COUNT(*) AS Numero			
						FROM 		tbl_c4_expedientes
						WHERE 		c4_fecha_inicio 
						BETWEEN 	? AND ?
						AND			activo =?
						AND 		c4_pais !='México'
						GROUP by 	c4_pais
						ORDER BY Numero desc
			";
$stmtPais = $conexion->dbh->prepare($queryPais);
$stmtPais->execute(array($desde,$hasta,1));
// Inicializa variables para contar filas y sumar números
$totalFilasPais = 0;
$totalNumeroPais = 0;
while ($rows = $stmtPais->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Row(array(utf8_decode($rows['c4_pais']), utf8_decode($rows['Numero'])));
    $totalFilasPais++;
    $totalNumeroPais += $rows['Numero'];
}

$pdf->SetFillColor(255); // Color de la celda de la tabla
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(102, 5,  utf8_decode('Total de país: ' . $totalFilasPais), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Total: ' . $totalNumeroPais), 1, 0, 'C', true);
$pdf->Ln();
$pdf->Ln();

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

$queryMes = "	SELECT 
						CASE MONTH(c4_fecha_inicio)
						WHEN 1 THEN 'Enero'
						WHEN 2 THEN 'Febrero'
						WHEN 3 THEN 'Marzo'
						WHEN 4 THEN 'Abril'
						WHEN 5 THEN 'Mayo'
						WHEN 6 THEN 'Junio'
						WHEN 7 THEN 'Julio'
						WHEN 8 THEN 'Agosto'
						WHEN 9 THEN 'Septiembre'
						WHEN 10 THEN 'Octubre'
						WHEN 11 THEN 'Noviembre'
						WHEN 12 THEN 'Diciembre'
						END AS Mes,
						COUNT(*) AS Numero

						FROM 		tbl_c4_expedientes
						WHERE		c4_fecha_inicio BETWEEN ? AND ?
						AND 		activo = ?
						GROUP BY 	Mes
						ORDER BY	Numero DESC;
			";
$stmtMes = $conexion->dbh->prepare($queryMes);
$stmtMes->execute(array($desde,$hasta,1));
// Inicializa variables para contar filas y sumar números
$totalMes = 0;
$totalNumeroMes = 0;
while ($rows = $stmtMes->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Row(array(utf8_decode($rows['Mes']), utf8_decode($rows['Numero'])));
    $totalMes++;
    $totalNumeroMes += $rows['Numero'];
}

$pdf->SetFillColor(255); // Color de la celda de la tabla
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(102, 5,  utf8_decode('Total de Mes: ' . $totalMes), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Total: ' . $totalNumeroMes), 1, 0, 'C', true);
$pdf->Ln();
$pdf->Ln();


//Datos por Genero
$pdf->Ln();
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(204, 5,  utf8_decode('Tabla de género'), 1, 0, 'C', true);
$pdf->Ln();//Salto de Linea
$pdf->SetFillColor(98, 98, 98);
$pdf->SetTextColor(255);//Color del texto
$pdf->Cell(102, 5, utf8_decode('Género'), 1, 0, 'C', true);
$pdf->Cell(102, 5,  'Numero de Casos', 1, 0, 'C', true);
$pdf->SetWidths(array(102,102)); //Especifica el tamaño que tendran las columnas de la tabla a mostrar
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetAligns(array('C','C'));
$pdf->Ln();

$queryGenero = "SELECT 	c4_sexo_victima As Genero,
						COUNT(*) AS Numero
						FROM 	(tbl_c4_victimas
						LEFT JOIN	tbl_c4_expedientes
						ON		tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
						WHERE	c4_fecha_inicio 
						BETWEEN ?
						AND 	?
						AND		activo =?	
						GROUP BY 	c4_sexo_victima	
						ORDER BY Numero desc

			";
//Se prepara la sentecia para hacer la busqueda en el servidor
$stmtGenero = $conexion->dbh->prepare($queryGenero);
$stmtGenero->execute(array($desde,$hasta,1));
// Inicializa variables para contar filas y sumar números
$totalGenero = 0;
$totalNumeroGenero = 0;
while ($rows = $stmtGenero->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Row(array(utf8_decode($rows['Genero']), utf8_decode($rows['Numero'])));
    $totalGenero++;
    $totalNumeroGenero += $rows['Numero'];
}

$pdf->SetFillColor(255); // Color de la celda de la tabla
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(102, 5,  utf8_decode('Total de generos: ' . $totalGenero), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Total: ' . $totalNumeroGenero), 1, 0, 'C', true);
$pdf->Ln();
$pdf->Ln();

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

$queryEdad = "	SELECT 			c4_edad_victima AS Edad ,COUNT(*) AS Numero													
						FROM 			(tbl_c4_victimas
						LEFT JOIN		tbl_c4_expedientes
						ON				tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
						WHERE 			c4_fecha_inicio 
						BETWEEN			?
						AND 			?
						AND 			activo = ?
						AND 			c4_edad_victima<=18
						GROUP BY 		Edad
						ORDER BY 		Edad ASC
				";
$stmtEdad = $conexion->dbh->prepare($queryEdad);
$stmtEdad->execute(array($desde,$hasta,1));
// Inicializa variables para contar filas y sumar números
$totalMenores = 0;
$totalNumeroMenores = 0;
while ($rows = $stmtEdad->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Row(array(utf8_decode($rows['Edad']), utf8_decode($rows['Numero'])));
    $totalMenores++;
    $totalNumeroMenores += $rows['Numero'];
}

$pdf->SetFillColor(255); // Color de la celda de la tabla
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(102, 5,  utf8_decode('Total de menores: ' . $totalMenores), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Total: ' . $totalNumeroMenores), 1, 0, 'C', true);
$pdf->Ln();
$pdf->Ln();

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

$queryEdad = "	SELECT 			c4_edad_victima AS Edad ,COUNT(*) AS Numero													
				FROM 			(tbl_c4_victimas
				LEFT JOIN		tbl_c4_expedientes
				ON				tbl_c4_victimas.c4_exp_folio_victima=tbl_c4_expedientes.c4_exp_folio)
				WHERE 			c4_fecha_inicio 
				BETWEEN			?
				AND 			?
				AND 			activo = ?
				AND 			c4_edad_victima>=18
				GROUP BY 		Edad
				ORDER BY 		Edad ASC
				";
$stmtEdad = $conexion->dbh->prepare($queryEdad);
$stmtEdad->execute(array($desde,$hasta,1));
// Inicializa variables para contar filas y sumar números
$totalMayores = 0;
$totalNumeroMayores = 0;
while ($rows = $stmtEdad->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Row(array(utf8_decode($rows['Edad']), utf8_decode($rows['Numero'])));
    $totalMayores++;
    $totalNumeroMayores += $rows['Numero'];
}

$pdf->SetFillColor(255); // Color de la celda de la tabla
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(102, 5,  utf8_decode('Total de mayores: ' . $totalMayores), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Total: ' . $totalNumeroMayores), 1, 0, 'C', true);
$pdf->Ln();
$pdf->Ln();


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

$queryPerVul = "SELECT 
							'c4_per_tercera_edad' AS column_name,
							SUM(CASE WHEN c4_per_tercera_edad != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_tercera_edad
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery

						UNION ALL

						SELECT 
							'c4_per_violencia' AS column_name,
							SUM(CASE WHEN c4_per_violencia != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_violencia
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery

						UNION ALL

						SELECT 
							'c4_per_discapacidad' AS column_name,
							SUM(CASE WHEN c4_per_discapacidad != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_discapacidad
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery

						UNION ALL

						SELECT 
							'c4_per_indigena' AS column_name,
							SUM(CASE WHEN c4_per_indigena != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_indigena
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery

						UNION ALL

						SELECT 
							'c4_per_transgenero' AS column_name,
							SUM(CASE WHEN c4_per_transgenero != 0 THEN 1 ELSE 0 END) AS count_non_zero
						FROM 
							(
								SELECT c4_per_transgenero
								FROM tbl_c4_victimas
								LEFT JOIN tbl_c4_expedientes
								ON tbl_c4_victimas.c4_exp_folio_victima = tbl_c4_expedientes.c4_exp_folio
								WHERE c4_fecha_inicio BETWEEN ? AND ?
								AND activo = ?
							) AS subquery 

						ORDER BY count_non_zero DESC;
		

";
$stmtPerVul = $conexion->dbh->prepare($queryPerVul);
$stmtPerVul->execute(array($desde,$hasta,1,$desde,$hasta,1,$desde,$hasta,1,$desde,$hasta,1,$desde,$hasta,1));
// Inicializa variables para contar filas y sumar números
$totalAgresion = 0;
$totalNumeroAgresion = 0;
while ($rows = $stmtPerVul->fetch(PDO::FETCH_ASSOC)) {
	if($rows['column_name'] =="c4_per_transgenero"){
		$nombre="Persona transgenero";
	}
	if($rows['column_name'] =="c4_per_violencia"){
		$nombre="Violencia contra la mujer";
	}
	if($rows['column_name'] =="c4_per_discapacidad"){
		$nombre="Persona con alguna discapacidad";
	}
	if($rows['column_name'] =="c4_per_indigena"){
		$nombre="Persona indigena";
	}
	if($rows['column_name'] =="c4_per_tercera_edad"){
		$nombre="(Otros) Persona de tercera edad";
	}
    $pdf->Row(array(utf8_decode($nombre), utf8_decode($rows['count_non_zero'])));
    $totalAgresion++;
    $totalNumeroAgresion += $rows['count_non_zero'];
}

$pdf->SetFillColor(255); // Color de la celda de la tabla
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(102, 5,  utf8_decode('Total de Agresiones: ' . $totalAgresion), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Total: ' . $totalNumeroAgresion), 1, 0, 'C', true);
$pdf->Ln();
$pdf->Ln();


// Datos por tipo de delito
$pdf->Ln();
$pdf->SetFillColor(166, 45, 45);//Color del la Celda de la tabla
$pdf->SetTextColor(255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(204, 5,  'Tabla de tipos de delitos', 1, 0, 'C', true);
$pdf->Ln();//Salto de Linea
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(98, 98, 98);//Relleno de los encabezados
$pdf->SetTextColor(255);//Color del texto
$pdf->Cell(102, 5, utf8_decode('Tipo de delito'), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Número de Casos'), 1, 0, 'C', true);
$pdf->SetWidths(array(102,102)); //Especifica el tamaño que tendran las columnas de la tabla a mostrar
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetAligns(array('C','C'));
$pdf->Ln();

$queryDelito = 	"	SELECT 		delito,
						count(*) as Numero
						FROM 		((tbl_c4_delitos_victimas
						LEFT JOIN	tbl_c4_expedientes
						ON			tbl_c4_delitos_victimas.c4_exp_folio_delito=tbl_c4_expedientes.c4_exp_folio)
						LEFT JOIN  	cat_tipos_delitos
						ON 			tbl_c4_delitos_victimas.c4_delito=cat_tipos_delitos.id_delito)
						WHERE 		c4_fecha_inicio BETWEEN ? AND ?
						AND 		activo = ?
						GROUP BY 	delito
						ORDER BY Numero desc
				";
$stmtDelito = $conexion->dbh->prepare($queryDelito);
$stmtDelito->execute(array($desde,$hasta,1));

// Inicializa variables para contar filas y sumar números
$totalDelitos = 0;
$totalNumeroDelitos = 0;
while ($rows = $stmtDelito->fetch(PDO::FETCH_ASSOC)) {

    $pdf->Row(array(utf8_decode($rows['delito']), utf8_decode($rows['Numero'])));
    $totalDelitos++;
    $totalNumeroDelitos += $rows['Numero'];
}

$pdf->SetFillColor(255); // Color de la celda de la tabla
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(102, 5,  utf8_decode('Total de Delitos: ' . $totalDelitos), 1, 0, 'C', true);
$pdf->Cell(102, 5, utf8_decode('Total: ' . $totalNumeroDelitos), 1, 0, 'C', true);
$pdf->Ln();
$pdf->Ln();



/// con true se indica que el archivo esta codificado en UTF-8
$pdf->Output('Informe Sipina ' . date('d/m/Y').'.pdf', 'I', true); 

