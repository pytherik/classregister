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
        #thema {
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

        #bem {
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

        #eintrag0 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 0 * $eintragDiffTop); ?>px;
        }

        #eintrag1 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 0 * $eintragDiffTop + 70); ?>px;
        }

        #eintrag2 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 1 * $eintragDiffTop); ?>px;
        }

        #eintrag3 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 1 * $eintragDiffTop + 70); ?>px;
        }

        #eintrag4 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 2 * $eintragDiffTop); ?>px;
        }

        #eintrag5 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 2 * $eintragDiffTop + 70); ?>px;
        }

        #eintrag6 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 3 * $eintragDiffTop); ?>px;
        }

        #eintrag7 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 3 * $eintragDiffTop + 70); ?>px;
        }

        #eintrag8 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 4 * $eintragDiffTop); ?>px;
        }

        #eintrag9 {
            position: absolute;
            left: <?php echo $eintragLeft; ?>px;
            top: <?php echo ($eintragTop + 4 * $eintragDiffTop + 70); ?>px;
        }

        #doz1 {
            position: absolute;
            left: <?php echo $dozLeft; ?>px;
            top: <?php echo ($dozTop + 0 * $datumDiffTop); ?>px;
        }

        #doz2 {
            position: absolute;
            left: <?php echo $dozLeft; ?>px;
            top: <?php echo ($dozTop + 1 * $datumDiffTop); ?>px;
        }

        #doz3 {
            position: absolute;
            left: <?php echo $dozLeft; ?>px;
            top: <?php echo ($dozTop + 2 * $datumDiffTop); ?>px;
        }

        #doz4 {
            position: absolute;
            left: <?php echo $dozLeft; ?>px;
            top: <?php echo ($dozTop + 3 * $datumDiffTop); ?>px;
        }

        #doz5 {
            position: absolute;
            left: <?php echo $dozLeft; ?>px;
            top: <?php echo ($dozTop + 4 * $datumDiffTop); ?>px;
        }
    </style>
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

        <div id="thema"><input type="text" name="module" value="<?php echo $module; ?>"></div>
        <div id="kw"><input type="text" class="zahlen" name="kw" style="width: 40px;" value="<?php echo $weekNo; ?>">
        </div>
        <div id="datum0"><input type="text" class="zahlen" value="<?php echo $datum[0]; ?>"></div>
        <div id="datum1"><input type="text" class="zahlen" value="<?php echo $datum[1]; ?>"></div>
        <div id="datum2"><input type="text" class="zahlen" value="<?php echo $datum[2]; ?>"></div>
        <div id="datum3"><input type="text" class="zahlen" value="<?php echo $datum[3]; ?>"></div>
        <div id="datum4"><input type="text" class="zahlen" value="<?php echo $datum[4]; ?>"></div>
        <!-- Bem -->
        <div id="bem"><input type="text" name="notice" style="width: 1500px;" value="<?php echo $notice; ?>"></div>
        <!-- einträge -->
        <div id="eintrag0"><input name="lessons[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lessons[0]->getAmContent(); ?>"></div>
        <div id="eintrag1"><input name="lessons[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lessons[0]->getPmContent(); ?>"></div>
        <div id="eintrag2"><input name="lessons[]" style="width: 1200px;" type="text"
                                  value="<?php
                                  echo $lessons[1]->getAmContent(); ?>"></div>
        <div id="eintrag3"><input name="lessons[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lessons[1]->getPmContent(); ?>"></div>
        <div id="eintrag4"><input name="lessons[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lessons[2]->getAmContent(); ?>"></div>
        <div id="eintrag5"><input name="lessons[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lessons[2]->getPmContent(); ?>"></div>
        <div id="eintrag6"><input name="lessons[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lessons[3]->getAmContent(); ?>"></div>
        <div id="eintrag7"><input name="lessons[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lessons[3]->getPmContent(); ?>"></div>
        <div id="eintrag8"><input name="lessons[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lessons[4]->getAmContent(); ?>"></div>
        <div id="eintrag9"><input name="lessons[]" type="text" style="width: 1200px;"
                                  value="<?php
                                  echo $lessons[4]->getPmContent(); ?>"></div>
        <!-- Dozenten -->
        <div id="doz1"><input type="text" name="teacher[]" value="<?php echo $teacher; ?>"></div>
        <div id="doz2"><input type="text" name="teacher[]" value="<?php echo $teacher; ?>"></div>
        <div id="doz3"><input type="text" name="teacher[]" value="<?php echo $teacher; ?>"></div>
        <div id="doz4"><input type="text" name="teacher[]" value="<?php echo $teacher; ?>"></div>
        <div id="doz5"><input type="text" name="teacher[]" value="<?php echo $teacher; ?>"></div>
    </form>
</div>
</body>
</html>

