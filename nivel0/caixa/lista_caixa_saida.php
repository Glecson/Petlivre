<?
// limpa vari�veis
$cod_material="";
$txt_material ="";

$data_atual = Convert_Data_Port_Ingl($entrada);

//pagina��o
$total_reg = "10"; 

$pagina = $_GET["pagina"];

if(!$pagina) {
$pc = "1";
} else {
$pc = $pagina;
}

$numero_links = "8";
// intevalo revebe o valor da variavel numero_links
$intervalo = $numero_links;
// inicio recebe pc - 1 para montamos o sql
$inicio = $pc-1;
$inicio = $inicio*$total_reg;
// fazemos a conex�o


echo '<script type="text/javascript" src="'.$pontos.'js/outros.js"></script>';


$dia_mes = date("d");// Coleta o dia do m�s
$mes_num = date("m"); // Nome do m&ecirc;s em n&uacute;mero. Ex.: 01 => January, 02 => February
$ano = date("Y");// Coleta o ano corrente

$mes_port = $mes_num; // Atribui&ccedil;&atilde;o de vari&aacute;veis

switch($mes_port){
case $mes_port == 01 or $mes_port == 1: $mes_conv="janeiro";
case $mes_port == 02 or $mes_port == 2: $mes_conv="fevereiro";
case $mes_port == 03 or $mes_port == 3: $mes_conv="mar�o";
case $mes_port == 04 or $mes_port == 4: $mes_conv="abril";
case $mes_port == 05 or $mes_port == 5: $mes_conv="maio";
case $mes_port == 06 or $mes_port == 6: $mes_conv="junho";
case $mes_port == 07 or $mes_port == 7: $mes_conv="julho";
case $mes_port == 08 or $mes_port == 8: $mes_conv="agosto";
case $mes_port == 09 or $mes_port == 9: $mes_conv="setembro";
case $mes_port == 10: $mes_conv="outubro";
case $mes_port == 11: $mes_conv="novembro";
case $mes_port == 12: $mes_conv="dezembro";
}
?>
<script type="text/javascript" src="../../js/func_caixa.js"></script>
<form method="POST" enctype="multipart/form-data" name="form">
  <table width="585" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="5" colspan="5"><table width="560" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr bgcolor="#66CC66">
            <td height="22" colspan="5" align="center" bordercolor="#CC0000" bgcolor="#CC0000"><div align="center" class="style3">
              <p><strong>                <u>SA&Iacute;DAS</u><br>
              </strong><strong>CAIXA                   - <?php echo $dia_mes;?> de <?php echo $mes_conv;?> de <?php echo $ano;?></strong></p>
              </div></td>
          </tr>
          <tr bordercolor="#CC0000" bgcolor="#E6643E" class="cabec_style11">
            <td width="29" height="20"><div align="center" ><font size="2">N&ordm;</font></div></td>
            <td width="281" height="20"><div align="center" ><font size="2">Material</font></div></td>
            <td width="80"><div align="center"><font size="2">Qtde</font></div></td>
            <td width="77"><div align="center"><font size="2">Medida</font></div></td>
            <td width="81" height="20"><div align="center" ><font size="2">Valor</font></div></td>
          </tr>
          <?		  
    
 // Faz o Select pegando o registro inicial at&eacute; a quantidade de registros para p&aacute;gina
    $sql_registros = mysqli_query($connection, "SELECT * FROM tab_caixa WHERE status=0 and data='$data_atual' and material <>'' ORDER BY codigo ASC LIMIT $inicio, $total_reg");

// Serve para contar quantos registros voc&ecirc; tem na seua tabela para fazer a pagina&ccedil;&atilde;o
    $sql_conta = mysqli_query($connection, "SELECT * FROM tab_caixa WHERE status=0 and data='$data_atual' and material <>''");
    
    $quantreg = mysqli_num_rows($sql_conta); // Quantidade de registros pra pagina&ccedil;&atilde;o
    
 $tp = ceil($quantreg/$total_reg);    
   
$cor="#FFFFFF";
$nro =0;
while($linha_ref = mysqli_fetch_array($sql_registros)) {

$cod = $linha_ref['codigo'];
$txt_cod_material = $linha_ref['cod_material'];
$txt_material = $linha_ref['material'];
//$txt_pet = $linha_ref['pet'];
$txt_qtde = $linha_ref['qtde'];
$txt_medida = $linha_ref['medida'];
$txt_valor = $linha_ref['valor'];
//number_format($campo['table_valor'], 2, ',','.')
//aqui a fun��o "str_replace" troca a ","(v�rgula) por "."(ponto)
$string = str_replace(",", ".",$txt_valor);
$total = $total + $string;
$cor=($cor=="#E6E6E6") ? "#FFFFFF": "#E6E6E6"; 
$nro++;
  ?>
          <tr bgcolor="<?=($cor=="#E6E6E6") ? "#FFFFFF": "#E6E6E6"; 
?>" class="info" onmouseover="this.style.backgroundColor='#66FF66'" onmouseout="this.style.backgroundColor='<?=($cor=="#FFFFFF") ? "#E6E6E6": "#FFFFFF"; 
?>'">
            <td width="29" height="5" class="info"><div align="center">&nbsp;<?php echo $nro; ?></div></td>
            <td width="281" height="5" class="info"><div align="center">&nbsp;
<?php echo $txt_material;?></div></td>
            <td width="80" class="info"><div align="center"><?php echo $txt_qtde; ?></div></td>
            <td width="77" class="info"><div align="center">&nbsp;<?php echo $txt_medida; ?></div></td>
            <td width="81" height="5" class="info"><div align="center">&nbsp;<?php echo number_format($txt_valor, 2, ',','.'); ?></div></td>
<?php }
if ($quantreg==""){

echo '<tr><td height="45" colspan="6"><font color="#5F8FBF"><div align="center"><b>&nbsp;N&atilde;o h&aacute; registros</b></font></div></td>';}

@mysql_close();
			
?>
          </tr>
        </table>
          <table width="560" border="0" cellpadding="1" cellspacing="1">
        </table></td>
      <td height="5" colspan="5" class="info"><br /></td>
    </tr>
    <tr>
      <td height="10" colspan="10"></td>
    </tr>
    <tr>
      <td height="20" colspan="5"><table width="560" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="175" class="info"><div align="center">
            <font size="2"><a href="javascript:cad_saida_caixa()">Inserir</a></font></div></td>
            <td width="218" class="info"><div align="center">                <br />
            </div></td>
            <td width="135" colspan="3" class="info"><div align="center"><font color="#FFFFFF">
			<?php echo number_format($total, 2, ',','.');?></font></div></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="20" colspan="5"><div align="center">
          <a href="saidas.php">          </a>
          <?php // Chama o arquivo que monta a pagina&ccedil;&atilde;o
if ($quantreg >=10){include("paginacao.php");}
?>
          <?
if ($quantreg >=10){
echo "<font size='1' color='#cccccc' face='Verdana'>";
echo "P&aacute;gina: $pc de $tp &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; registros: $quantreg";
echo "</font>";
}
?>
      </div></td>
    </tr>
  </table>
</form>