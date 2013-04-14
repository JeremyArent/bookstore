<?php
include('connexion/connexDB.php');

include_once('_header.php');

ob_start();
?>

<?php $req = "SELECT client.*, commande.* FROM commande,client WHERE client.id = commande.id_client AND client.pseudo ='".$_SESSION['Auth']['pseudo']."' GROUP BY pseudo";
                $sql = mysql_query($req);
                while ($row = mysql_fetch_array($sql)) {
?>
<page backtop="20mm" backleft="10mm" backright="10mm" backbottom="30mm">
<table>
        <tr>
            <td style="width:500px;">
                <strong>Maison Biblio</strong><br/>
                102, rue de Paris<br/>
                75020 PARIS<br/>
            </td>
            <td style="width:25%"><?php echo $row['nom']." ".$row['prenom'];?><br/>
                <?php echo $row['adresse'];?><br/>
                <?php echo $row['code_postal']." ".$row['ville'];?></td>
        </tr>
</table>   
    <br/><br/><br/>
    
    <table>
        <tr>
            <td>
                Facture N° <strong><?php echo $row['num_com'];?></strong><br/>
                émise le <?php echo date('d/m/Y');?><br/><br/>
            </td>
        </tr>
    </table>    
    
<table width="500px">
    <tr>
        <th style="background-color: #C3C3C3;width:40px; font-size: 15px;">Art.</th>
        <th style="background-color: #C3C3C3;width:350px; font-size: 15px;">Titre Livre</th>
        <th style="background-color: #C3C3C3;width:75px; font-size: 15px;">Prix U.</th>
        <th style="background-color: #C3C3C3;width:75px; font-size: 15px;">Remise</th>
        <th style="background-color: #C3C3C3;width:50px; font-size: 15px;">Qté</th>
        <th style="background-color: #C3C3C3;width:75px; font-size: 15px;">Total</th>
    </tr>
    <?php
    $ids = array_keys($_SESSION['panier']);
    if (empty($ids)) {
        $product = array();
    } else {
        $product = $DB->query('SELECT * FROM livre WHERE id IN (' . implode(',', $ids) . ')');
    }
    foreach ($product as $product):
        ?>
        <tr>
            <td><?php echo $product->id; ?></td>
            <td><?php echo $product->titre; ?></td>
            <td><?php echo number_format($product->prix, 2, ',', ' '); ?>€</td>
            <td><?php if($product->reduction == '1'){
                        echo "-10%";
                    }else{
                        echo "";
                    }
                    ?></td>
            <td><?php echo $_SESSION['panier'][$product->id]; ?></td>
            <?php
            $reduc = 0.9;
            if ($product->reduction == '1') {
                $cal = $product->prix * $_SESSION['panier'][$product->id] * $reduc;
            } else {
                $cal = $product->prix * $_SESSION['panier'][$product->id];
            }
            ?>
            <td><?php echo number_format($cal, 2, ',', ' '); ?>€</td> 
        </tr>          
    <?php endforeach; ?>
    <tr>
        <td colspan="4" style="text-align: right;"><span><br/><br/>Frais de port:</span></td>
        <td><br/><br/><?php
    $port = 0;
    if ($panier->total() > 20) {
        $port = 3.50;
        echo number_format($port, 2, ',', ' ') . "€";
    } else {
        echo "offert";
    }
    ?>
        </td>                
    </tr>  
    <tr>
        <td colspan="4" style="text-align: right;"><span>TVA inclus</span></td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: right;"><span>TOTAL:</span></td>
        <td><?php echo number_format($port + ($panier->total()), 2, ',', ' '); ?>€</td>                
    </tr>                  

</table>
</page>

<?php
                }
                
    $content = ob_get_clean();
    require('html2pdf/html2pdf.class.php');
    try{
        $pdf = new HTML2PDF('P','A4','fr');
        $pdf->pdf->SetDisplayMode('fullpage');
        $pdf->writeHTML($content);
        ob_clean();
        $pdf->Output('facture.pdf');
    }catch(HTML2PDF_exception $e){
        die($e);
    }   
?>
