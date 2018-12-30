<?php
    if ($handle = opendir("./extensions"))
    {
        //echo "<b>Cleaned:</b><br>";
        while (false !== ($entry = readdir($handle)))
        {
            if ($entry != "." && $entry != "..")
            {
                //echo "$entry<br>";
                unlink(__DIR__ . "/extensions/" . $entry);
            }
        }
        //echo "<br>If you requested this page just to us keep clean, thanks!</br>";

        closedir($handle);
    }

    //unlink(__DIR__ . "/extensions/");
?>