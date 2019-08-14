<?php
/**
 * Created by PhpStorm.
 * User: pamperin
 * Date: 13.08.2019
 * Time: 16:21
 */

class Grades
{
    private $comment;
    private $grade;
    private $percent;
    private $date;
    private $studentID;
    private $classID;
    private $typeGrade;

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param mixed $grade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    /**
     * @return mixed
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param mixed $percent
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getStudentID()
    {
        return $this->studentID;
    }

    /**
     * @param mixed $studentID
     */
    public function setStudentID($studentID)
    {
        $this->studentID = $studentID;
    }

    /**
     * @return mixed
     */
    public function getClassID()
    {
        return $this->classID;
    }

    /**
     * @param mixed $classID
     */
    public function setClassID($classID)
    {
        $this->classID = $classID;
    }

    /**
     * @return mixed
     */
    public function getTypeGrade()
    {
        return $this->typeGrade;
    }

    /**
     * @param mixed $typeGrade
     */
    public function setTypeGrade($typeGrade)
    {
        $this->typeGrade = $typeGrade;
    }


}