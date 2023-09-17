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
    <div class="module0">
    <div><input type="checkbox" name="module0[]" id="module0a" class="moduleA" value="F"
        <?php if (in_array('F', $modules[0])) echo 'checked' ?>>
      <label class="moduleA" for="module0a">Frontalunterricht</label>
    </div>
    <div><input type="checkbox" name="module0[]" id="module0b" class="moduleA" value="P"
        <?php if (in_array('P', $modules[0])) echo 'checked' ?>>
      <label class="moduleA" for="module0b">Projektarbeit</label>
    </div>
    <div><input type="checkbox" name="module0[]" id="module0c" class="moduleB" value="G"
        <?php if (in_array('G', $modules[0])) echo 'checked' ?>>
      <label class="moduleB" for="module0c">Gruppenarbeit</label>
    </div>
    <div><input type="checkbox" name="module0[]" id="module0d" class="moduleB" value="S"
        <?php if (in_array('S', $modules[0])) echo 'checked' ?>>
      <label class="moduleB" for="module0d">Selbslernphase</label>
    </div>
    </div>
    <div class="module1">
    <div><input type="checkbox" name="module1[]" id="module1a" class="moduleA" value="F"
        <?php if (in_array('F', $modules[1])) echo 'checked' ?>>
      <label class="moduleA" for="module1a">Frontalunterricht</label>
    </div>
    <div><input type="checkbox" name="module1[]" id="module1b" class="moduleA" value="P"
        <?php if (in_array('P', $modules[1])) echo 'checked' ?>>
      <label class="moduleA" for="module1b">Projektarbeit</label>
    </div>
    <div><input type="checkbox" name="module1[]" id="module1c" class="moduleB" value="G"
        <?php if (in_array('G', $modules[1])) echo 'checked' ?>>
      <label class="moduleB" for="module1c">Gruppenarbeit</label>
    </div>
    <div><input type="checkbox" name="module1[]" id="module1d" class="moduleB" value="S"
        <?php if (in_array('S', $modules[1])) echo 'checked' ?>>
      <label class="moduleB" for="module1d">Selbslernphase</label>
      </div>
    </div>
    <div class="module2">
    <div><input type="checkbox" name="module2[]" id="module2a" class="moduleA" value="F"
        <?php if (in_array('F', $modules[2])) echo 'checked' ?>>
      <label class="moduleA" for="module2a">Frontalunterricht</label>
    </div>
    <div><input type="checkbox" name="module2[]" id="module2b" class="moduleA" value="P"
        <?php if (in_array('P', $modules[2])) echo 'checked' ?>>
      <label class="moduleA" for="module2b">Projektarbeit</label>
    </div>
    <div><input type="checkbox" name="module2[]" id="module2c" class="moduleB" value="G"
        <?php if (in_array('G', $modules[2])) echo 'checked' ?>>
      <label class="moduleB" for="module2c">Gruppenarbeit</label>
    </div>
    <div><input type="checkbox" name="module2[]" id="module2d" class="moduleB" value="S"
        <?php if (in_array('S', $modules[2])) echo 'checked' ?>>
      <label class="moduleB" for="module2d">Selbslernphase</label>
    </div>
    </div>
    <div class="module3">
    <div><input type="checkbox" name="module3[]" id="module3a" class="moduleA" value="F"
        <?php if (in_array('F', $modules[3])) echo 'checked' ?>>
      <label class="moduleA" for="module3a">Frontalunterricht</label>
    </div>
    <div><input type="checkbox" name="module3[]" id="module3b" class="moduleA" value="P"
        <?php if (in_array('P', $modules[3])) echo 'checked' ?>>
      <label class="moduleA" for="module3b">Projektarbeit</label>
    </div>
    <div><input type="checkbox" name="module3[]" id="module3c" class="moduleB" value="G"
        <?php if (in_array('G', $modules[3])) echo 'checked' ?>>
      <label class="moduleB" for="module3c">Gruppenarbeit</label>
    </div>
    <div><input type="checkbox" name="module3[]" id="module3d" class="moduleB" value="S"
        <?php if (in_array('S', $modules[3])) echo 'checked' ?>>
      <label class="moduleB" for="module3d">Selbslernphase</label>
    </div>
    </div>
    <div class="module4">
    <div><input type="checkbox" name="module4[]" id="module4a" class="moduleA" value="F"
        <?php if (in_array('F', $modules[4])) echo 'checked' ?>>
      <label class="moduleA" for="module4a">Frontalunterricht</label>
    </div>
    <div><input type="checkbox" name="module4[]" id="module4b" class="moduleA" value="P"
        <?php if (in_array('P', $modules[4])) echo 'checked' ?>>
      <label class="moduleA" for="module4b">Projektarbeit</label>
    </div>
    <div><input type="checkbox" name="module4[]" id="module4c" class="moduleB" value="G"
        <?php if (in_array('G', $modules[4])) echo 'checked' ?>>
      <label class="moduleB" for="module4c">Gruppenarbeit</label>
    </div>
    <div><input type="checkbox" name="module4[]" id="module4d" class="moduleB" value="S"
        <?php if (in_array('S', $modules[4])) echo 'checked' ?>>
      <label class="moduleB" for="module4d">Selbslernphase</label>
    </div>
    </div>
  </form>
</div>
</body>
</html>

