<?php
session_start();

include("../../../../include/arruma_link.php");
include($pontos."include/mostra_erros.php");
require_once($pontos."conexao.php");
include("func_data.php");

$usuario = $_SESSION["sessao_login"];

// VARIÁVEIS POSTADAS 
$txt_nome_clie = $_POST["txt_nome_clie"];
$sel_sexo = $_POST["sel_sexo"];
$txt_end_clie = $_POST["txt_end_clie"];
$txt_cep_clie = $_POST["txt_cep_clie"];
$txt_bairro_clie = $_POST["txt_bairro_clie"];
$txt_cidade_clie = $_POST["txt_cidade_clie"];
$txt_uf = $_POST["uf"];
$txt_ddd_tel_clie = $_POST["txt_ddd_tel_clie"];
$txt_tel_clie = $_POST["txt_tel_clie"];
$txt_ddd_cel_clie = $_POST["txt_ddd_cel_clie"];
$txt_cel_clie = $_POST["txt_cel_clie"];
$txt_rg_clie = $_POST["txt_rg_clie"];
$txt_cpf = $_POST["txt_cpf"];
$txt_data_nasc_clie = $_POST["txt_data_nasc_clie"];
$txt_obs_clie = $_POST["txt_obs_clie"];

if (!isset($txt_data_nasc_clie) || $txt_data_nasc_clie =="00/00/0000") {$txt_data_nasc_clie = '';}
if (!isset($sel_sexo)) {$sel_sexo = '';}



//$entrada vc mudar por exemplo: Convert_Data_Port_Ingl($_POST[data])
$txt_data_nasc_clie = Convert_Data_Port_Ingl($txt_data_nasc_clie);

$data_atual = Convert_Data_Port_Ingl($data_atual2);



$sql = mysqli_query($connection, "SELECT * FROM `tab_temp_clie` WHERE user_cadastro='$usuario'") or die("Erro ao selecionar   -   Selecionar User_cadastro inicial  SQL");

if ($linha = mysqli_fetch_array($sql)){

//  *******************  ATUALIZA AS VARIÁVEIS NO BD TEMP *****************************************

$sql1 = mysqli_query($connection, "UPDATE `tab_temp_clie` SET nome='$txt_nome_clie', sexo='$sel_sexo', endereco='$txt_end_clie', cep='$txt_cep_clie', bairro='$txt_bairro_clie', cidade ='$txt_cidade_clie', uf='$txt_uf', ddd_tel ='$txt_ddd_tel_clie', tel ='$txt_tel_clie',
ddd_cel = '$txt_ddd_cel_clie', cel= '$txt_cel_clie', rg = '$txt_rg_clie', cpf = '$txt_cpf', data_nasc ='$txt_data_nasc_clie', obs ='$txt_obs_clie', data_cadastro  ='$data_atual' WHERE user_cadastro='$usuario'") or die (mysqli_error($connection));

//  -------------------------------------------------------------------------------------------

}else{
//  *******************  INSERE AS VARIÁVEIS NO BD TEMP *****************************************

$sql2 = mysqli_query($connection, "INSERT INTO `tab_temp_clie` (`codigo`, `nome`, `sexo`,`endereco`, `cep`, `bairro`, `cidade`, `uf`, `ddd_tel`, `tel`, `ddd_cel`, `cel`, `rg`, `cpf`, `data_nasc`,`obs`, `user_cadastro`, `data_cadastro`) VALUES (NULL, '$txt_nome_clie', '$sel_sexo', '$txt_end_clie',
'$txt_cep_clie', '$txt_bairro_clie', '$txt_cidade_clie', '$txt_uf', '$txt_ddd_tel_clie', '$txt_tel_clie', '$txt_ddd_cel_clie', '$txt_cel_clie', '$txt_rg_clie', '$txt_cpf', '$txt_data_nasc_clie', '$txt_obs_clie', '$usuario','$data_atual')") or die (mysqli_error($connection));

//  -------------------------------------------------------------------------------------------
}



if (empty($txt_nome_clie)){
	echo '<script>alert("                   Atenção!\n\nÉ necessário preencher o campo (NOME).\n\n");</script>';
    echo '<script>window.location = "../cad_clie.php";</script>';
}


if (empty($txt_end_clie)){echo '<script>alert("                   Atenção!\n\nÉ necessário preencher o campo (ENDEREÇO).\n\n");</script>';
echo '<script>window.location = "../cad_clie.php";</script>';}

if (empty($txt_bairro_clie)){echo '<script>alert("                   Atenção!\n\nÉ necessário selecionar o campo (BAIRRO).\n\n");</script>';
echo '<script>window.location = "../cad_clie.php";</script>';}

if (empty($txt_cidade_clie)){echo '<script>alert("                   Atenção!\n\nÉ necessário selecionar o campo (CIDADE).\n\n");</script>';
echo '<script>window.location = "../cad_clie.php";</script>';}

if ((empty($txt_tel_clie)) and (empty($txt_cel_clie))){echo '<script>alert("                   Atenção!\n\nÉ necessário preencher pelo menos 01(um) dos Telefones.\n\n");</script>';
echo '<script>window.location = "../cad_clie.php";</script>';}


if (!empty($txt_tel_clie)){
	if (empty($txt_ddd_tel_clie)){
	echo '<script>alert("                   Atenção!\n\nÉ necessário preencher o campo (DDD-TEL).\n\n");</script>';
	echo '<script>window.location = "../cad_clie.php";</script>';}

	if (strlen($txt_tel_clie) < 9){
	echo '<script>alert("                   Atenção!\n\nO Telefone inserido é invalido ou tem poucos caracteres.\n\n");</script>';
	echo '<script>window.location = "../cad_clie.php";</script>';}
}

if (!empty($txt_cel_clie)){
	if (empty($txt_ddd_cel_clie)){
	echo '<script>alert("                   Atenção!\n\nÉ necessário preencher o campo (DDD-TEL).\n\n");</script>';
	echo '<script>window.location = "../cad_clie.php";</script>';}

	if (strlen($txt_cel_clie) < 9){
	echo '<script>alert("                   Atenção!\n\nO Telefone inserido é invalido ou tem poucos caracteres.\n\n");</script>';
	echo '<script>window.location = "../cad_clie.php";</script>';}
}


header ("location: cadastro_clie_sucesso.php");

?>