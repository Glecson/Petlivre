<?php
session_start();

include("../../../../include/arruma_link.php");
require_once($pontos."conexao.php");
include("func_data.php");

$usuario = $_SESSION["sessao_login"];

// VARI�VEIS POSTADAS 
$txt_razao_social = $_POST["txt_razao_social"];
$txt_contato = $_POST["txt_contato"];
$txt_cnpj = $_POST["txt_cnpj"];
$txt_endereco = $_POST["txt_endereco"];
$txt_bairro = $_POST["txt_bairro"];
$txt_cidade = $_POST["txt_cidade"];
$txt_cep = $_POST["txt_cep"];
$txt_uf = $_POST["txt_uf"];
$txt_ddd_tel = $_POST["txt_ddd_tel"];
$txt_tel_com = $_POST["txt_tel_com"];
$txt_email = $_POST["txt_email"];
$txt_ddd_cel = $_POST["txt_ddd_cel"];
$txt_cel = $_POST["txt_cel"];
$txt_obs_forne = $_POST["txt_obs_forne"];


$data_atual = Convert_Data_Port_Ingl($data_atual2);


$sql = mysqli_query($connection, "SELECT * FROM `tab_temp_fornecedor` WHERE user_cadastro='$usuario'") or die("Erro ao selecionar   -   Selecionar User_cadastro inicial  SQL");

if ($linha = mysqli_fetch_array($sql)){

//  *******************  ATUALIZA AS VARI�VEIS NO BD TEMP *****************************************

$sql1 = mysqli_query($connection, "UPDATE `tab_temp_fornecedor` SET razao_social='$txt_razao_social', contato='$txt_contato', cnpj='$txt_cnpj', endereco='$txt_endereco', bairro='$txt_bairro', cidade ='$txt_cidade', cep='$txt_cep', uf ='$txt_uf', ddd_tel ='$txt_ddd_tel',
tel_com = '$txt_tel_com', email='$txt_email', ddd_cel='$txt_ddd_cel', cel= '$txt_cel', obs_forne  ='$txt_obs_forne', data_cadastro  ='$data_atual' WHERE user_cadastro='$usuario'") or die (mysqli_error($connection));

//  -------------------------------------------------------------------------------------------

}else{
//  *******************  INSERE AS VARI�VEIS NO BD TEMP *****************************************

$sql2 = mysqli_query($connection, "INSERT INTO `tab_temp_fornecedor` (`codigo`, `razao_social`, `contato`,`cnpj`, `endereco`, `bairro`, `cidade`, `cep`, `uf`, `ddd_tel`, `tel_com`, `email`, `ddd_cel`, `cel`, `obs_forne`, `user_cadastro`, `data_cadastro`) VALUES (NULL, '$txt_razao_social', '$txt_contato', '$txt_cnpj', '$txt_endereco', '$txt_bairro', '$txt_cidade', '$txt_cep', '$txt_uf', '$txt_ddd_tel', '$txt_tel_com', '$txt_email', '$txt_ddd_cel', '$txt_cel', '$txt_obs_forne', '$usuario', '$data_atual')") or die (mysqli_error($connection));

//  -------------------------------------------------------------------------------------------
}



if (empty($txt_razao_social)){echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher o campo (RAZ�O SOCIAL).\n\n");</script>';
echo '<script>window.location = "../cad_forne.php";</script>';}

if ($txt_tel_com <>""){
if ($txt_ddd_tel =="" or $txt_tel_com ==" "){
echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher o campo (DDD-TELEFONE).\n\n");</script>';
echo '<script>window.location = "../cad_forne.php";</script>';}

if (strlen($txt_tel_com) < 9){
echo '<script>alert("                   Aten��o!\n\nO Telefone inserido � invalido ou tem poucos caracteres.\n\n");</script>';
echo '<script>window.location = "../cad_forne.php";</script>';}
}




header ("location: cadastro_forne_sucesso.php");

?>