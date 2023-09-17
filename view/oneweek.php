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
    <div id="eintrag0"><input name="lessons[]" type="text" style="width: 1100px;"
                              value="<?php
                              echo $lessons[0]->getAmContent(); ?>"></div>
    <div id="eintrag1"><input name="lessons[]" type="text" style="width: 1100px;"
                              value="<?php
                              echo $lessons[0]->getPmContent(); ?>"></div>
    <div id="eintrag2"><input name="lessons[]" style="width: 1100px;" type="text"
                              value="<?php
                              echo $lessons[1]->getAmContent(); ?>"></div>
    <div id="eintrag3"><input name="lessons[]" type="text" style="width: 1100px;"
                              value="<?php
                              echo $lessons[1]->getPmContent(); ?>"></div>
    <div id="eintrag4"><input name="lessons[]" type="text" style="width: 1100px;"
                              value="<?php
                              echo $lessons[2]->getAmContent(); ?>"></div>
    <div id="eintrag5"><input name="lessons[]" type="text" style="width: 1100px;"
                              value="<?php
                              echo $lessons[2]->getPmContent(); ?>"></div>
    <div id="eintrag6"><input name="lessons[]" type="text" style="width: 1100px;"
                              value="<?php
                              echo $lessons[3]->getAmContent(); ?>"></div>
    <div id="eintrag7"><input name="lessons[]" type="text" style="width: 1100px;"
                              value="<?php
                              echo $lessons[3]->getPmContent(); ?>"></div>
    <div id="eintrag8"><input name="lessons[]" type="text" style="width: 1100px;"
                              value="<?php
                              echo $lessons[4]->getAmContent(); ?>"></div>
    <div id="eintrag9"><input name="lessons[]" type="text" style="width: 1100px;"
                              value="<?php
                              echo $lessons[4]->getPmContent(); ?>"></div>
    <!-- Dozenten -->
    <div id="doz1"><input type="text" name="teacher[]" value="<?php echo $teacher; ?>"></div>
    <div id="doz2"><input type="text" name="teacher[]" value="<?php echo $teacher; ?>"></div>
    <div id="doz3"><input type="text" name="teacher[]" value="<?php echo $teacher; ?>"></div>
    <div id="doz4"><input type="text" name="teacher[]" value="<?php echo $teacher; ?>"></div>
    <div id="doz5"><input type="text" name="teacher[]" value="<?php echo $teacher; ?>"></div>
    <div class="method0">
    <div><input type="checkbox" name="method0[]" id="method0a" class="methodA" value="1"
        <?php if (in_array('F', $methods[0]->getMethodNames())) echo 'checked' ?>>
      <label class="methodA" for="method0a">Frontalunterricht</label>
    </div>
    <div><input type="checkbox" name="method0[]" id="method0b" class="methodA" value="2"
        <?php if (in_array('P', $methods[0]->getMethodNames())) echo 'checked' ?>>
      <label class="methodA" for="method0b">Projektarbeit</label>
    </div>
    <div><input type="checkbox" name="method0[]" id="method0c" class="methodB" value="3"
        <?php if (in_array('G', $methods[0]->getMethodNames())) echo 'checked' ?>>
      <label class="methodB" for="method0c">Gruppenarbeit</label>
    </div>
    <div><input type="checkbox" name="method0[]" id="method0d" class="methodB" value="4"
        <?php if (in_array('S', $methods[0]->getMethodNames())) echo 'checked' ?>>
      <label class="methodB" for="method0d">Selbslernphase</label>
    </div>
    </div>
    <div class="method1">
    <div><input type="checkbox" name="method1[]" id="method1a" class="methodA" value="1"
        <?php if (in_array('F', $methods[1]->getMethodNames())) echo 'checked' ?>>
      <label class="methodA" for="method1a">Frontalunterricht</label>
    </div>
    <div><input type="checkbox" name="method1[]" id="method1b" class="methodA" value="2"
        <?php if (in_array('P', $methods[1]->getMethodNames())) echo 'checked' ?>>
      <label class="methodA" for="method1b">Projektarbeit</label>
    </div>
    <div><input type="checkbox" name="method1[]" id="method1c" class="methodB" value="3"
        <?php if (in_array('G', $methods[1]->getMethodNames())) echo 'checked' ?>>
      <label class="methodB" for="method1c">Gruppenarbeit</label>
    </div>
    <div><input type="checkbox" name="method1[]" id="method1d" class="methodB" value="4"
        <?php if (in_array('S', $methods[1]->getMethodNames())) echo 'checked' ?>>
      <label class="methodB" for="method1d">Selbslernphase</label>
      </div>
    </div>
    <div class="method2">
    <div><input type="checkbox" name="method2[]" id="method2a" class="methodA" value="1"
        <?php if (in_array('F', $methods[2]->getMethodNames())) echo 'checked' ?>>
      <label class="methodA" for="method2a">Frontalunterricht</label>
    </div>
    <div><input type="checkbox" name="method2[]" id="method2b" class="methodA" value="2"
        <?php if (in_array('P', $methods[2]->getMethodNames())) echo 'checked' ?>>
      <label class="methodA" for="method2b">Projektarbeit</label>
    </div>
    <div><input type="checkbox" name="method2[]" id="method2c" class="methodB" value="3"
        <?php if (in_array('G', $methods[2]->getMethodNames())) echo 'checked' ?>>
      <label class="methodB" for="method2c">Gruppenarbeit</label>
    </div>
    <div><input type="checkbox" name="method2[]" id="method2d" class="methodB" value="4"
        <?php if (in_array('S', $methods[2]->getMethodNames())) echo 'checked' ?>>
      <label class="methodB" for="method2d">Selbslernphase</label>
    </div>
    </div>
    <div class="method3">
    <div><input type="checkbox" name="method3[]" id="method3a" class="methodA" value="1"
        <?php if (in_array('F', $methods[3]->getMethodNames())) echo 'checked' ?>>
      <label class="methodA" for="method3a">Frontalunterricht</label>
    </div>
    <div><input type="checkbox" name="method3[]" id="method3b" class="methodA" value="2"
        <?php if (in_array('P', $methods[3]->getMethodNames())) echo 'checked' ?>>
      <label class="methodA" for="method3b">Projektarbeit</label>
    </div>
    <div><input type="checkbox" name="method3[]" id="method3c" class="methodB" value="3"
        <?php if (in_array('G', $methods[3]->getMethodNames())) echo 'checked' ?>>
      <label class="methodB" for="method3c">Gruppenarbeit</label>
    </div>
    <div><input type="checkbox" name="method3[]" id="method3d" class="methodB" value="4"
        <?php if (in_array('S', $methods[3]->getMethodNames())) echo 'checked' ?>>
      <label class="methodB" for="method3d">Selbslernphase</label>
    </div>
    </div>
    <div class="method4">
    <div><input type="checkbox" name="method4[]" id="method4a" class="methodA" value="1"
        <?php if (in_array('F', $methods[4]->getMethodNames())) echo 'checked' ?>>
      <label class="methodA" for="method4a">Frontalunterricht</label>
    </div>
    <div><input type="checkbox" name="method4[]" id="method4b" class="methodA" value="2"
        <?php if (in_array('P', $methods[4]->getMethodNames())) echo 'checked' ?>>
      <label class="methodA" for="method4b">Projektarbeit</label>
    </div>
    <div><input type="checkbox" name="method4[]" id="method4c" class="methodB" value="3"
        <?php if (in_array('G', $methods[4]->getMethodNames())) echo 'checked' ?>>
      <label class="methodB" for="method4c">Gruppenarbeit</label>
    </div>
    <div><input type="checkbox" name="method4[]" id="method4d" class="methodB" value="4"
        <?php if (in_array('S', $methods[4]->getMethodNames())) echo 'checked' ?>>
      <label class="methodB" for="method4d">Selbslernphase</label>
    </div>
    </div>
  </form>
</div>
</body>
</html>

