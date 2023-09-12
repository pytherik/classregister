<?php

class Lesson
{

    /**
     * @var int
     * PK
     */
    private int $id;
    /**
     * @var int
     * FK
     */
    private int $calWeekId;
    private Weekday $weekday;
    /**
     * @var string
     * maxLength 65
     */
    private string $amContent;
    /**
     * @var string
     * maxlength 65
     */
    private string $pmContent;

    /**
     * @param int $id
     * @param int $calWeekId
     * @param Weekday $weekday
     * @param string $amContent
     * @param string $pmContent
     */
    public function __construct(int $id, int $calWeekId, Weekday $weekday, string $amContent, string $pmContent)
    {
        $this->id = $id;
        $this->calWeekId = $calWeekId;
        $this->weekday = $weekday;
        $this->amContent = $amContent;
        $this->pmContent = $pmContent;
    }

    /**
     * @param int $calWeekId
     * @return Lesson[]
     */
    public function getLessonsByCalWeekId(int $calWeekId): array{

        $dbh = Db::getConnection();
        $sql = "SELECT * FROM lesson WHERE calWeekId=:calWeekId";
        $sth = $dbh->prepare($sql);
        $sth->bindParam('calWeekId', $calWeekId, PDO::PARAM_INT );
        $sth->execute();
        return $sth->fetchAll(__CLASS__);
    }

//    public function createLessons(int $calWeekId, string ): Lesson{
//        $dbh = Db::getConnection();
//        $sql = "INSERT INTO lesson VALUES "
//    }

}