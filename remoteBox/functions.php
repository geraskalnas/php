<?php

function loadContents($pre="t")
{
    $fileList = scandir($pre);
    unset($fileList[0], $fileList[1]);
    
    $li = array();
    foreach($fileList as $file){
        $f = fopen($pre . "/". $file, "r");
        $data = fread($f, 1024);
        $li[] = $data;
        fclose($f);
    }
    
    return $li;
}

function selectID($way, $length, $mode=2)
{
    if($length<1){$length=1;}
    if($mode == 1)
    {
        for($i=0; $i<$length; $i++)
        {
            if(!in_array($i, $way)){return $i;}
        }
    }else if($mode==2)
    {
        $id=-1;
        $li = array();
        while($id==-1 || in_array($i, $way)){$id=rand(0,$length);}
        return $id;
    }
}