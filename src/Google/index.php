<?php
namespace SearchEnginePartner\Google;

$g = new GoogleQuantumJsClient();

$i = 0;

foreach (($g->getModuleQuantum()) as $key => $value) {

    if($value !== "quantum" //&& $i < 50
    ){

        $g2 = new GoogleJsClient($value);

        echo "<p style='color:red;' >{$value}</p>";

        echo "<p>";

        $contents = $g2->send();

        foreach ($contents as $content) {

            file_put_contents(__DIR__."/jss/{$value}.js",$content);

        }

        echo "</p>";

    }

    $i++;

};