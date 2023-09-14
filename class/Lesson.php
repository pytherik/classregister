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
    private string $weekday;
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

    public function getId(): int
    {
        return $this->id;
    }

    public function getWeekday(): string
    {
        return $this->weekday;
    }

    public function getAmContent(): string
    {
        return $this->amContent;
    }

    public function getPmContent(): string
    {
        return $this->pmContent;
    }

    public function getCalweekId(): ?int
    {
        return $this->calweekId;
    }



    /**
     * @param int|null $id
     * @param int|null $calweekId
     * @param string|null $weekday
     * @param string|null $amContent
     * @param string|null $pmContent
     */
    public function __construct(int    $id = null, int $calweekId = null, string $weekday = null,
                                string $amContent = null, string $pmContent = null)
    {
        if ($id === null) {

        } else {
            $this->id = $id;
            $this->calweekId = $calweekId;
            $this->weekday = $weekday;
            $this->amContent = $amContent;
            $this->pmContent = $pmContent;
        }
    }


    /**
     * @param int $calWeekId
     * @return Lesson[]
     */
    public function getLessonsByCalWeekId(int $calWeekId): array
    {

        $dbh = Db::getConnection();
        $sql = "SELECT * FROM lesson WHERE calWeekId=:calWeekId";
        $sth = $dbh->prepare($sql);
        $sth->bindParam('calWeekId', $calWeekId, PDO::PARAM_INT);
        $sth->execute();
        $dummy = $sth;
        return $sth->fetchAll(PDO::FETCH_CLASS,'Lesson');
    }

    public function createLessons(int $calWeekId,
                                  string $amContent1, string  $pmContent1,
                                  string $amContent2, string  $pmContent2,
                                  string $amContent3, string  $pmContent3,
                                  string $amContent4, string  $pmContent4,
                                  string $amContent5, string  $pmContent5
    ): void
    {
        $dbh = Db::getConnection();
        $sql = "INSERT INTO lesson VALUES (NULL, :calWeekId, :weekday, :amContent, :pmContent)";
        $sth = $dbh->prepare($sql);
        $weekday = 'montag';
        $sth->bindParam('calWeekId', $calWeekId, PDO::PARAM_INT);
        $sth->bindParam('weekday', $weekday, PDO::PARAM_STR);
        $sth->bindParam('amContent', $amContent1, PDO::PARAM_STR);
        $sth->bindParam('pmContent', $pmContent1, PDO::PARAM_STR);
        $sth->execute();

        $weekday = 'dienstag';
        //$sth->bindParam('calWeekId', $calWeekId, PDO::PARAM_INT);
        $sth->bindParam('weekday', $weekday, PDO::PARAM_STR);
        $sth->bindParam('amContent', $amContent2, PDO::PARAM_STR);
        $sth->bindParam('pmContent', $pmContent2, PDO::PARAM_STR);
        $sth->execute();

        $weekday = 'mittwoch';
        $sth->bindParam('calWeekId', $calWeekId, PDO::PARAM_INT);
        $sth->bindParam('weekday', $weekday, PDO::PARAM_STR);
        $sth->bindParam('amContent', $amContent3, PDO::PARAM_STR);
        $sth->bindParam('pmContent', $pmContent3, PDO::PARAM_STR);
        $sth->execute();

        $weekday = 'donnerstag';
        //$sth->bindParam('calWeekId', $calWeekId, PDO::PARAM_INT);
        $sth->bindParam('weekday', $weekday, PDO::PARAM_STR);
        $sth->bindParam('amContent', $amContent4, PDO::PARAM_STR);
        $sth->bindParam('pmContent', $pmContent4, PDO::PARAM_STR);
        $sth->execute();

        $weekday = 'freitag';
        //$sth->bindParam('calWeekId', $calWeekId, PDO::PARAM_INT);
        $sth->bindParam('weekday', $weekday, PDO::PARAM_STR);
        $sth->bindParam('amContent', $amContent5, PDO::PARAM_STR);
        $sth->bindParam('pmContent', $pmContent5, PDO::PARAM_STR);
        $sth->execute();
    }
    public function update(int $calWeekId,
                                  string $amContent1, string  $pmContent1,
                                  string $amContent2, string  $pmContent2,
                                  string $amContent3, string  $pmContent3,
                                  string $amContent4, string  $pmContent4,
                                  string $amContent5, string  $pmContent5) : void
    {
        $dbh = Db::getConnection();
        $sql = "UPDATE lesson SET amContent= :amContent, " .
                  "pmContent= :pmContent " .
                  "WHERE calweekId=:calweekId AND weekday=:weekday";
        $sth = $dbh->prepare($sql);
        $sth->bindParam('calweekId', $calWeekId, PDO::PARAM_INT);

        $weekday = 'montag';
        $sth->bindParam('weekday', $weekday, PDO::PARAM_STR);
        $sth->bindParam('amContent', $amContent1, PDO::PARAM_STR);
        $sth->bindParam('pmContent', $pmContent1, PDO::PARAM_STR);
        $sth->execute();

        $weekday = 'dienstag';
        $sth->bindParam('weekday', $weekday, PDO::PARAM_STR);
        $sth->bindParam('amContent', $amContent2, PDO::PARAM_STR);
        $sth->bindParam('pmContent', $pmContent2, PDO::PARAM_STR);
        $sth->execute();

        $weekday = 'mittwoch';
        $sth->bindParam('weekday', $weekday, PDO::PARAM_STR);
        $sth->bindParam('amContent', $amContent3, PDO::PARAM_STR);
        $sth->bindParam('pmContent', $pmContent3, PDO::PARAM_STR);
        $sth->execute();

        $weekday = 'donnerstag';
        $sth->bindParam('weekday', $weekday, PDO::PARAM_STR);
        $sth->bindParam('amContent', $amContent4, PDO::PARAM_STR);
        $sth->bindParam('pmContent', $pmContent4, PDO::PARAM_STR);
        $sth->execute();

        $weekday = 'freitag';
        $sth->bindParam('weekday', $weekday, PDO::PARAM_STR);
        $sth->bindParam('amContent', $amContent5, PDO::PARAM_STR);
        $sth->bindParam('pmContent', $pmContent5, PDO::PARAM_STR);
        $sth->execute();
    }

}