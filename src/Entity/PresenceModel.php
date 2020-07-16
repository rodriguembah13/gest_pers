<?php

namespace App\Entity;

class PresenceModel
{
    private $employe;
    private $day;
    private $month;
    private $status;
    private $status1;
    private $status2;
    private $status3;
    private $status4;
    private $status5;
    private $status6;
    private $status7;
    private $status8;
    private $status9;
    private $status10;
    private $status11;
    private $status12;
    private $status13;
    private $status14;
    private $status15;
    private $status16;
    private $status17;
    private $status18;
    private $status19;
    private $status20;
    private $status21;
    private $status22;
    private $status23;
    private $status24;
    private $status25;
    private $status26;
    private $status27;
    private $status28;
    private $status29;
    private $status30;
    private $status31;
    private $year;
    private $day1;
    private $day2;
    private $day3;
    private $day4;
    private $day5;
    private $day6;
    private $day7;
    private $day8;
    private $day9;
    private $day10;
    private $day11;
    private $day12;
    private $day13;
    private $day14;
    private $day15;
    private $day16;
    private $day17;
    private $day18;
    private $day19;
    private $day20;
    private $day21;
    private $day22;
    private $day23;
    private $day24;
    private $day25;
    private $day26;
    private $day27;
    private $day28;
    private $day29;
    private $day30;
    private $day31;
    private $color;
    private $color1;
    private $color2;
    private $color3;
    private $color4;
    private $color5;
    private $color6;
    private $color7;
    private $color8;
    private $color9;
    private $color10;
    private $color11;
    private $color12;
    private $color13;
    private $color14;
    private $color15;
    private $color16;
    private $color17;
    private $color18;
    private $color19;
    private $color20;
    private $color21;
    private $color22;
    private $color23;
    private $color24;
    private $color25;
    private $color26;
    private $color27;
    private $color28;
    private $color29;
    private $color30;
    private $color31;

    /**
     * @return mixed
     */
    public function getEmploye()
    {
        return $this->employe;
    }

