<?php

class dev{
    /**
     * @param $arg
     * @param string $arrSizes
     */
    public static function printTableFromObjectArray($arg, $arrSizes = '') {
        $entrys = [];
        foreach ($arg as $key => $entry) {

                $entrys[] = (array)$entry;
        }
        $thArr = [];
        $trArr = [];
        $counter = 0;

        foreach ($entrys as $entry) {
            $internCounter = 0;
            foreach ($entry as $key => $value) {

                if ($counter == 0) {
                    //private Attribute haben den Klassennamen vorweg, darum wird er weggekürzt
                    $thArr[] = '<th>' .substr($key, 16). '</th>';
                }
                if ($arrSizes != '') {
                    $trArr[$counter][] = '<td width="' . $arrSizes[$internCounter] . '%">' . $value . '</td>';
                }
                else {
                    $trArr[$counter][] = '<td>' . $value . '</td>';
                }
                $internCounter++;
            }
            $counter++;
        }
        echo '<table id="myTable" class="full-width table-bordered"><thead>';

        foreach ($thArr as $entry) {
            echo $entry;
        }
        echo '</head><tbody>';


        foreach ($trArr as $entry) {
            echo '<tr>';
            foreach ($entry as $value) {
                echo $value;
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
    }
}
