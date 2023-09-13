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
    private string $teachers;
    // Bemerkung
    private string $notice;

    private array $lessons = [];


    /**
     * Constructs a new Week object.
     *
     * @param int $id The ID of the week.
     * @param int $weekNo The week number.
     * @param string $module The module name.
     * @param string $teachers The name of the lecturer.
     * @param string $notice Any additional notice.
     * @param array $lessons An array of lessons.
     */
    public function __construct(int $id, int $weekNo, string $module, string $teachers, string $notice, array $lessons)
    {
        $this->id = $id;
        $this->weekNo = $weekNo;
        $this->module = $module;
        $this->teachers = $teachers;
        $this->notice = $notice;
        $this->lessons = $lessons;
    }


    /**
     * Creates a new Week object and inserts it into the database.
     *
     * @param int $weekNo The week number.
     * @param string $module The module name.
     * @param string $teachers The names of the teachers.
     * @param string $notice Any additional notice.
     * @param array $lessons An array of lesson entries.
     * @return Week The created Week object.
     */
    public static function create(int $weekNo, string $module, string $teachers, string $notice, array $lessons): Week
    {
        try {
            $dbh = Db::getConnection();
            $sql = "INSERT INTO calweek VALUES(NULL, :weekNo, :module, :teacher, :notice)";
            $sth = $dbh->prepare($sql); // $sth für PDOStatement (prepared Statement)
            $sth->bindParam('weekNo', $weekNo, PDO::PARAM_INT);
            $sth->bindParam('module', $module, PDO::PARAM_STR);
            $sth->bindParam('teacher', $teachers, PDO::PARAM_STR);
            $sth->bindParam('notice', $notice, PDO::PARAM_STR);

            $dummy = $sth->execute();
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
            $calWeeks = $sth->fetchAll(PDO::FETCH_FUNC, 'week::buildFromPDO');
            // wenn es noch keine Daten in der db gibt, werden sie erstellt & gespeichert
            if (count($calWeeks) === 0) {
                // Falls es noch gar keine Woche in db gibt
                // $weekNo = $weekNo ?? 19;
                // leere Woche in db erstellen
                $calWeeks[0] = Week::create($weekNo, '', '', '');
            }

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $calWeeks[0];
    }

    /**
     * Constructs a new Week object using the provided parameters.
     *
     * @param int $id The ID of the week.
     * @param int $weekNo The week number.
     * @param string $module The module name.
     * @param string $teachers The names of the teachers.
     * @param string $notice Any additional notice for the week.
     * @param array $lessons An array of lesson objects for the week.
     *
     * @return Week The constructed Week object.
     */
    public static function buildFromPDO(
        int $id,
        int $weekNo,
        string $module,
        string $teachers,
        string $notice,
        array $lessons
    ): Week
    {
        $w = new Week($id, $weekNo, $module, $teachers, $notice, $lessons);
        return $w;
    }

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
    public function getTeachers(): string
    {
        return $this->teachers;
    }

    /**
     * @return string
     */
    public function getNotice(): string
    {
        return $this->notice;
    }

    /**
     * Returns the lession data associated with the instance.
     *
     * @return array An array containing the lession data.
     */
    public function getLessons(): array
    {
        return $this->lessons;
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
                    $this->getTeachers(),
                    $this->getNotice(),
                    $this->getLessons()
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
            $sql = 'UPDATE calweek SET weekNo = :weekNo, module = :module, teacher = :teachers, notice = :notice 
                    WHERE id = :id';
            $sth = $dbh->prepare($sql); // $sth für PDOStatement (prepared Statement)
            $sth->bindParam('weekNo', $this->weekNo, PDO::PARAM_INT);
            $sth->bindParam('module', $this->module, PDO::PARAM_STR);
            $sth->bindParam('teacher', $this->teachers, PDO::PARAM_STR);
            $sth->bindParam('notice', $this->notice, PDO::PARAM_STR);
            $sth->bindParam('id', $this->id, PDO::PARAM_INT);

            $sth->execute();
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
            $calWeeks = $sth->fetchAll(PDO::FETCH_FUNC, 'week::buildFromPDO');

            // wenn es noch keine Daten in der db gibt, werden sie erstellt & gespeichert
            if (count($calWeeks) === 0) {
                // Falls es noch gar keine Woche in db gibt
                $weekNo = $weekNo ?? 1;
                // leere Woche in db erstellen
                $calWeeks[0] = Week::create($weekNo, '', '', '');
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
        if ($postWeek->getWeekNo() < MAXWEEKNO){
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
        if ($postWeek->getWeekNo() > MINWEEKNO){
            $weekNo = $this->weekNo - 1;
        } else {
             $weekNo = $this->weekNo;
        }
        return Week::getByWeekNo($weekNo);
    }
}