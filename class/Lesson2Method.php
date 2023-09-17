<?php

class Lesson2Method
{
  private ?int $lessonId;
  private ?array $methodNames;
  private ?array $methodIds;

  /**
   * @param int|null $lessonId
   * @param array|null $methodNames
   */
  public function __construct(int $lessonId = null, array $methodNames = null, array $methodIds = null)
  {
    if (isset($lessonId)) {
      $this->lessonId = $lessonId;
      $this->methodNames = $methodNames;
      $this->methodIds = $methodIds;
    }
  }

  public function createLessonToMethods($lessonId, $methods): void
  {
    if ($methods !== []) {
      echo "<pre>";
      print_r($methods);
      echo "</pre>";
      try {
        $dbh = Db::getConnection();
        $sql = "INSERT INTO lesson2method VALUES (NULL, :lessonId, :methodId)";
        foreach ($methods as $methodId) {
          $stmt = $dbh->prepare($sql);
          $stmt->bindParam('lessonId', $lessonId, PDO::PARAM_INT);
          $stmt->bindParam('methodId', $methodId, PDO::PARAM_INT);
          $stmt->execute();
        }
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }
  }

  public function updateLessonToMethods($lessonId, $methods): void
  {
    if ($methods !== []) {
      try {

        $dbh = Db::getConnection();

        $sql1 = "DELETE FROM lesson2method WHERE lessonId = :lessonId";
        $stmt = $dbh->prepare($sql1);
        $stmt->bindParam('lessonId', $lessonId, PDO::PARAM_INT);
        $stmt->execute();

        $sql2 = "INSERT INTO lesson2method VALUES (NULL, :lessonId, :methodId)";
        $stmt = $dbh->prepare($sql2);
        $stmt->bindParam('lessonId', $lessonId, PDO::PARAM_INT);

        foreach ($methods as $methodId) {
          $stmt->bindParam('methodId', $methodId, PDO::PARAM_INT);
          $stmt->execute();
        }
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }
  }

  public function getMethodsByCalWeekId($calWeekId): array
  {
    $l = new Lesson();
    $lessons = $l->getLessonsByCalWeekId($calWeekId);
    $methods = [];
    if (count($lessons) === 0) {
      return [[], [], [], [], []];
    } else {
      try {
        $dbh = Db::getConnection();
        foreach ($lessons as $lesson) {
          $id = $lesson->getId();
          $sql = "SELECT name, method.id FROM method JOIN lesson2method ON methodId=method.id JOIN lesson ON lessonId=lesson.id 
                   WHERE lesson.id = :id";
          $stmt = $dbh->prepare($sql);
          $stmt->bindParam('id', $id);
          $stmt->execute();
          $res = $stmt->fetchAll();
          $methodNames = [];
          $methodIds = [];
          foreach ($res as $item) {
            $methodNames[] = $item[0];
            $methodIds[] = $item[1];
          }
          $methods[] = new Lesson2Method($id, $methodNames, $methodIds);
        }
//        echo "<pre>";
//        print_r($methods);
//        echo "</pre>";
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
      return $methods;
    }
  }

  public function getLessonId(): ?int
  {
    return $this->lessonId;
  }

  public function getMethodNames(): ?array
  {
    return $this->methodNames;
  }

  public function getMethodIds(): ?array
  {
    return $this->methodIds;
  }

}

