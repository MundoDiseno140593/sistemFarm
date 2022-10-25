<?php 
include '../Model/producto.php';
// require_once('../vendor/autoload.php');
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use phpOffice\PhpSpreadsheet\Writer\Xls;
// use PhpOffice\PhpSpreadsheet\IOFactory;
// use PhpOffice\PhpSpreadsheet\style\fill;
// use phpOffice\PhpSpreadsheet\style\Border;
 
$producto = new Producto();
session_start();
$id_usuario = $_SESSION['usuario'];

if ($_POST['funcion']=='buscar'){
    $producto->buscar();
    // var_dump($producto);
 
    $json=array();
 
    foreach ($producto->objetos as $objeto ) {
        $producto->obtener_stock($objeto->id_producto);
        foreach ($producto -> objetos as $obj) {
            $total=$obj->total;

        }

        $producto->obtener_stock1($objeto->id_producto);
        foreach ($producto -> objetos as $obj){
            $precio=$obj->prec;
        }
        $json[]=array(
            'id'=>$objeto->id_producto,
            'nombre'=>$objeto->nombre,
            'proveedor'=>$objeto->marca,
            'precio'=>$objeto->precio,
            'existencia'=>$total,
            'avatar'=>'../img/producto/'.$objeto->avatar
        );
    
    }

    $jsonstring=json_encode($json);
    echo $jsonstring;
}
 
if ($_POST['funcion']=='crear') {
    $proveedor = $_POST['proveedor'];
    $producto_nombre = $_POST['producto_nombre'];
    $precio = $_POST['precio'];
    $avatar = 'img_producto.png';

    $producto->crear($proveedor,$producto_nombre,$precio,$avatar);
}


if ($_POST['funcion']=='editar') {
    $id = $_POST['id'];
    $producto_nombre = $_POST['producto_nombre'];
    $precio = $_POST['precio'];
    $id_proveedor = $_POST['proveedor'];
    $avatar = 'img_producto.png';
    $producto->editar($id,$producto_nombre,$precio,$id_proveedor,$avatar);
   
}


if ($_POST['funcion']=='borrar'){
$id=$_POST['id'];
$producto->borrar($id);
}

if ($_POST['funcion']=='cambiar_avatar'){
    $id=$_POST['id-logo-prod'];
 
    if (($_FILES['photo']['type']=='image/jpeg') ||
    ($_FILES['photo']['type']=='image/png') || 
    ($_FILES['photo']['type']=='image/git')) { 
 
   $nombre=uniqid().'-'.$_FILES['photo']['name']; //guardar cualquier imagen varias veces 
   $ruta='../img/producto/'.$nombre;
   move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
   $producto->cambiar_logo($id,$nombre);

   foreach ($producto ->objetos as $objeto) {
 
       if ($objeto->avatar !='img_producto.png') {
         unlink('../img/producto/'.$objeto->avatar); //para que no elimine la foto por defecto de los productos
       } 
   }
   $json=array();
   $json[]=array(
       'ruta'=>$ruta,
       'alert'=>'edit'
   );
 
   $jsonstring=json_encode($json[0]);
   echo $jsonstring;
  }else {
   $json=array();
   $json[]=array(
       'alert'=>'noedit'
   );
 
   $jsonstring=json_encode($json[0]);
   echo $jsonstring;
     
  }
}










// if ($_POST['funcion']=='buscar_id'){
//     $id=$_POST['id_producto'];
//     $producto->buscar_id($id);

    // $json=array();

    // foreach ($producto->objetos as $objeto ) {
    //     $producto->obtener_stock($objeto->id_productos);
    //     foreach ($producto -> objetos as $obj) {
    //         $total=$obj->total;
    //     }
    //     $json[]=array(
    //         'id'=>$objeto->id_productos,
    //         'nombre'=>$objeto->nombre,
    //         'concentracion'=>$objeto->concentracion,
    //         'adicional'=>$objeto->adicional,
    //         'precio'=>$objeto->precio,
    //         'stock'=>$total,
    //         'laboratorio'=>$objeto->laboratorio,
    //         'tipo'=>$objeto->tipo,
    //         'presentacion'=>$objeto->presentacion,
    //         'laboratorio_id'=>$objeto->prod_lab,
    //         'tipo_id'=>$objeto->prod_tip,
    //         'presentacion_id'=>$objeto->prod_pre,
    //         'avatar'=>'../img/producto/'.$objeto->avatar,
    //     );
    
    // }

    // $jsonstring=json_encode($json[0]);
    // echo $jsonstring;
// }










