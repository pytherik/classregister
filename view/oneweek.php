<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Klassenbuch</title>
  <meta name="viewport" content="initial-scale=0.8">
  <link rel="stylesheet" href="css/style.css">
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

