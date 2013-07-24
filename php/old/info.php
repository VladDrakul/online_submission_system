<?php

function pop3authCheck($username, $password, $address, $ssl)
{
    if ($ssl)
        $uri="ssl://$address:995";
    else
        $uri="tcp://$address:110";

    $fp=fsockopen($uri);

    if (!$fp)
        return(NULL);

    $st=fgets($fp, 512);
    if (substr($st, 0, 3)!="+OK")
    {
        fclose($fp);
        return(NULL);
    }

    $st="USER $username\n";
    if (fwrite($fp, $st)!=strlen($st))
    {
        fclose($fp);
        return(NULL);
    }

    $st=fgets($fp, 512);
    if (substr($st, 0, 3)!="+OK")
    {
        fclose($fp);
        return(NULL);
    }

    $st="PASS $password\n";
    if (fwrite($fp, $st)!=strlen($st))
    {
        fclose($fp);
        return(NULL);
    }

    $st=fgets($fp, 512);
    fclose($fp);
    if (substr($st, 0, 3)=="+OK")
        return(true);
    else if (substr($st, 0, 4)=="+ERR")
        return(false);
    else
        return(NULL);
}

	$address = http://students.engr.scu.edu/~ndario/SE/SubSys/php/home.php;

        $ssl = true;

        $authentication = function pop3authCheck(username, password, address, ssl);

        if(authentication = true)
        {
                echo "true";
        }
        else
        {
                echo "false";
        }




?>
