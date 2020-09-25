<?php


class Week
{
    // PK
    private int $id;
    // Woche
    private int $weekNo;
    // Thema
    private $modul;
    // Dozent
    private string $doz;
    // Bemerkung
    private string $notice;
    // 10 string Einträge
    private $entrys = [];

    /**
     * week constructor.
     * @param int $id
     * @param int $weekNo
     * @param $modul
     * @param string $doz
     * @param string $notice
     * @param array $entrys
     */
    public function __construct(int $id, int $weekNo, string $modul, string $doz, string $notice, array $entrys)
    {
        $this->id = $id;
        $this->weekNo = $weekNo;
        $this->modul = $modul;
        $this->doz = $doz;
        $this->notice = $notice;
        $this->entrys = $entrys;
    }

    /**
     * week creater
     * @param int $weekNo
     * @param $modul
     * @param string $doz
     * @param string $notice
     * @param array $entrys
     */
    public function create(int $weekNo, $modul, string $doz, string $notice, array $entrys): Week
    {
        //$this->id = $id;
//        $this->weekNo = $weekNo;
//        $this->modul = $modul;
//        $this->doz = $doz;
//        $this->notice = $notice;
//        $this->entrys = $entrys;
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
            $sth->bindParam('entry0', $entrys[0], PDO::PARAM_STR);
            $sth->bindParam('entry1', $entrys[1], PDO::PARAM_STR);
            $sth->bindParam('entry2', $entrys[2], PDO::PARAM_STR);
            $sth->bindParam('entry3', $entrys[3], PDO::PARAM_STR);
            $sth->bindParam('entry4', $entrys[4], PDO::PARAM_STR);
            $sth->bindParam('entry5', $entrys[5], PDO::PARAM_STR);
            $sth->bindParam('entry6', $entrys[6], PDO::PARAM_STR);
            $sth->bindParam('entry7', $entrys[7], PDO::PARAM_STR);
            $sth->bindParam('entry8', $entrys[8], PDO::PARAM_STR);
            $sth->bindParam('entry9', $entrys[9], PDO::PARAM_STR);

            $sth->execute();
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
//            else {
//                // letzte Eintragswoche ausgeben
//                $sql = 'SELECT * FROM calweek WHERE id =
//                            (SELECT MAX(id) FROM calwwek)
//                        ';
//                $sth = $dbh->prepare($sql); // $sth für PDOStatement
//            }
            $sth->execute();
            $calWeeks = $sth->fetchAll(PDO::FETCH_FUNC, 'week::buildFromPDO');
            // wenn es noch keine Daten in der db gibt, werden sie erstellt & gespeichert
            if (count($calWeeks) === 0) {
                // Falls es noch gar keine Woche in db gibt
                //$weekNo = $weekNo ?? 19;
                // leere Woche in db erstellen

                $calWeeks[0] = Week::create($weekNo, '', '', '', ['', '', '', '', '', '', '', '', '', '', '']);
            }

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $calWeeks[0];
    }

    public static function buildFromPDO(int $id, int $weekNo, string $modul, string $doz, string $notice,
                                        string $entry0, string $entry1, string $entry2, string $entry3,
                                        string $entry4, string $entry5, string $entry6, string $entry7,
                                        string $entry8, string $entry9)
    {
        $entrys = [$entry0, $entry1, $entry2, $entry3, $entry4, $entry5, $entry6, $entry7, $entry8, $entry9];
        $w = new Week($id, $weekNo, $modul, $doz, $notice, $entrys);
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
     * @return mixed
     */
    public function getModul()
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
     * @return array
     */
    public function getEntrys(): array
    {
        return $this->entrys;
    }

    public function save(): Week
    {

        $id = $this->getId();
        switch ($id) {
            // DS ist noch nicht in db enthalten
            case 0:
                echo 'case 0';
                $requestWeek = $this->create($this->getWeekNo, $this->getModul, $this->getDoz, $this->getNotice, $this->getEntrys);
                break;
            // DS wurde geändert
            default:
                echo 'default';
                $this->update();
                $requestWeek = $this;
        }
        return $requestWeek;
    }

    private function update(): void
    {
        echo "190 {$this->modul}";
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
            $sth->bindParam('entry0', $this->entrys[0], PDO::PARAM_STR);
            $sth->bindParam('entry1', $this->getEntrys()[1], PDO::PARAM_STR);
            $sth->bindParam('entry2', $this->getEntrys()[2], PDO::PARAM_STR);
            $sth->bindParam('entry3', $this->getEntrys()[3], PDO::PARAM_STR);
            $sth->bindParam('entry4', $this->getEntrys()[4], PDO::PARAM_STR);
            $sth->bindParam('entry5', $this->getEntrys()[5], PDO::PARAM_STR);
            $sth->bindParam('entry6', $this->getEntrys()[6], PDO::PARAM_STR);
            $sth->bindParam('entry7', $this->getEntrys()[7], PDO::PARAM_STR);
            $sth->bindParam('entry8', $this->getEntrys()[8], PDO::PARAM_STR);
            $sth->bindParam('entry9', $this->getEntrys()[9], PDO::PARAM_STR);
            $sth->bindParam('id', $this->id, PDO::PARAM_INT);

            echo $this->modul . '227 ' . $sth->execute();
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }

    public function getLastOrStandardWeek(Week $postWeek): Week
    {
        try {
            $dbh = Db::getConnection();
            // letzte Eintragswoche ausgeben
            $sql = 'SELECT * FROM calweek WHERE id = 
                            (SELECT MAX(id) FROM calweek)
                        ';
            echo $sql;
            $sth = $dbh->prepare($sql); // $sth für PDOStatement
            $sth->execute();
            $calWeeks = $sth->fetchAll(PDO::FETCH_FUNC, 'week::buildFromPDO');

            // wenn es noch keine Daten in der db gibt, werden sie erstellt & gespeichert
            if (count($calWeeks) === 0) {

                // Falls es noch gar keine Woche in db gibt
                $weekNo = $weekNo ?? 19;
                // leere Woche in db erstellen

                $calWeeks[0] = Week::create($weekNo, '', '', '', ['', '', '', '', '', '', '', '', '', '', '']);
            }

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $calWeeks[0];
    }

    public function getNextWeek(Week $postWeek): Week
    {
        if ($postWeek->getWeekNo() < MAXWEEKNO){
            $weekNo = $this->weekNo + 1;
        }
        return Week::getByWeekNo($weekNo);
    }
    public function getPreviousWeek(Week $postWeek): Week
    {
        if ($postWeek->getWeekNo() > MINWEEKNO){
            $weekNo = $this->weekNo - 1;
        }
        return Week::getByWeekNo($weekNo);
    }
}