// if ($_POST['funcion']=='editar') {
//     $id = $_POST['id'];
//     $nombre = $_POST['nombre'];
//     $concentracion = $_POST['concentracion'];
//     $adicional = $_POST['adicional'];
//     $precio = $_POST['precio'];
//     $laboratorio = $_POST['laboratorio'];
//     $tipo = $_POST['tipo'];
//     $presentacion = $_POST['presentacion'];

//     $producto->editar($id,$nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion);
// }




 




//  if ($_POST['funcion']=='buscar'){
//     $producto->buscar();

//     $json=array();

//     foreach ($producto->objetos as $objeto ) {
//         $producto->obtener_stock($objeto->id_productos);
//         foreach ($producto -> objetos as $obj) {
//             $total=$obj->total;
//         }
//         $json[]=array(
//             'id'=>$objeto->id_productos,
//             'nombre'=>$objeto->nombre,
//             'concentracion'=>$objeto->concentracion,
//             'adicional'=>$objeto->adicional,
//             'precio'=>$objeto->precio,
//             'stock'=>$total,
//             'laboratorio'=>$objeto->laboratorio,
//             'tipo'=>$objeto->tipo,
//             'presentacion'=>$objeto->presentacion,
//             'laboratorio_id'=>$objeto->prod_lab,
//             'tipo_id'=>$objeto->prod_tip,
//             'presentacion_id'=>$objeto->prod_pre,
//             'avatar'=>'../img/producto/'.$objeto->avatar,
//         );
    
//     }

//     $jsonstring=json_encode($json);
//     echo $jsonstring;
// }
 
// if ($_POST['funcion']=='borrar'){
// $id=$_POST['id'];
// $producto->borrar($id);
// }


// if ($_POST['funcion']=='verificar_stock'){
//     $error=0;
//     $productos=json_decode($_POST['productos']);

//     foreach ($productos as $objeto) {
//         $producto->obtener_stock($objeto->id);

//         foreach ($producto->objetos as $obj){

//             $total=$obj->total;
//         }

//         if ($total>=$objeto->cantidad && $objeto->cantidad>0) {
//             $error=$error+0;
//         }else{
//             $error=$error+1;
//         }
       
//     }
//     echo $error;
// }


// if ($_POST['funcion']=='traer_producto'){
//     $html="";
//     $productos=json_decode($_POST['productos']);

//     foreach ($productos as $resultado) {
//         $producto->buscar_id($resultado->id);
//         foreach ($producto->objetos as $objeto) {
//             if ($resultado->cantidad=='') {
//                 $resultadoCantidad=0;
//             }else{
//                 $resultadoCantidad=$resultado->cantidad;
//             }
//             $subtotal=$objeto->precio*$resultadoCantidad;
//             $producto->obtener_stock($objeto->id_productos);
//             foreach ($producto->objetos as $obj){
//             $stock=$obj->total;
//             }
//             $html.="
//             <tr prodId='$objeto->id_productos' prodPrecio='$objeto->precio'>
//                 <td>$objeto->nombre</td>
//                 <td>$stock</td>
//                 <td class='precio'>$objeto->precio</td>
//                 <td>$objeto->concentracion</td>
//                 <td>$objeto->adicional</td>
//                 <td>$objeto->laboratorio</td>
//                 <td>$objeto->presentacion</td>
//                 <td>
//                 <input type='number' min='1' class='form-control cantidad_producto' value='$resultado->cantidad'>
//                 </td>
//                 <td class='subtotales'>
//                 <h5>$subtotal</h5>
//                 </td>
//                 <td><button class='borrar-producto btn btn-danger'><i class='fas fa-times-circle'></i></button></td>
//            </tr> ";
//         }
//     }
//     echo $html;
// }

// funcion para traer todo los productos para imprimirlo por PDF
// if ($_POST['funcion']=='reporte_productos'){
//     date_default_timezone_set('America/Managua');
//     $fecha = date('Y-m-d H:i:s');
//     $html='
//     <header>
//         <div id="logo">
//          <img src="../img/logo.png" width="60" height="60">
//         </div>
//         <h1>REPORTE DE PRODUCTOS</h1>
//         <div id="project">
//           <span>Fecha y Hora: </span>'.$fecha.';
//         </div>
//     </header>
     
