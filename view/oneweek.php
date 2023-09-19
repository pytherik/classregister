<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Klassenbuch</title>
    <meta name="viewport" content="initial-scale=0.8">
    <style>
        body {
            background-color: white;
            background-image: url("img/Klassenbuch.png");
        }
        @media print
        {
            .no-print, .no-print *
            {
                display: none !important;
            }
        }
        #next{
            position: absolute;
            left: 1000px;
            top: 50px;
        }
        #previous{
            position: absolute;
            left: 150px;
            top: 50px;
        }
        #save{
            position: absolute;
            left: 500px;
            top: 50px;
        }
        .navtext{
            font-size: 40px;
        }

        #module {
            position: absolute;
            left: <?php echo $themaLeft; ?>px;
            top: <?php echo $themaKwTop; ?>px;
            font-size: 46px;
        }

        #kw {
            position: absolute;
            left: <?php echo $kwLeft; ?>px;
            top: <?php echo ($themaKwTop + 5); ?>px;
        }

        #datum0 {
            position: absolute;
            left: <?php echo $datumLeft; ?>px;
            top: <?php echo $datumTop + 0 * $datumDiffTop; ?>px;
        }

        #datum1 {
            position: absolute;
            left: <?php echo $datumLeft; ?>px;
            top: <?php echo $datumTop + 1 * $datumDiffTop; ?>px;
        }

        #datum2 {
            position: absolute;
            left: <?php echo $datumLeft; ?>px;
            top: <?php echo $datumTop + 2 * $datumDiffTop; ?>px;
        }

        #datum3 {
            position: absolute;
            left: <?php echo $datumLeft; ?>px;
            top: <?php echo $datumTop + 3 * $datumDiffTop; ?>px;
        }

        #datum4 {
            position: absolute;
            left: <?php echo $datumLeft; ?>px;
            top: <?php echo $datumTop + 4 * $datumDiffTop; ?>px;
        }

        #notice {
            position: absolute;
            left: <?php echo $datumLeft; ?>px;
            top: <?php echo $bemTop; ?>px;
        }

        input {
            font-size: 36px;
            border: none;
        }

        .zahlen {
            font-size: 30px;
        }

        #lesson0 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 0 * $eintragDiffTop); ?>px;
        }

        #lesson1 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 0 * $eintragDiffTop + 70); ?>px;
        }

        #lesson2 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 1 * $eintragDiffTop); ?>px;
        }

        #lesson3 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 1 * $eintragDiffTop + 70); ?>px;
        }

        #lesson4 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 2 * $eintragDiffTop); ?>px;
        }

        #lesson5 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 2 * $eintragDiffTop + 70); ?>px;
        }

        #lesson6 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 3 * $eintragDiffTop); ?>px;
        }

        #lesson7 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 3 * $eintragDiffTop + 70); ?>px;
        }

        #lesson8 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 4 * $eintragDiffTop); ?>px;
        }

        #lesson9 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 4 * $eintragDiffTop + 70); ?>px;
        }

        #teacher1 {
            position: absolute;
            left: <?php echo $dozLeft; ?>px;
            top: <?php echo ($dozTop + 0 * $datumDiffTop); ?>px;
        }

        #teacher2 {
            position: absolute;
            left: <?php echo $dozLeft; ?>px;
            top: <?php echo ($dozTop + 1 * $datumDiffTop); ?>px;
        }

        #teacher3 {
            position: absolute;
            left: <?php echo $dozLeft; ?>px;
            top: <?php echo ($dozTop + 2 * $datumDiffTop); ?>px;
        }

        #teacher4 {
            position: absolute;
            left: <?php echo $dozLeft; ?>px;
            top: <?php echo ($dozTop + 3 * $datumDiffTop); ?>px;
        }

        #teacher5 {
            position: absolute;
            left: <?php echo $dozLeft; ?>px;
            top: <?php echo ($dozTop + 4 * $datumDiffTop); ?>px;
        }

        .checkbox1 {
            position: absolute;
            left: 1730px;
            top: 550px;
            display: flex;
            align-items: center;
        }

        label {
            font-family: Calibri;
        }
        .checkbox2 {
            position: absolute;
            left: 1730px;
            top: 575px;
            display: flex;
            align-items: center;
        }

        .checkbox3 {
            position: absolute;
            left: 1730px;
            top: 620px;
            display: flex;
            align-items: center;
        }

        .checkbox4 {
            position: absolute;
            left: 1730px;
            top: 645px;
            display: flex;
            align-items: center;
        }
    </style>
    <link rel="stylesheet" href="css/oneweek.css">
