<?php
    session_start();
    if (!isset($_SESSION['results'])){
        $_SESSION['result'] = [];
    }
    $startTime = microtime();
    $x = $_POST["paramx"];
    $y = $_POST["paramy"];
    $r = $_POST["paramr"];
    $result = "";
    if (checkParameterValue($x, $y, $r)){
        if (isAreaOk($x,$y,$r))
            $result = "yes";
        else $result = "no";
        $calcTime = calcDuration($startTime, microtime());
        
        $_SESSION['results'][] = array(
        'x' => $x,
        'y' => $y,
        'r' => $r,
        'result' => $result,
        'calcTime' => $calcTime
        );
        
    } else echo "Wrong parametres";
    historyPage();

    function isAreaOk($x, $y, $r){
        if (($y <= $r - $x) && $x >=0 && $y >= 0)
            return true;
        if ($y <= $r && $x >= -$r && $y >= 0 && $x <= 0)
            return true;
        if (($x^2 + $y^2 <= ($r^2)/4) && $x <= 0 && $y <= 0)
            return true;
        return false; 
    }

    function checkParameterValue($x, $y, $r){
        $X = array('-3', '-2', '-1', '0', '1', '2', '3', '4', '5');
        if (in_array($x, $X) && $y <= 3 && $y >= -3 && $r <= 4 && $r >= 1)
            return true;
        else return false;
    }

    function calcDuration($start, $finish)
    {
        $startCalcTime = explode(' ', $start);
        $finishCalcTime = explode(' ', $finish);

        $calcTimeSec = $finishCalcTime[1] - $startCalcTime[1];
        $calcTimeMsec = $finishCalcTime[0] - $startCalcTime[0];

        if ($calcTimeSec === 0)
            return round($calcTimeMsec, 10);
        else
            return $calcTimeSec + $calcTimeMsec;
    }

    function historyPage(){
    $history = $_SESSION['results'];
    if (sizeof($history) > 50)
        $history = array_slice($history, -50, 100);
    $history = array_reverse($history);
    $result = '';
    $flagIsFirstElement = true;
    foreach ($history as $point) {
        if ($flagIsFirstElement){
            $result = $result . '<div class="result">|';
            foreach ($point as $key => $value) {
                $result = $result . $key . ' = ' . $value . ' | ';
            }
            $result = $result . '</div>';
            $result = $result . '<br> <div class="history">';
            $result = $result . 'HISTORY<br>';
            $flagIsFirstElement = false;
        } else {
            $result = $result . '<div>|';
            foreach ($point as $key => $value) {
                $result = $result . $key . ' = ' . $value . ' | ';
            }
            $result = $result . '</div>';
        }
    }
    $result = $result . '</div>';
    echo $result;
        

}

?>