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
		$this->MultiCell(0, 5, (utf8_decode("Secretaría Ejecutiva del SIPINNA Estatal \r\nDenuncias 089 recibidas en el C4 \nSecretaría de Seguridad Pública\nNúm. de denuncias: $mes_desde de $anio_desde a $mes_hasta de $anio_hasta")), 0, 'C');
		//$this->Ln();
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
				AND 			activo = ?	
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

$queryMun = "	SELECT 		municipio,c4_pais,c4_edo,c4_mun,c4_mun_edo,COUNT(*) AS Numero
				FROM 		((tbl_c4_expedientes
				LEFT JOIN 	cat_municipios
				ON 			tbl_c4_expedientes.c4_mun= cat_municipios.id_municipio)
				LEFT JOIN 	cat_estados
				ON 			tbl_c4_expedientes.c4_edo=cat_estados.id_estado)
				WHERE 		c4_fecha_inicio
				BETWEEN 	? AND ?
				AND			activo = ?
				GROUP BY 	municipio
				ORDER BY	municipio


				";
$stmtMun = $conexion->dbh->prepare($queryMun);
$stmtMun->execute(array($desde,$hasta,1));

$queryTotal = "	SELECT 		sum(Case When c4_mun then 1 ELSE 0 END) AS Total 
				FROM 		(tbl_c4_expedientes 
				LEFT JOIN 	cat_municipios 
				ON 			tbl_c4_expedientes.c4_mun=cat_municipios.id_municipio) 
				WHERE 		c4_fecha_inicio 
				BETWEEN 	? 
				AND 		?
				AND			activo = ?
				 ";
$stmtTotal = $conexion->dbh->prepare($queryTotal);
$stmtTotal->execute(array($desde,$hasta,1));
$total = $stmtTotal->fetch(PDO::FETCH_ASSOC);

if ($stmtMun->rowCount() > 0) {
	while ($municipio = $stmtMun->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Row(array(utf8_decode($municipio["municipio"]), utf8_decode($municipio["Numero"])));
	}
	
	$pdf->Cell(102, 5,  'Total: ', 1, 0, 'C', true);
	$pdf->Cell(102, 5,  $total['Total'], 1, 0, 'C', true);
	$pdf->Ln();
} else {
	$pdf->Cell(204, 5,  'No tiene datos', 1, 0, 'C', true);
	$pdf->Ln();
}

$pdf->Output('Informe Sipina ' . date('d/m/Y').'.pdf', 'I', true); 