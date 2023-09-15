<?php


class Week
{
    // PK
    private int $id;
    // Woche
    private int $weekNo;
    // Thema
    private string $module;
    // Dozent
    private string $teacher;
    // Bemerkung
    private string $notice;

    private array $lessons = [];


    /**
     * Class Constructor
     *
     * @param int|null $id The ID of the class
     * @param int|null $weekNo The week number of the class
     * @param string|null $module The module of the class
     * @param string|null $teacher The teacher of the class
     * @param string|null $notice The notice for the class
     * @param array|null $lessons The lessons for the class
     */
    public function __construct(
        int $id = null,
        int $weekNo = null,
        string $module = null,
        string $teacher = null,
        string $notice = null,
        array $lessons = null
    ) {
        if ($id === null) {
        } else {
            $this->id = $id;
            $this->weekNo = $weekNo;
            $this->module = $module;
            $this->teacher = $teacher;
            $this->notice = $notice;
            $this->lessons = $lessons;
        }
    }

    /**
     * Creates a new Week entry in the database with the given parameters.
     *
     * @param int $weekNo The week number.
     * @param string $module The module name.
     * @param string $teacher The teacher name.
     * @param string $notice Any additional notice for the week.
     * @param array $lessons An array of Lesson objects for the week.
     * @return Week The newly created Week object.
     */
    public static function create(int $weekNo, string $module, string $teacher, string $notice, array $lessons): Week
    {
        try {
            $dbh = Db::getConnection();
            $sql = "INSERT INTO calweek VALUES(NULL, :weekNo, :module, :teacher, :notice)";
            $sth = $dbh->prepare($sql); // $sth für PDOStatement (prepared Statement)
            $sth->bindParam('weekNo', $weekNo, PDO::PARAM_INT);
            $sth->bindParam('module', $module, PDO::PARAM_STR);
            $sth->bindParam('teacher', $teacher, PDO::PARAM_STR);
            $sth->bindParam('notice', $notice, PDO::PARAM_STR);
            $dummy = $sth->execute();

            $lastID = $dbh->lastInsertId();

            $lesson = new Lesson();
            // $lessons leer, dann schreibe im SQL 10 leere Einträge
            if (count($lessons) === 0) {
                $lessons = ['', '', '', '', '', '', '', '', '', ''];
                $lesson->createLessons($lastID, '', '', '', '', '', '', '', '', '', '');
            } else {
                $lesson->createLessons(
                    $lastID,
                    $lessons[0]->getAmContent(),
                    $lessons[0]->getPmContent(),
                    $lessons[1]->getAmContent(),
                    $lessons[1]->getPmContent(),
                    $lessons[2]->getAmContent(),
                    $lessons[2]->getPmContent(),
                    $lessons[3]->getAmContent(),
                    $lessons[3]->getPmContent(),
                    $lessons[4]->getAmContent(),
                    $lessons[4]->getPmContent()
                );
            }
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        // falls id benötigt wird
        // $id = $dbh->lastInsertId();
        return Week::getByWeekNo($weekNo);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Retrieves a Week object by its week number.
     *
     * @param int|null $weekNo The week number (optional, default = null).
     *
     * @return Week The Week object representing the week.
     */
    public static function getByWeekNo(int $weekNo = null): Week
    {
        try {
            $dbh = Db::getConnection();
            // datenbank
            if (isset($weekNo)) {
                $sql = 'SELECT * FROM calweek WHERE weekNo = :weekNo';
                $sth = $dbh->prepare($sql); // $sth für PDOStatement (prepared Statement)
                $sth->bindParam('weekNo', $weekNo, PDO::PARAM_INT);
            }
            $sth->execute();
            $calWeeks = $sth->fetchAll(PDO::FETCH_CLASS, 'Week');
            // wenn es noch keine Daten in der db gibt, werden sie erstellt & gespeichert
            if (count($calWeeks) === 0) {
                // Falls es noch gar keine Woche in db gibt
                // $weekNo = $weekNo ?? 19;
                // leere Woche in db erstellen
                $calWeeks[0] = Week::create($weekNo, '', '', '', []);
            }

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $calWeeks[0];
    }

//    /**
//     * Constructs a new Week object using the provided parameters.
//     *
//     * @param int $id The ID of the week.
//     * @param int $weekNo The week number.
//     * @param string $module The module name.
//     * @param string $teacher The names of the teachers.
//     * @param string $notice Any additional notice for the week.
//     * @param array $lessons An array of lesson objects for the week.
//     *
//     * @return Week The constructed Week object.
//     */
//    public static function buildFromPDO(
//        int $id,
//        int $weekNo,
//        string $module,
//        string $teacher,
//        string $notice,
//        array $lessons
//    ): Week
//    {
//        return new Week($id, $weekNo, $module, $teacher, $notice, $lessons);
//    }

    /**
     * @return int
     */
    public function getWeekNo(): int
    {
        return $this->weekNo;
    }

    /**
     * @return string
     */
    public function getModule(): string
    {
        return $this->module;
    }

    /**
     * @return string
     */
    public function getTeacher(): string
    {
        return $this->teacher;
    }

    /**
     * @return string
     */
    public function getNotice(): string
    {
        return $this->notice;
    }

    /**
     * Retrieve the lessons by calendar week ID.
     *
     * @return array The lessons associated with the calendar week.
     */
    public function getLessonsByCalWeekId(): array
    {
        $l = new Lesson();
        return $l->getLessonsByCalWeekId($this->getId());
    }

    public function save(): Week
    {
        $id = $this->getId();
        switch ($id) {
            // DS ist noch nicht in db enthalten
            case 0:
                $requestWeek = $this->create(
                    $this->getWeekNo(),
                    $this->getModule(),
                    $this->getTeacher(),
                    $this->getNotice(),
                    $this->getLessonsByCalWeekId()
                );
                break;
            // DS wurde geändert
            default:
                $this->update();
                $requestWeek = $this;
        }
        return $requestWeek;
    }

    private function update(): void
    {
        try {
            $dbh = Db::getConnection();
            // datenbank abfragen
            $sql = 'UPDATE calweek SET weekNo = :weekNo, module = :module, teacher = :teacher, notice = :notice WHERE id = :id';
            $sth = $dbh->prepare($sql); // $sth für PDOStatement (prepared Statement)
            $sth->bindParam('weekNo', $this->weekNo, PDO::PARAM_INT);
            $sth->bindParam('module', $this->module, PDO::PARAM_STR);
            $sth->bindParam('teacher', $this->teacher, PDO::PARAM_STR);
            $sth->bindParam('notice', $this->notice, PDO::PARAM_STR);
            $sth->bindParam('id', $this->id, PDO::PARAM_INT);
            $sth->execute();
            $l = new Lesson();
            $l->update(
                $this->id,
                $this->lessons[0],
                $this->lessons[1],
                $this->lessons[2],
                $this->lessons[3],
                $this->lessons[4],
                $this->lessons[5],
                $this->lessons[6],
                $this->lessons[7],
                $this->lessons[8],
                $this->lessons[9]
            );

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     * Returns the last existing week from the database or creates a standard week if no data is found.
     *
     * @param Week $postWeek The week object used for reference.
     *
     * @return Week The last existing week from the database or a newly created standard week.
     */
    public function getLastOrStandardWeek(Week $postWeek): Week
    {
        try {
            $dbh = Db::getConnection();
            // letzte Eintragswoche ausgeben
            $sql = 'SELECT * FROM calweek WHERE id = (SELECT MAX(id) FROM calweek)';
            $sth = $dbh->prepare($sql); // $sth für PDOStatement
            $sth->execute();
            $calWeeks = $sth->fetchAll(PDO::FETCH_CLASS, 'Week');

            // wenn es noch keine Daten in der db gibt, werden sie erstellt & gespeichert
            if (count($calWeeks) === 0) {
                // Falls es noch gar keine Woche in db gibt
                $weekNo = $weekNo ?? 1;
                // leere Woche in db erstellen
                $calWeeks[0] = Week::create($weekNo, '', '', '', []);
            }
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        return $calWeeks[0];
    }

    /**
     * Retrieves the next week instance based on the given week.
     *
     * @param Week $postWeek The current week instance.
     *
     * @return Week The next week instance.
     */
    public function getNextWeek(Week $postWeek): Week
    {
        if ($postWeek->getWeekNo() < MAXWEEKNO) {
            $weekNo = $this->weekNo + 1;
        } else {
            $weekNo = $this->weekNo;
        }
        return Week::getByWeekNo($weekNo);
    }

    /**
     * Get the previous week based on a given week.
     *
     * @param Week $postWeek The current week object.
     *
     * @return Week The previous week object.
     */
    public function getPreviousWeek(Week $postWeek): Week
    {
        if ($postWeek->getWeekNo() > MINWEEKNO) {
            $weekNo = $this->weekNo - 1;
        } else {
            $weekNo = $this->weekNo;
        }
        return Week::getByWeekNo($weekNo);
    }
}