</head>
<body>
<div id="container">
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div id="previous" class="no-print">
            <button type="submit" name="action" value="previous" class="navtext"><= vorige Woche</button>
        </div>
        <div id="save" class="no-print">
            <button type="submit" name="action" value="save" class="navtext">schonmal in db speichern</button>
        </div>
        <div id="next" class="no-print">
            <button type="submit" name="action" value="next" class="navtext">nächste Woche =></button>
        </div>

        <div id="module"><input type="text" name="module" value="<?php
            echo $module; ?>"></div>
        <div id="kw"><input type="text" class="zahlen" name="kw" style="width: 40px;" value="<?php echo $weekNo; ?>">
        </div>
        <div id="datum0"><input type="text" class="zahlen" value="<?php echo $datum[0]; ?>"></div>
        <div id="datum1"><input type="text" class="zahlen" value="<?php echo $datum[1]; ?>"></div>
        <div id="datum2"><input type="text" class="zahlen" value="<?php echo $datum[2]; ?>"></div>
        <div id="datum3"><input type="text" class="zahlen" value="<?php echo $datum[3]; ?>"></div>
        <div id="datum4"><input type="text" class="zahlen" value="<?php echo $datum[4]; ?>"></div>
        <!-- Bem -->
        <div id="notice"><input type="text" name="notice" style="width: 1500px;" value="<?php
            echo $notice; ?>"></div>
        <!-- einträge -->
        <div id="lesson0"><input name="lesson[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lesson[0]->getAmContent(); ?>"></div>
        <div id="lesson1"><input name="lesson[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lesson[0]->getPmContent(); ?>"></div>
        <div id="lesson2"><input name="lesson[]" style="width: 1200px;" type="text"
                                  value="<?php
                                  echo $lesson[1]->getAmContent(); ?>"></div>
        <div id="lesson3"><input name="lesson[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lesson[1]->getPmContent(); ?>"></div>
        <div id="lesson4"><input name="lesson[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lesson[2]->getAmContent(); ?>"></div>
        <div id="lesson5"><input name="lesson[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lesson[2]->getPmContent(); ?>"></div>
        <div id="lesson6"><input name="lesson[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lesson[3]->getAmContent(); ?>"></div>
        <div id="lesson7"><input name="lesson[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lesson[3]->getPmContent(); ?>"></div>
        <div id="lesson8"><input name="lesson[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lesson[4]->getAmContent(); ?>"></div>
        <div id="lesson9"><input name="lesson[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lesson[4]->getPmContent(); ?>"></div>

        <div id="FormOfInstruction1" class="checkbox1">
            <input type="checkbox" name="checkbox[]" value="Frontalunterricht">
            <label for="FormOfInstruction">Frontalunterricht</label>
        </div>

        <div id="FormOfInstruction2" class="checkbox2">
            <input type="checkbox" name="checkbox[]" value="Projektarbeit">
            <label for="FormOfInstruction">Projektarbeit</label>
        </div>

        <div id="FormOfInstruction3" class="checkbox3">
            <input type="checkbox" name="checkbox[]" value="Gruppenarbeit">
            <label for="FormOfInstruction">Gruppenarbeit</label>
        </div>

        <div id="FormOfInstruction4" class="checkbox4">
            <input type="checkbox" name="checkbox[]" value="Selbstlernphase">
            <label for="FormOfInstruction">Selbstlernphase</label>
        </div>
        <!-- Dozenten -->
        <div id="teacher1"><input type="text" name="teacher[]" value="<?php
            echo $teacher; ?>"></div>
        <div id="teacher2"><input type="text" name="teacher[]" value="<?php
            echo $teacher; ?>"></div>
        <div id="teacher3"><input type="text" name="teacher[]" value="<?php
            echo $teacher; ?>"></div>
        <div id="teacher4"><input type="text" name="teacher[]" value="<?php
            echo $teacher; ?>"></div>
        <div id="teacher5"><input type="text" name="teacher[]" value="<?php
            echo $teacher; ?>"></div>
    </form>
</div>
</body>
</html>