//     <table>
//        <thead>
//          <tr>
//            <th>N*</th>
//            <th>Producto</th>
//            <th>Concentracion</th>
//            <th>Adicional</th>
//            <th>Laboratorio</th>
//            <th>Presentacion</th>
//            <th>Tipo</th>
//            <th>Stock</th>
//            <th>Precio</th>
//        </tr>
//        </thead>
//        <tbody>
//     ';
//     $producto->reporte_producto();
//     $contador=0;
//     foreach ($producto->objetos as $objeto){
//         $contador++;
//         $producto->obtener_stock($objeto->id_productos);
//         foreach ($producto->objetos as $obj) {
//             $stock=$obj->total;
//         }
//         $html.='
//         <tr>
//           <td class="servic">'.$contador.'</td>
//           <td class="servic">'.$objeto->nombre.'</td>
//           <td class="servic">'.$objeto->concentracion.'</td>
//           <td class="servic">'.$objeto->adicional.'</td>
//           <td class="servic">'.$objeto->laboratorio.'</td>
//           <td class="servic">'.$objeto->presentacion.'</td>
//           <td class="servic">'.$objeto->tipo.'</td>
//           <td class="servic">'.$stock.'</td>
//           <td class="servic">'.$objeto->precio.'</td>
        
//         </tr>
        
//         ';
//     }
//     $html.='
//     </tbody>
//     </table>
//     ';
//     $css=file_get_contents("../css/pdf.css");
//     $mpdf = new \Mpdf\Mpdf();
//     $mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
//     $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
//     $mpdf->Output("../pdf/pdf-".$_POST['funcion'].".pdf","F");
// }


// if($_POST['funcion'] =='reporte_productosExcel'){
//     $nombre_archivo='Reporte_productos.xlsx';
//     $producto->reporte_producto();
//     $contador=0;
//     foreach ($producto->objetos as $objeto){
//         $contador++;
//         $producto->obtener_stock($objeto->id_productos);
//         foreach ($producto->objetos as $obj) {
//             $stock=$obj->total;
//         }
//        $json[]=array(
//         'N'=>$contador,
//         'nombre'=>$objeto->nombre,
//         'concentracion'=>$objeto->concentracion,
//         'adicional'=>$objeto->adicional,
//         'laboratorio'=>$objeto->laboratorio,
//         'presentacion'=>$objeto->presentacion,
//         'tipo'=>$objeto->tipo,
//         'stock'=>$stock,
//         'precio'=>$objeto->precio
//        );
//     }
//    $spreadsheet= new Spreadsheet();
//    $Sheet= $spreadsheet->getActiveSheet();
//    $Sheet->setTitle('Reporte De Productos');
//    $Sheet->setCellValue('A1','Reporte De Productos En Excel');
//    $Sheet->getStyle('A1')->getFont()->setSize(17);
//    $Sheet->fromArray(array_keys($json[0]),NULL,'A2');
//    $Sheet->getStyle('A2:I2')
//    ->getFill()
//    ->setFillType(\PhpOffice\PhpSpreadsheet\style\Fill::FILL_SOLID)
//    ->getStartColor()
//    ->setARGB('2D9F39');
//    $Sheet->getStyle('A4:I4')
//    ->getFont() 
//    ->getColor()
//    ->setARGB(\PhpOffice\PhpSpreadsheet\style\Color::COLOR_WHITE);
//    foreach ($json as $key => $producto) {
//     $celda=(int)$key+5;
//     if ($producto['stock']=='') {
//         $Sheet->getStyle('A'.$celda.':I'.$celda)
//         ->getFont()
//         ->getColor()
//         ->setARGB(\PhpOffice\PhpSpreadsheet\style\Color::COLOR_RED);
//     }
//     $Sheet->setCellValue('A'.$celda, $producto['N']);
//     $Sheet->setCellValue('B'.$celda, $producto['nombre']);
//     $Sheet->setCellValue('C'.$celda, $producto['concentracion']);
//     $Sheet->setCellValue('D'.$celda, $producto['adicional']);
//     $Sheet->setCellValue('E'.$celda, $producto['laboratorio']);
//     $Sheet->setCellValue('F'.$celda, $producto['presentacion']);
//     $Sheet->setCellValue('G'.$celda, $producto['tipo']);
//     $Sheet->setCellValue('H'.$celda, $producto['stock']);
//     $Sheet->setCellValue('I'.$celda, $producto['precio']);
//    }
//    foreach (range('B','I') as $col) {
//     $Sheet->getColumnDimension($col)->setAutoSize(true);
//    }

//    $Writer=IOFactory::createWriter($spreadsheet,'Xlsx');
//    $Writer->save('../Excel/'.$nombre_archivo);
// }

// if ($_POST['funcion']=='rellenar_productos'){
//     $producto->rellenar_productos();
//     $json =array();
//     foreach ($producto->objetos as $objeto) {
        
//        $json[]=array(
           
//            'nombre'=>$objeto->id_productos.' | '.$objeto->nombre.' | '.$objeto->concentracion.' | '.$objeto->adicional.' | '.$objeto->laboratorio.' | '.$objeto->presentacion
//         );
//     }
//     $jsonstring = json_encode($json);
//     echo $jsonstring;
   
// }

?>