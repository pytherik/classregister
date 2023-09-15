<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Klassenbuch</title>
  <meta name="viewport" content="initial-scale=0.8">
<!--  <link rel="stylesheet" href="../css/style.css">-->
  <style>
      :root {
          --themaLeft: 400px;
          --themaKwTop: 355px;
          --kwLeft: 2100px;
          --datumLeft: 370px;
          --datumTop: 558px;
          --datumDiffTop: 155px;
          --eintragLeft: 570px;
          --eintragTop: 559px;
          --eintragDiffTop: 155px;
          --bemTop: 1400px;
          --dozLeft: 2000px;
          --dozTop: 599px;
      }

      body {
          background-color: #444;
          background-image: url("img/Klassenbuch.png");
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
          left: var(--themaLeft);
          top: var(--themaKwTop);
          font-size: 46px;
      }

      #kw {
          position: absolute;
          left: var(--kwLeft);
          top: calc(var(--themaKwTop) + 5px);
      }

      #datum0 {
          position: absolute;
          left: var(--datumLeft);
          top: calc(var(--datumTop) + 0 * var(--datumDiffTop));
      }

      #datum1 {
          position: absolute;
          left: var(--datumLeft);
          top: calc(var(--datumTop) + 1 * var(--datumDiffTop));
      }

      #datum2 {
          position: absolute;
          left: var(--datumLeft);
          top: calc(var(--datumTop) + 2 * var(--datumDiffTop));
      }

      #datum3 {
          position: absolute;
          left: var(--datumLeft);
          top: calc(var(--datumTop) + 3 * var(--datumDiffTop));
      }

      #datum4 {
          position: absolute;
          left: var(--datumLeft);
          top: calc(var(--datumTop) + 4 * var(--datumDiffTop));
      }

      #bem {
          position: absolute;
          left: var(--datumLeft);
          top: var(--bemTop);
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
          left: var(--eintragLeft);
          top: calc(var(--eintragTop) + var(--eintragDiffTop));
      }

      #eintrag1 {
          position: absolute;
          left: var(--eintragLeft);
          top: calc(var(--eintragTop) + 0 * var(--eintragDiffTop) + 70px);
      }

      #eintrag2 {
          position: absolute;
          left: var(--eintragLeft);
          top: calc(var(--eintragTop) + 1 * var(--eintragDiffTop) + 70px);
      }

      #eintrag3 {
          position: absolute;
          left: var(--eintragLeft);
          top: calc(var(--eintragTop) + var(--eintragDiffTop) + 71px);
      }

      #eintrag4 {
          position: absolute;
          left: var(--eintragLeft);
          top: calc(var(--eintragTop) + var(--eintragDiffTop) + 2px);
      }

      #eintrag5 {
          position: absolute;
          left: var(--eintragLeft);
          top: calc(var(--eintragTop) + var(--eintragDiffTop) + 72px);
      }

      #eintrag6 {
          position: absolute;
          left: var(--eintragLeft);
          top: calc(var(--eintragTop) + var(--eintragDiffTop) + 3px);
      }

      #eintrag7 {
          position: absolute;
          left: var(--eintragLeft);
          top: calc(var(--eintragTop) + var(--eintragDiffTop) + 73px);
      }

      #eintrag8 {
          position: absolute;
          left: var(--eintragLeft);
          top: calc(var(--eintragTop) + var(--eintragDiffTop) + 4px);
      }

      #eintrag9 {
          position: absolute;
          left: var(--eintragLeft);
          top: calc(var(--eintragTop) + var(--eintragDiffTop) + 74px);
      }

      #doz1 {
          position: absolute;
          left: var(--dozLeft);
          top: calc(var(--dozTop) + var(--datumDiffTop));
      }

      #doz2 {
          position: absolute;
          left: var(--dozLeft);
          top: calc(var(--dozTop) + var(--datumDiffTop) + 1px);
      }

      #doz3 {
          position: absolute;
          left: var(--dozLeft);
          top: calc(var(--dozTop) + var(--datumDiffTop) + 2px);
      }

      #doz4 {
          position: absolute;
          left: var(--dozLeft);
          top: calc(var(--dozTop) + var(--datumDiffTop) + 3px);
      }

      #doz5 {
          position: absolute;
          left: var(--dozLeft);
          top: calc(var(--dozTop) + var(--datumDiffTop) + 4px);
      }

      @media print
      {
          .no-print, .no-print *
          {
              display: none !important;
          }
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

