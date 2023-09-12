<?php


class Week
{
    // PK
    private int $id;
    // Woche
    private int $weekNo;
    // Thema
    private string $modul;
    // Dozent
    private string $doz;
    // Bemerkung
    private string $notice;
    // 10 string Einträge
    private array $lession = [];



    /**
     * Constructor method for creating a new instance of the class.
     *
     * @param int $id The ID of the instance.
     * @param int $weekNo The week number.
     * @param string $modul The module name.
     * @param string $doz The name of the lecturer.
     * @param string $notice The notice associated with the instance.
     * @param array $lession An array of lession data.
     *
     * @return void
     */
    public function __construct(int $id, int $weekNo, string $modul, string $doz, string $notice, array $lession)
    {
        $this->id = $id;
        $this->weekNo = $weekNo;
        $this->modul = $modul;
        $this->doz = $doz;
        $this->notice = $notice;
        $this->lession = $lession;
    }


    /**
     * Creates a new instance of the Week class and stores it in the database.
     *
     * @param int $weekNo The week number.
     * @param string $modul The module name.
     * @param string $doz The name of the lecturer.
     * @param string $notice The notice associated with the week.
     * @param array $lession An array of lession data.
     *
     * @return Week The newly created Week instance.
     *
     * @throws PDOException If the database connection fails.
     */
    public static function create(int $weekNo, string $modul, string $doz, string $notice, array $lession): Week
    {
        try {
            $dbh = Db::getConnection();
            $sql = "INSERT INTO calweek 
                    VALUES(NULL, :weekNo, :modul, :doz, :notice, :entry0, :entry1, :entry2, :entry3, :entry4, 
                    :entry5, :entry6, :entry7, :entry8, :entry9)";
            $sth = $dbh->prepare($sql); // $sth für PDOStatement (prepared Statement)
            $sth->bindParam('weekNo', $weekNo, PDO::PARAM_INT);
            $sth->bindParam('modul', $modul, PDO::PARAM_STR);
            $sth->bindParam('doz', $doz, PDO::PARAM_STR);
            $sth->bindParam('notice', $notice, PDO::PARAM_STR);
            $sth->bindParam('entry0', $lession[0], PDO::PARAM_STR);
            $sth->bindParam('entry1', $lession[1], PDO::PARAM_STR);
            $sth->bindParam('entry2', $lession[2], PDO::PARAM_STR);
            $sth->bindParam('entry3', $lession[3], PDO::PARAM_STR);
            $sth->bindParam('entry4', $lession[4], PDO::PARAM_STR);
            $sth->bindParam('entry5', $lession[5], PDO::PARAM_STR);
            $sth->bindParam('entry6', $lession[6], PDO::PARAM_STR);
            $sth->bindParam('entry7', $lession[7], PDO::PARAM_STR);
            $sth->bindParam('entry8', $lession[8], PDO::PARAM_STR);
            $sth->bindParam('entry9', $lession[9], PDO::PARAM_STR);

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
                $calWeeks[0] = Week::create($weekNo, '', '', '', ['', '', '', '', '', '', '', '', '', '', '']);
            }

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $calWeeks[0];
    }

    /**
     * Builds a Week object from the given parameters.
     *
     * @param int $id The ID of the week.
     * @param int $weekNo The week number.
     * @param string $modul The module name.
     * @param string $doz The name of the lecturer.
     * @param string $notice Any additional notice.
     * @param string $lession0 The first lesson.
     * @param string $lession1 The second lesson.
     * @param string $lession2 The third lesson.
     * @param string $lession3 The fourth lesson.
     * @param string $lession4 The fifth lesson.
     * @param string $lession5 The sixth lesson.
     * @param string $lession6 The seventh lesson.
     * @param string $lession7 The eighth lesson.
     * @param string $lession8 The ninth lesson.
     * @param string $lession9 The tenth lesson.
     * @return Week The constructed Week object.
     */
    public static function buildFromPDO(int $id, int $weekNo, string $modul, string $doz, string $notice,
        string $lession0,
        string $lession1,
        string $lession2,
        string $lession3,
        string $lession4,
        string $lession5,
        string $lession6,
        string $lession7,
        string $lession8,
        string $lession9
    ): Week
    {
        $lession = [
            $lession0,
            $lession1,
            $lession2,
            $lession3,
            $lession4,
            $lession5,
            $lession6,
            $lession7,
            $lession8,
            $lession9
        ];
        $w = new Week($id, $weekNo, $modul, $doz, $notice, $lession);
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
    public function getModul(): string
    {
        return $this->modul;
    }

    /**
     * @return string
     */
    public function getDoz(): string
    {
        return $this->doz;
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
    public function getLession(): array
    {
        return $this->lession;
    }

    public function save(): Week
    {

        $id = $this->getId();
        switch ($id) {
            // DS ist noch nicht in db enthalten
            case 0:
                $requestWeek = $this->create(
                    $this->getWeekNo(),
                    $this->getModul(),
                    $this->getDoz(),
                    $this->getNotice(),
                    $this->getLession()
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
            $sql = 'UPDATE calweek 
                    SET weekNo = :weekNo, 
                    modul = :modul, 
                    doz = :doz, 
                    notice = :notice,  
                    entry0 = :entry0, 
                    entry1 = :entry1, 
                    entry2 = :entry2, 
                    entry3 = :entry3, 
                    entry4 = :entry4, 
                    entry5 = :entry5, 
                    entry6 = :entry6, 
                    entry7 = :entry7, 
                    entry8 = :entry8, 
                    entry9 = :entry9 
                    WHERE id = :id';
            $sth = $dbh->prepare($sql); // $sth für PDOStatement (prepared Statement)
            $sth->bindParam('weekNo', $this->weekNo, PDO::PARAM_INT);
            $sth->bindParam('modul', $this->modul, PDO::PARAM_STR);
            $sth->bindParam('doz', $this->doz, PDO::PARAM_STR);
            $sth->bindParam('notice', $this->notice, PDO::PARAM_STR);
            $sth->bindParam('entry0', $this->lession[0], PDO::PARAM_STR);
            $sth->bindParam('entry1', $this->getLession()[1], PDO::PARAM_STR);
            $sth->bindParam('entry2', $this->getLession()[2], PDO::PARAM_STR);
            $sth->bindParam('entry3', $this->getLession()[3], PDO::PARAM_STR);
            $sth->bindParam('entry4', $this->getLession()[4], PDO::PARAM_STR);
            $sth->bindParam('entry5', $this->getLession()[5], PDO::PARAM_STR);
            $sth->bindParam('entry6', $this->getLession()[6], PDO::PARAM_STR);
            $sth->bindParam('entry7', $this->getLession()[7], PDO::PARAM_STR);
            $sth->bindParam('entry8', $this->getLession()[8], PDO::PARAM_STR);
            $sth->bindParam('entry9', $this->getLession()[9], PDO::PARAM_STR);
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
            $sql = 'SELECT * FROM calweek WHERE id = 
                            (SELECT MAX(id) FROM calweek)
                        ';
            $sth = $dbh->prepare($sql); // $sth für PDOStatement
            $sth->execute();
            $calWeeks = $sth->fetchAll(PDO::FETCH_FUNC, 'week::buildFromPDO');

            // wenn es noch keine Daten in der db gibt, werden sie erstellt & gespeichert
            if (count($calWeeks) === 0) {
                // Falls es noch gar keine Woche in db gibt
                $weekNo = $weekNo ?? 1;
                // leere Woche in db erstellen
                $calWeeks[0] = Week::create($weekNo, '', '', '', ['', '', '', '', '', '', '', '', '', '', '']);
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