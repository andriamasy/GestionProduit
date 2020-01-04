<?php


namespace App\Factory;


class StatisticFactory
{
    public static function formaterDataChart($params)
    {
        $aWeek = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
        $aData = [0,0,0,0,0,0,0];

        foreach ($params as $data) {
            $isCurrentWeek = self::getCurrentWeek($data['date']);
            if($isCurrentWeek) {
                $key = array_search($data['day'], $aWeek);
                if($aData[$key] != 0) {
                    $aData[$key] = $aData[$key] + $data['nbr'];
                } else {
                    $aData[$key] = $data['nbr'];
                }

            }
        }
        return $aData;
    }

    public static function getCurrentWeek($date)
    {
        $bReturn = false;
        $monday = date( 'Y-m-d', strtotime( 'monday this week' ) );
        $sunday = date( 'Y-m-d', strtotime( 'sunday this week' ) );
        $oMonday = date_create($monday);
        $oSunday = date_create($sunday);
        $oDate = date_create($date);
        if($oMonday <= $oDate and  $oSunday >= $oDate) {
            $bReturn = true;
        }
        return $bReturn;
    }

    public static function getPercentProductLastWeek($_param)
    {
        $aData = $_param;
        $iProductLastWeek = 0;
        $iProductLastTwoWeek = 0;
        foreach ($aData as $data) {
            if(self::getLastWeek($data['date'])) {
                $iProductLastWeek += $data['nbr'];
            }
            if (self::getLastTwoWeek($data['date'])) {
                $iProductLastTwoWeek += $data['nbr'];
            }

        }
        $percentLastWeek = (100 * $iProductLastWeek ) / 300;
        $percentLastTwoWeek = (100 * $iProductLastTwoWeek) / 300;
        $percentLastWeek = number_format((float)$percentLastWeek, 2, '.', '');
        $percentLastTwoWeek = number_format((float)$percentLastTwoWeek, 2, '.', '');
        $percentTotal = $percentLastWeek - $percentLastTwoWeek;
        return [
            'percentTotal' => $percentTotal,
            'percentLastTwoWeek' => $percentLastTwoWeek
        ];
    }

    public static function getLastWeek($date)
    {
        $bReturn = false;
        $monday = date( 'Y-m-d', strtotime( 'monday previous week' ) );
        $sunday = date( 'Y-m-d', strtotime( 'sunday previous week' ) );
        $oMonday = date_create($monday);
        $oSunday = date_create($sunday);
        $oDate = date_create($date);
        if($oMonday <= $oDate and  $oSunday >= $oDate) {
            $bReturn = true;
        }
        return $bReturn;
    }

    public static function getLastTwoWeek($date)
    {
        $bReturn = false;
        $mondayLast = date( 'Y-m-d', strtotime( 'monday previous week' ) );
        $time = strtotime(date("Y-m-d", strtotime($mondayLast)) . " -7 day");
        $mondayLastTwoWeek = date('Y-m-d',$time);

        $sundayLast = date( 'Y-m-d', strtotime( 'sunday previous week' ) );
        $time = strtotime(date("Y-m-d", strtotime($sundayLast)) . " -7 day");
        $sundayLastTwoWeek = date('Y-m-d',$time);

        $oMonday = date_create($mondayLastTwoWeek);
        $oSunday = date_create($sundayLastTwoWeek);
        $oDate = date_create($date);
        if($oMonday <= $oDate and  $oSunday >= $oDate) {
            $bReturn = true;
        }
        return $bReturn;
    }

}