    /**
     * @param mixed $employe
     */
    public function setEmploye(?Employe $employe): self
    {
        $this->employe = $employe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDay(): ?int
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay(?int $day): self
    {
        $this->day = $day;
        switch ($day) {
            case 1:
                $this->setDay1($this->day);
                $this->setStatus1($this->getStatus());
                $this->setColor1($this->getColor());
                break;
            case 2:
                $this->setDay2($this->day);
                $this->setStatus2($this->getStatus());
                $this->setColor2($this->getColor());
                break;
            case 3:
                $this->setDay3($this->day);
                $this->setStatus3($this->getStatus());
                $this->setColor3($this->getColor());
                break;
            case 4:
                $this->setDay4($this->day);
                $this->setStatus4($this->getStatus());
                $this->setColor4($this->getColor());
                break;
            case 5:
                $this->setDay5($this->day);
                $this->setStatus5($this->getStatus());
                $this->setColor5($this->getColor());
                break;
            case 6:
                $this->setDay6($this->day);
                $this->setStatus6($this->getStatus());
                $this->setColor6($this->getColor());
                break;
            case 7:
                $this->setDay7($this->day);
                $this->setStatus7($this->getStatus());
                $this->setColor7($this->getColor());
                break;
            case 8:
                $this->setDay8($this->day);
                $this->setStatus8($this->getStatus());
                $this->setColor8($this->getColor());
                break;
            case 9:
                $this->setDay9($this->day);
                $this->setStatus9($this->getStatus());
                $this->setColor9($this->getColor());
                break;
            case 10:
                $this->setDay10($this->day);
                $this->setStatus10($this->getStatus());
                $this->setColor10($this->getColor());
                break;
            case 11:
                $this->setDay11($this->day);
                $this->setStatus11($this->getStatus());
                $this->setColor11($this->getColor());
                break;
            case 12:
                $this->setDay12($this->day);
                $this->setStatus12($this->getStatus());
                $this->setColor12($this->getColor());
                break;
            case 13:
                $this->setDay13($this->day);
                $this->setStatus13($this->getStatus());
                $this->setColor13($this->getColor());
                break;
            case 14:
                $this->setDay14($this->day);
                $this->setStatus14($this->getStatus());
                $this->setColor14($this->getColor());
                break;
            case 15:
                $this->setDay15($this->day);
                $this->setStatus15($this->getStatus());
                $this->setColor15($this->getColor());
                break;
            case 16:
                $this->setDay16($this->day);
                $this->setStatus16($this->getStatus());
                $this->setColor16($this->getColor());
                break;
            case 17:
                $this->setDay17($this->day);
                $this->setStatus17($this->getStatus());
                $this->setColor17($this->getColor());
                break;
            case 18:
                $this->setDay18($this->day);
                $this->setStatus18($this->getStatus());
                $this->setColor18($this->getColor());
                break;
            case 19:
                $this->setDay19($this->day);
                $this->setStatus19($this->getStatus());
                $this->setColor19($this->getColor());
                break;
            case 20:
                $this->setDay20($this->day);
                $this->setStatus20($this->getStatus());
                $this->setColor20($this->getColor());
                break;
            case 21:
                $this->setDay21($this->day);
                $this->setStatus21($this->getStatus());
                $this->setColor21($this->getColor());
                break;
            case 22:
                $this->setDay22($this->day);
                $this->setStatus22($this->getStatus());
                $this->setColor22($this->getColor());
                break;
            case 23:
                $this->setDay23($this->day);
                $this->setStatus23($this->getStatus());
                $this->setColor23($this->getColor());
                break;
            case 24:
                $this->setDay24($this->day);
                $this->setStatus24($this->getStatus());
                $this->setColor24($this->getColor());
                break;
            case 25:
                $this->setDay25($this->day);
                $this->setStatus25($this->getStatus());
                $this->setColor25($this->getColor());
                break;
            case 26:
                $this->setDay26($this->day);
                $this->setStatus26($this->getStatus());
                $this->setColor26($this->getColor());
                break;
            case 27:
                $this->setDay27($this->day);
                $this->setStatus27($this->getStatus());
                $this->setColor27($this->getColor());
                break;
            case 28:
                $this->setDay28($this->day);
                $this->setStatus28($this->getStatus());
                $this->setColor28($this->getColor());
                break;
            case 29:
                $this->setDay29($this->day);
                $this->setStatus29($this->getStatus());
                $this->setColor29($this->getColor());
                break;
            case 30:
                $this->setDay30($this->day);
                $this->setStatus30($this->getStatus());
                $this->setColor30($this->getColor());
                break;
            case 31:
                $this->setDay31($this->day);
                $this->setStatus31($this->getStatus());
                $this->setColor31($this->getColor());
                break;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMonth(): ?int
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     */
    public function setMonth(?int $month): self
    {
        $this->month = $month;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDay1()
    {
        return $this->day1;
    }

    /**
     * @param mixed $day1
     */
    public function setDay1($day1): void
    {
        $this->day1 = $day1;
    }

    /**
     * @return mixed
     */
    public function getDay2()
    {
        return $this->day2;
    }

    /**
     * @param mixed $day2
     */
    public function setDay2($day2): void
    {
        $this->day2 = $day2;
    }

    /**
     * @return mixed
     */
    public function getDay3()
    {
        return $this->day3;
    }

    /**
     * @param mixed $day3
     */
    public function setDay3($day3): void
    {
        $this->day3 = $day3;
    }

    /**
     * @return mixed
     */
    public function getDay4()
    {
        return $this->day4;
    }

    /**
     * @param mixed $day4
     */
    public function setDay4($day4): void
    {
        $this->day4 = $day4;
    }

    /**
     * @return mixed
     */
    public function getDay5()
    {
        return $this->day5;
    }

    /**
     * @param mixed $day5
     */
    public function setDay5($day5): void
    {
        $this->day5 = $day5;
    }

    /**
     * @return mixed
     */
    public function getDay6()
    {
        return $this->day6;
    }

    /**
     * @param mixed $day6
     */
    public function setDay6($day6): void
    {
        $this->day6 = $day6;
    }

    /**
     * @return mixed
     */
    public function getDay7()
    {
        return $this->day7;
    }

    /**
     * @param mixed $day7
     */
    public function setDay7($day7): void
    {
        $this->day7 = $day7;
    }

    /**
     * @return mixed
     */
    public function getDay8()
    {
        return $this->day8;
    }

    /**
     * @param mixed $day8
     */
    public function setDay8($day8): void
    {
        $this->day8 = $day8;
    }

    /**
     * @return mixed
     */
    public function getDay9()
    {
        return $this->day9;
    }

    /**
     * @param mixed $day9
     */
    public function setDay9($day9): void
    {
        $this->day9 = $day9;
    }

    /**
     * @return mixed
     */
    public function getDay10()
    {
        return $this->day10;
    }

    /**
     * @param mixed $day10
     */
    public function setDay10($day10): void
    {
        $this->day10 = $day10;
    }

    /**
     * @return mixed
     */
    public function getDay11()
    {
        return $this->day11;
    }

    /**
     * @param mixed $day11
     */
    public function setDay11($day11): void
    {
        $this->day11 = $day11;
    }

    /**
     * @return mixed
     */
    public function getDay12()
    {
        return $this->day12;
    }

    /**
     * @param mixed $day12
     */
    public function setDay12($day12): void
    {
        $this->day12 = $day12;
    }

    /**
     * @return mixed
     */
    public function getDay13()
    {
        return $this->day13;
    }

    /**
     * @param mixed $day13
     */
    public function setDay13($day13): void
    {
        $this->day13 = $day13;
    }

    /**
     * @return mixed
     */
    public function getDay14()
    {
        return $this->day14;
    }

    /**
     * @param mixed $day14
     */
    public function setDay14($day14): void
    {
        $this->day14 = $day14;
    }

    /**
     * @return mixed
     */
    public function getDay15()
    {
        return $this->day15;
    }

    /**
     * @param mixed $day15
     */
    public function setDay15($day15): void
    {
        $this->day15 = $day15;
    }

    /**
     * @return mixed
     */
    public function getDay16()
    {
        return $this->day16;
    }

    /**
     * @param mixed $day16
     */
    public function setDay16($day16): void
    {
        $this->day16 = $day16;
    }

    /**
     * @return mixed
     */
    public function getDay17()
    {
        return $this->day17;
    }

    /**
     * @param mixed $day17
     */
    public function setDay17($day17): void
    {
        $this->day17 = $day17;
    }

    /**
     * @return mixed
     */
    public function getDay18()
    {
        return $this->day18;
    }

    /**
     * @param mixed $day18
     */
    public function setDay18($day18): void
    {
        $this->day18 = $day18;
    }

    /**
     * @return mixed
     */
    public function getDay19()
    {
        return $this->day19;
    }

    /**
     * @param mixed $day19
     */
    public function setDay19($day19): void
    {
        $this->day19 = $day19;
    }

    /**
     * @return mixed
     */
    public function getDay20()
    {
        return $this->day20;
    }

    /**
     * @param mixed $day20
     */
    public function setDay20($day20): void
    {
        $this->day20 = $day20;
    }

    /**
     * @return mixed
     */
    public function getDay21()
    {
        return $this->day21;
    }

    /**
     * @param mixed $day21
     */
    public function setDay21($day21): void
    {
        $this->day21 = $day21;
    }

    /**
     * @return mixed
     */
    public function getDay22()
    {
        return $this->day22;
    }

    /**
     * @param mixed $day22
     */
    public function setDay22($day22): void
    {
        $this->day22 = $day22;
    }

    /**
     * @return mixed
     */
    public function getDay23()
    {
        return $this->day23;
    }

    /**
     * @param mixed $day23
     */
    public function setDay23($day23): void
    {
        $this->day23 = $day23;
    }

    /**
     * @return mixed
     */
    public function getDay24()
    {
        return $this->day24;
    }

    /**
     * @param mixed $day24
     */
    public function setDay24($day24): void
    {
        $this->day24 = $day24;
    }

    /**
     * @return mixed
     */
    public function getDay25()
    {
        return $this->day25;
    }

    /**
     * @param mixed $day25
     */
    public function setDay25($day25): void
    {
        $this->day25 = $day25;
    }

    /**
     * @return mixed
     */
    public function getDay26()
    {
        return $this->day26;
    }

    /**
     * @param mixed $day26
     */
    public function setDay26($day26): void
    {
        $this->day26 = $day26;
    }

    /**
     * @return mixed
     */
    public function getDay27()
    {
        return $this->day27;
    }

    /**
     * @param mixed $day27
     */
    public function setDay27($day27): void
    {
        $this->day27 = $day27;
    }

    /**
     * @return mixed
     */
    public function getDay28()
    {
        return $this->day28;
    }

    /**
     * @param mixed $day28
     */
    public function setDay28($day28): void
    {
        $this->day28 = $day28;
    }

    /**
     * @return mixed
     */
    public function getDay29()
    {
        return $this->day29;
    }

    /**
     * @param mixed $day29
     */
    public function setDay29($day29): void
    {
        $this->day29 = $day29;
    }

    /**
     * @return mixed
     */
    public function getDay30()
    {
        return $this->day30;
    }

    /**
     * @param mixed $day30
     */
    public function setDay30($day30): void
    {
        $this->day30 = $day30;
    }

    /**
     * @return mixed
     */
    public function getDay31()
    {
        return $this->day31;
    }

    /**
     * @param mixed $day31
     */
    public function setDay31($day31): void
    {
        $this->day31 = $day31;
    }

    /**
     * @return mixed
     */
    public function getStatus1()
    {
        return $this->status1;
    }

    /**
     * @param mixed $status1
     */
    public function setStatus1($status1): void
    {
        $this->status1 = $status1;
    }

    /**
     * @return mixed
     */
    public function getStatus2()
    {
        return $this->status2;
    }

    /**
     * @param mixed $status2
     */
    public function setStatus2($status2): void
    {
        $this->status2 = $status2;
    }

    /**
     * @return mixed
     */
    public function getStatus3()
    {
        return $this->status3;
    }

    /**
     * @param mixed $status3
     */
    public function setStatus3($status3): void
    {
        $this->status3 = $status3;
    }

    /**
     * @return mixed
     */
    public function getStatus4()
    {
        return $this->status4;
    }

    /**
     * @param mixed $status4
     */
    public function setStatus4($status4): void
    {
        $this->status4 = $status4;
    }

    /**
     * @return mixed
     */
    public function getStatus5()
    {
        return $this->status5;
    }

    /**
     * @param mixed $status5
     */
    public function setStatus5($status5): void
    {
        $this->status5 = $status5;
    }

    /**
     * @return mixed
     */
    public function getStatus6()
    {
        return $this->status6;
    }

    /**
     * @param mixed $status6
     */
    public function setStatus6($status6): void
    {
        $this->status6 = $status6;
    }

    /**
     * @return mixed
     */
    public function getStatus7()
    {
        return $this->status7;
    }

    /**
     * @param mixed $status7
     */
    public function setStatus7($status7): void
    {
        $this->status7 = $status7;
    }

    /**
     * @return mixed
     */
    public function getStatus8()
    {
        return $this->status8;
    }

    /**
     * @param mixed $status8
     */
    public function setStatus8($status8): void
    {
        $this->status8 = $status8;
    }

    /**
     * @return mixed
     */
    public function getStatus9()
    {
        return $this->status9;
    }

    /**
     * @param mixed $status9
     */
    public function setStatus9($status9): void
    {
        $this->status9 = $status9;
    }

    /**
     * @return mixed
     */
    public function getStatus10()
    {
        return $this->status10;
    }

    /**
     * @param mixed $status10
     */
    public function setStatus10($status10): void
    {
        $this->status10 = $status10;
    }

    /**
     * @return mixed
     */
    public function getStatus11()
    {
        return $this->status11;
    }

    /**
     * @param mixed $status11
     */
    public function setStatus11($status11): void
    {
        $this->status11 = $status11;
    }

    /**
     * @return mixed
     */
    public function getStatus12()
    {
        return $this->status12;
    }

    /**
     * @param mixed $status12
     */
    public function setStatus12($status12): void
    {
        $this->status12 = $status12;
    }

    /**
     * @return mixed
     */
    public function getStatus13()
    {
        return $this->status13;
    }

    /**
     * @param mixed $status13
     */
    public function setStatus13($status13): void
    {
        $this->status13 = $status13;
    }

    /**
     * @return mixed
     */
    public function getStatus14()
    {
        return $this->status14;
    }

    /**
     * @param mixed $status14
     */
    public function setStatus14($status14): void
    {
        $this->status14 = $status14;
    }

    /**
     * @return mixed
     */
    public function getStatus15()
    {
        return $this->status15;
    }

    /**
     * @param mixed $status15
     */
    public function setStatus15($status15): void
    {
        $this->status15 = $status15;
    }

    /**
     * @return mixed
     */
    public function getStatus16()
    {
        return $this->status16;
    }

    /**
     * @param mixed $status16
     */
    public function setStatus16($status16): void
    {
        $this->status16 = $status16;
    }

    /**
     * @return mixed
     */
    public function getStatus17()
    {
        return $this->status17;
    }

    /**
     * @param mixed $status17
     */
    public function setStatus17($status17): void
    {
        $this->status17 = $status17;
    }

    /**
     * @return mixed
     */
    public function getStatus18()
    {
        return $this->status18;
    }

    /**
     * @param mixed $status18
     */
    public function setStatus18($status18): void
    {
        $this->status18 = $status18;
    }

    /**
     * @return mixed
     */
    public function getStatus19()
    {
        return $this->status19;
    }

    /**
     * @param mixed $status19
     */
    public function setStatus19($status19): void
    {
        $this->status19 = $status19;
    }

    /**
     * @return mixed
     */
    public function getStatus20()
    {
        return $this->status20;
    }

    /**
     * @param mixed $status20
     */
    public function setStatus20($status20): void
    {
        $this->status20 = $status20;
    }

    /**
     * @return mixed
     */
    public function getStatus21()
    {
        return $this->status21;
    }

    /**
     * @param mixed $status21
     */
    public function setStatus21($status21): void
    {
        $this->status21 = $status21;
    }

    /**
     * @return mixed
     */
    public function getStatus22()
    {
        return $this->status22;
    }

    /**
     * @param mixed $status22
     */
    public function setStatus22($status22): void
    {
        $this->status22 = $status22;
    }

    /**
     * @return mixed
     */
    public function getStatus23()
    {
        return $this->status23;
    }

    /**
     * @param mixed $status23
     */
    public function setStatus23($status23): void
    {
        $this->status23 = $status23;
    }

    /**
     * @return mixed
     */
    public function getStatus24()
    {
        return $this->status24;
    }

    /**
     * @param mixed $status24
     */
    public function setStatus24($status24): void
    {
        $this->status24 = $status24;
    }

    /**
     * @return mixed
     */
    public function getStatus25()
    {
        return $this->status25;
    }

    /**
     * @param mixed $status25
     */
    public function setStatus25($status25): void
    {
        $this->status25 = $status25;
    }

    /**
     * @return mixed
     */
    public function getStatus26()
    {
        return $this->status26;
    }

    /**
     * @param mixed $status26
     */
    public function setStatus26($status26): void
    {
        $this->status26 = $status26;
    }

    /**
     * @return mixed
     */
    public function getStatus27()
    {
        return $this->status27;
    }

    /**
     * @param mixed $status27
     */
    public function setStatus27($status27): void
    {
        $this->status27 = $status27;
    }

    /**
     * @return mixed
     */
    public function getStatus28()
    {
        return $this->status28;
    }

    /**
     * @param mixed $status28
     */
    public function setStatus28($status28): void
    {
        $this->status28 = $status28;
    }

    /**
     * @return mixed
     */
    public function getStatus29()
    {
        return $this->status29;
    }

    /**
     * @param mixed $status29
     */
    public function setStatus29($status29): void
    {
        $this->status29 = $status29;
    }

    /**
     * @return mixed
     */
    public function getStatus30()
    {
        return $this->status30;
    }

    /**
     * @param mixed $status30
     */
    public function setStatus30($status30): void
    {
        $this->status30 = $status30;
    }

    /**
     * @return mixed
     */
    public function getStatus31()
    {
        return $this->status31;
    }

    /**
     * @param mixed $status31
     */
    public function setStatus31($status31): void
    {
        $this->status31 = $status31;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getColor1()
    {
        return $this->color1;
    }

    /**
     * @param mixed $color1
     */
    public function setColor1($color1): void
    {
        $this->color1 = $color1;
    }

    /**
     * @return mixed
     */
    public function getColor2()
    {
        return $this->color2;
    }

    /**
     * @param mixed $color2
     */
    public function setColor2($color2): void
    {
        $this->color2 = $color2;
    }

    /**
     * @return mixed
     */
    public function getColor3()
    {
        return $this->color3;
    }

    /**
     * @param mixed $color3
     */
    public function setColor3($color3): void
    {
        $this->color3 = $color3;
    }

    /**
     * @return mixed
     */
    public function getColor4()
    {
        return $this->color4;
    }

    /**
     * @param mixed $color4
     */
    public function setColor4($color4): void
    {
        $this->color4 = $color4;
    }

    /**
     * @return mixed
     */
    public function getColor5()
    {
        return $this->color5;
    }

    /**
     * @param mixed $color5
     */
    public function setColor5($color5): void
    {
        $this->color5 = $color5;
    }

    /**
     * @return mixed
     */
    public function getColor6()
    {
        return $this->color6;
    }

    /**
     * @param mixed $color6
     */
    public function setColor6($color6): void
    {
        $this->color6 = $color6;
    }

    /**
     * @return mixed
     */
    public function getColor7()
    {
        return $this->color7;
    }

    /**
     * @param mixed $color7
     */
    public function setColor7($color7): void
    {
        $this->color7 = $color7;
    }

    /**
     * @return mixed
     */
    public function getColor8()
    {
        return $this->color8;
    }

    /**
     * @param mixed $color8
     */
    public function setColor8($color8): void
    {
        $this->color8 = $color8;
    }

    /**
     * @return mixed
     */
    public function getColor9()
    {
        return $this->color9;
    }

    /**
     * @param mixed $color9
     */
    public function setColor9($color9): void
    {
        $this->color9 = $color9;
    }

    /**
     * @return mixed
     */
    public function getColor10()
    {
        return $this->color10;
    }

    /**
     * @param mixed $color10
     */
    public function setColor10($color10): void
    {
        $this->color10 = $color10;
    }

    /**
     * @return mixed
     */
    public function getColor11()
    {
        return $this->color11;
    }

    /**
     * @param mixed $color11
     */
    public function setColor11($color11): void
    {
        $this->color11 = $color11;
    }

    /**
     * @return mixed
     */
    public function getColor12()
    {
        return $this->color12;
    }

    /**
     * @param mixed $color12
     */
    public function setColor12($color12): void
    {
        $this->color12 = $color12;
    }

    /**
     * @return mixed
     */
    public function getColor13()
    {
        return $this->color13;
    }

    /**
     * @param mixed $color13
     */
    public function setColor13($color13): void
    {
        $this->color13 = $color13;
    }

    /**
     * @return mixed
     */
    public function getColor14()
    {
        return $this->color14;
    }

    /**
     * @param mixed $color14
     */
    public function setColor14($color14): void
    {
        $this->color14 = $color14;
    }

    /**
     * @return mixed
     */
    public function getColor15()
    {
        return $this->color15;
    }

    /**
     * @param mixed $color15
     */
    public function setColor15($color15): void
    {
        $this->color15 = $color15;
    }

    /**
     * @return mixed
     */
    public function getColor16()
    {
        return $this->color16;
    }

    /**
     * @param mixed $color16
     */
    public function setColor16($color16): void
    {
        $this->color16 = $color16;
    }

    /**
     * @return mixed
     */
    public function getColor17()
    {
        return $this->color17;
    }

    /**
     * @param mixed $color17
     */
    public function setColor17($color17): void
    {
        $this->color17 = $color17;
    }

    /**
     * @return mixed
     */
    public function getColor18()
    {
        return $this->color18;
    }

    /**
     * @param mixed $color18
     */
    public function setColor18($color18): void
    {
        $this->color18 = $color18;
    }

    /**
     * @return mixed
     */
    public function getColor19()
    {
        return $this->color19;
    }

    /**
     * @param mixed $color19
     */
    public function setColor19($color19): void
    {
        $this->color19 = $color19;
    }

    /**
     * @return mixed
     */
    public function getColor20()
    {
        return $this->color20;
    }

    /**
     * @param mixed $color20
     */
    public function setColor20($color20): void
    {
        $this->color20 = $color20;
    }

    /**
     * @return mixed
     */
    public function getColor21()
    {
        return $this->color21;
    }

    /**
     * @param mixed $color21
     */
    public function setColor21($color21): void
    {
        $this->color21 = $color21;
    }

    /**
     * @return mixed
     */
    public function getColor22()
    {
        return $this->color22;
    }

    /**
     * @param mixed $color22
     */
    public function setColor22($color22): void
    {
        $this->color22 = $color22;
    }

    /**
     * @return mixed
     */
    public function getColor23()
    {
        return $this->color23;
    }

    /**
     * @param mixed $color23
     */
    public function setColor23($color23): void
    {
        $this->color23 = $color23;
    }

    /**
     * @return mixed
     */
    public function getColor24()
    {
        return $this->color24;
    }

    /**
     * @param mixed $color24
     */
    public function setColor24($color24): void
    {
        $this->color24 = $color24;
    }

    /**
     * @return mixed
     */
    public function getColor25()
    {
        return $this->color25;
    }

    /**
     * @param mixed $color25
     */
    public function setColor25($color25): void
    {
        $this->color25 = $color25;
    }

    /**
     * @return mixed
     */
    public function getColor26()
    {
        return $this->color26;
    }

    /**
     * @param mixed $color26
     */
    public function setColor26($color26): void
    {
        $this->color26 = $color26;
    }

    /**
     * @return mixed
     */
    public function getColor27()
    {
        return $this->color27;
    }

    /**
     * @param mixed $color27
     */
    public function setColor27($color27): void
    {
        $this->color27 = $color27;
    }

    /**
     * @return mixed
     */
    public function getColor28()
    {
        return $this->color28;
    }

    /**
     * @param mixed $color28
     */
    public function setColor28($color28): void
    {
        $this->color28 = $color28;
    }

    /**
     * @return mixed
     */
    public function getColor29()
    {
        return $this->color29;
    }

    /**
     * @param mixed $color29
     */
    public function setColor29($color29): void
    {
        $this->color29 = $color29;
    }

    /**
     * @return mixed
     */
    public function getColor30()
    {
        return $this->color30;
    }

    /**
     * @param mixed $color30
     */
    public function setColor30($color30): void
    {
        $this->color30 = $color30;
    }

    /**
     * @return mixed
     */
    public function getColor31()
    {
        return $this->color31;
    }

    /**
     * @param mixed $color31
     */
    public function setColor31($color31): void
    {
        $this->color31 = $color31;
    }

}
