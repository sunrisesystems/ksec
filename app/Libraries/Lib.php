<?php namespace cvmapp\Libraries;

use Config,DateTime,Route,PDF,File,DateInterval,DatePeriod;
use Illuminate\Support\Str;
use Lang,Sentinel;
use cvmapp\AclModule;
use Intervention\Image\ImageManagerStatic as Image;

Class Lib {

    /**
     * Print_r convenience function, which prints out <PRE> tags around
     * the output of given array. Similar to debug().
     *
     * @see debug()
     * @param array $var Variable to print out
     */
    public static function pr($var) {
        if (Config::get('app.debug')) {
            echo '<pre>';
            print_r($var);
            echo '</pre>';
        }
    }

    public static function trimInput($input)
    {
        $newInput = '';
        if(is_array($input)){
            if(!empty($input)){
                foreach ($input as $key => $value) {
                    $newInput[$key] = trim($value);
                }
            }
        }else{
            $newInput = trim($input);
        }
        return $newInput;

    }
    public static function currentController() {
        $routeArray = Str::parseCallback(Route::currentRouteAction(), null);

        if (last($routeArray) != null) {
            // Remove 'controller' from the controller name.
            $controller = str_replace('Controller', '', class_basename(head($routeArray)));

            return Str::slug($controller);
        }

        return 'closure';
    }

    public static function currentAction() {
        $routeArray = Str::parseCallback(Route::currentRouteAction(), null);

        if (last($routeArray) != null) {
            // Take out the method from the action.
            $action = str_replace(array('get', 'post', 'patch', 'put', 'delete'), '', last($routeArray));

            return Str::slug($action);
        }

        return 'closure';
    }

    /*
      @param : $string (string)
      Desc : encrypts the input string and returns the encrypted string.
     */

    public static function encrypt($string) {
        $len = strlen($string);
        for ($i = 0; $i < $len; $i++) {
            $string[$i] = chr((ord($string[$i]) + $len - $i));
        }
        for ($i = 0; $i < 3; $i++)
            $string .= chr(ord($string[$i]) + $len);

        return Lib::base64url_encode($string);
    }

    /*
      @param : $string (string)
      Desc : decrypts the input string and returns the decrypted string.
     */

    public static function decrypt($string) {
        $string = Lib::base64url_decode($string);
        $len    = strlen($string) - 3;
        $passwd = "";
        for ($i = 0; $i < $len; $i++) {
            $temp = ord($string[$i]) - ($len - $i);
            if ($temp < 0)
                $temp += 128;
            $passwd .= chr($temp);
        }
        return $passwd;
    }

    public static function base64url_encode($s) {
        return str_replace(array('+', '/'), array('-', '_'), base64_encode($s));
    }

    public static function base64url_decode($s) {
        return base64_decode(str_replace(array('-', '_'), array('+', '/'), $s));
    }

    /*
     * converts date with format_from to format_to
     * $format_from = date format of $date
     * $format_to =
     */

    public static function convertDateFormat($format_from, $date, $format_to = null) {
        if ($date == '')
            return '';
        //echo $format_from." ".$date."<br/>";
        if ($format_from == 'Y-m-d H:i:s' && !strpos($date, ':')) {
            return '';
            //$date = trim(substr($date,0,10));
            //$format_from = 'Y-m-d';
        }
        $date1 = DateTime::createFromFormat($format_from, $date);
        //var_dump($format_from, $date, $date1);
        if ($format_to == null)
            $date1 = $date1->getTimestamp();
        else
            $date1 = $date1->format($format_to);
        return $date1;
    }

    public static function uploadImage($imageObj, $productType, $id, $dimensionArray, $explicitName = null) {
       
        $IMAGE_ARR = Config::get('global_vars.IMAGE_MIME');
        $basePath  = Config::get('global_vars.IMAGE_PATH');
        $imagePath = $basePath . "/" . $productType . "/" . $id . "/";
        $result = (!is_dir($imagePath)) ? mkdir($imagePath, 0777, true) : '';
        if ($explicitName) {
            $imageName = $explicitName;
        } else {
            $imageName = $productType . "_" . $id;
        }
        $imageExtension = $imageObj->getClientOriginalExtension();

        //move original image to folder
        if (in_array($imageExtension, $IMAGE_ARR))
            //$upload_success = $imageObj->move($imagePath, 'original_' . $imageName . "." . $imageExtension);
            $upload_success = $imageObj->move($imagePath, $imageName . "." . $imageExtension);
        else
            $upload_success = $imageObj->move($imagePath, $imageName.".".$imageExtension);

        if (in_array($imageExtension, $IMAGE_ARR)) {
            $img       = Image::make($imagePath .  $imageName . "." . $imageExtension);
            $imgWidth  = $img->width();
            $imgHeight = $img->height();

            //resize the original to different dimensions
            if(!empty($dimensionArray)) {
                foreach ($dimensionArray as $key => $dimension) {
                    if($imgWidth > $dimension['width']) {
                        $img->resize($dimension['width'], null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }elseif($imgHeight > $dimension['height']) {
                        $img->resize(null, $dimension['height'], function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    if ($explicitName) {
                        $withExt = $explicitName . "." . $imageExtension;
                        $img->save($imagePath . $withExt);
                    } else {
                        $img->save($imagePath . $imageName . "." . $imageExtension);
                    }
                }
            } 
        }

        return $imageName . "." . $imageExtension;
    }
      

    public static function deleteImage($imgName, $destination, $dimensions = NULL) {
        try {
            File::delete($destination . $imgName);
            if(!empty($dimensions)){
                foreach ($dimensions as $d)
                    File::delete($d['p'] . $imgName);
            }
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
        }
    }

    public static function deleteImageByProduct($productType, $id) {
        $basePath = Config::get('global_vars.IMAGE_PATH');
        $imagePath = $basePath."/".$productType."/".$id."/";

      //check aready existing folder
      if(is_dir($imagePath)){
        $files_in_directory = scandir($imagePath);
        $items_count = count($files_in_directory);
        if($items_count > 2)
        {
            $files = glob($imagePath.'*'); // get all file names
            foreach($files as $file){ // iterate files
              if(is_file($file))
                unlink($file); // delete file
            }
        }
      }
    }
    
    public static function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = Lib::utf8ize($v);
            }
        } else {
            return utf8_encode($d);
        }
        return $d;
    }

    public static function addSelect($data)
    {
        if(!empty($data)){
            $data = [''=> 'Select'] + $data;
        }else{
            $data = ['' => 'Select'];
        }
        return $data;

    }

    public static function getFirstLaravelErrorMsg($objError) {
        $aData = array();
        if (count($objError) > 0) {
            $aErrors = $objError->messages();
            foreach (json_decode($aErrors) as $key => $val) {
                return $val[0];
            }
        }
        return $aData;
    }

    public static function checkForYesterdaysDate($datetime)
    {
        // get timestamp for given date
        $splitOne = explode(" ", $datetime);
        $splitDate = explode("-", $splitOne[0]); 
        $splitTime = explode(":", $splitOne[1]);

        $givenTimeStamp = mktime($splitTime[0], $splitTime[1], 0, $splitDate[1], $splitDate[0], $splitDate[2]);

        $yesterdayDate = mktime(0, 0, 0, date("m"), date("d"), date("Y")) - 60 * 60 * 24;

        if($givenTimeStamp < $yesterdayDate){
            return false;
        }else{
            return true;
        }
    }

     public static function roundOffNumber($number,$roundOffDigit = 1)
    {
        if($roundOffDigit != 0){
            $roundOffDigit = 2;
        }
        $n = round($number,$roundOffDigit,PHP_ROUND_HALF_UP);
        return $n; 
    }

// input - minutes
    public static function secondsToTime($minutes)
    {
        $returnArr = [];
        $day = floor ($minutes / 1440);
        $hour = floor (($minutes - $day * 1440) / 60);
        $min = $minutes - ($day * 1440) - ($hour * 60);
        
        $returnArr = [
            'days' => $day,
            'hrs' => $hour,
            'min' => $min,
        ];
        //$dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
        return $returnArr; 
    }

    public static function convertToTime($hrs,$min)
    {
        $time = '';
        if(!empty($hrs)){
            if(!empty($min)){
                $time = mktime($hrs,$min,0,0,0,0);
            }else{
                $time = mktime($hrs,0,0,0,0,0);
            }
        }elseif (!empty($min)) {
            $time = mktime(0,$min,0,0,0,0);
        }

        if(!empty($time)){
            $time = date("H:i",$time);
        }

        return $time;
    }

    public static function checkWithTodaysDate($datetime)
    {
        // check given date time is less than current time or not
        // get timestamp for given date
        $splitOne = explode(" ", $datetime);
        $splitDate = explode("-", $splitOne[0]); 
        $splitTime = explode(":", $splitOne[1]);

        $givenTimeStamp = mktime($splitTime[0], $splitTime[1], 0, $splitDate[1], $splitDate[0], $splitDate[2]);

        $todaysDate = time();

        if($givenTimeStamp < $todaysDate){
            return false;
        }else{
            return true;
        }
    }

    // input - start time and end time
    //output = difference seconds
    public static function getShiftHrs($startTime,$endTime)
    {
        //convert both time to timestamp
        $sExplode = explode(":", $startTime);
        $eExplode = explode(":", $endTime);

        $sTime = mktime($sExplode[0],$sExplode[1],$sExplode[2],0,0,0);
        $eTime = mktime($eExplode[0],$eExplode[1],$eExplode[2],0,0,0);
        
        if($sTime > $eTime){
            $diff = $sTime - $eTime;
        }else{
            $diff = $eTime - $sTime;
        }
        return $diff / 3600 ;
    }

    public static function FunctionName($value='')
    {
        $times = array($time1, $time2);
        $seconds = 0;
        foreach ($times as $time)
        {
            list($hour,$minute,$second) = explode(':', $time);
            $seconds += $hour*3600;
            $seconds += $minute*60;
            $seconds += $second;
        }
        $hours = floor($seconds/3600);
        $seconds -= $hours*3600;
        $minutes  = floor($seconds/60);
        $seconds -= $minutes*60;
      // return "{$hours}:{$minutes}:{$seconds}";
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    }

    public static function getShiftStartEndTime($givenDate,$startTime,$shiftHrs)
    {
        $returnArr = [];
        $dateExplode = explode("-", $givenDate);
        $timeExplode = explode(":", $startTime);

        $startDateTime = $date = new DateTime($dateExplode[2]."-".$dateExplode[1]."-".$dateExplode[0]." ".$timeExplode[0].":".$timeExplode[1].":".$timeExplode[2]);

        $returnArr['startDateTime'] = $date->format("Y-m-d H:i:s");

        $startDateTime->add(new DateInterval('PT'.$shiftHrs.'H'));

        $returnArr['endDateTime'] = $startDateTime->format("Y-m-d H:i:s"); 
        return  $returnArr;
    }

    public static function formatAllowDateAndTime($shiftTiming)
    {
        $returnArr = $dates = [];
        $startDate = $shiftTiming['startDateTime'];
        $endDate = $shiftTiming['endDateTime'];

        $period = new DatePeriod(
                    new DateTime($startDate),
                    new DateInterval('PT5M'),
                    new DateTime($endDate)
        );
        foreach ($period as $key => $date) {
            $dates[] = $date->format("H:i");
        }  
  
        $returnArr['startDate'] = Lib::convertDateFormat("Y-m-d H:i:s",$startDate,"d-m-Y H:i");
        $returnArr['endDate'] = Lib::convertDateFormat("Y-m-d H:i:s",$endDate,"d-m-Y H:i");

        $returnArr['time'] = json_encode($dates);
        return $returnArr;
    }

    public static function getDifferenceBetweenDates($startDateTime,$endDateTime)
    {
        $datetime1 = new DateTime($startDateTime);
        $datetime2 = new DateTime($endDateTime);
        $interval = $datetime1->diff($datetime2);
    //    Lib::pr([$datetime1,$datetime2,$interval]); exit;
        $elapsed = $interval->format('%H:%i:%s');
        return $elapsed;
    }

    public static function getShiftTiming($startTime,$endTime)
    {
        $returnArr = $dates = [];
        if($startTime < $endTime){
            $startDate = date("Y-m-d")." ".$startTime;
            $endDate = date("Y-m-d")." ".$endTime;;
        }else{
            $startDate = date("Y-m-d")." ".$startTime;
            $endDate = date("Y-m-d",strtotime("tomorrow"))." ".$endTime;
        }
        $period = new DatePeriod(
                    new DateTime($startDate),
                    new DateInterval('PT30M'),
                    new DateTime($endDate)
        );
        foreach ($period as $key => $date) {
            $dates[] = $date->format("H:i");
        }  
      
        return $dates;

        return $data;
    }

    public static function isAdmin()
    {
        $isAdmin = Sentinel::inRole('admin');
        
        return $isAdmin;
    }

    public static function checkModuleAccess()
    {
        $userObj="";
        $groupObj="";
       
        $userObj = Sentinel::getUser();

        $ACLController  = Lib::currentController();
        $ACLAction      = Lib::currentAction();

        // get user id
        $userId     = $userObj->id;

        if($userId)
        {
            // get module and task for the controller and action
            $aclModule = new AclModule();

            $permission = $aclModule->getACL($ACLController,$ACLAction);
            if(count($permission)){
                if ($userObj->hasAccess([$permission->module.".".$permission->task]))
                {
                    return true;
                    // Execute this code if the user has permission
                }
                else
                {
                    return false;
                    // Execute this code if the permission check failed
                }
            }else{
               return false; 
            }
        }
        else
        {

            return false;
        }
    }

    public static function checkActionAccess($ACLController,$ACLAction)
    {
        $userObj="";
        $groupObj="";
        
        if(Lib::isAdmin())
        {
            return true;
        }
        else    
        { 
            $userObj = Sentinel::getUser();
            // get user id
            $userId     = $userObj->id;
            if($userId)
            {
                // get module and task for the controller and action
                $aclModule = new AclModule();

                $permission = $aclModule->getACL($ACLController,$ACLAction);
                if(count($permission)){
                    if ($userObj->hasAccess([$permission->module.".".$permission->task]))
                    {
                        return true;
                        // Execute this code if the user has permission
                    }
                    else
                    {
                        return false;
                        // Execute this code if the permission check failed
                    }
                }else{
                   return false; 
                }
            }
            else
            {
                return false;
            }
        }
    }

    public static function checkMenuAccess($controller)
    {
        if(Lib::isAdmin())
        {
            return true;
        }
        else    
        {    
            $userObj = Sentinel::getUser();

            $userId     = isset($userObj->id) ? $userObj->id : "";

            if($userId)
            {
                // get module and task for the controller and action
                $aclModule = new AclModule();

                $permission = $aclModule->getACLForController($controller);
                if(count($permission)){
                    if ($userObj->hasAccess([$permission->module.".*"]))
                    {
                        return true;
                        // Execute this code if the user has permission
                    }
                    else
                    {
                        return false;
                        // Execute this code if the permission check failed
                    }
                }else{
                   return false; 
                }
            }else{
                return false;
            }
        }   
    }

    public static function getTimeBetweenTwoDateTime($strStart,$strEnd)
    {
        $dteStart = new DateTime($strStart); 
        $dteEnd   = new DateTime($strEnd); 

        $dteDiff  = $dteStart->diff($dteEnd); 

        return $dteDiff->format("%H:%I:%S"); 

    }

    public static function getFirstDateOfTheMonth($date)
    {
        $dateSplit = explode("-", $date);
        return date($dateSplit[0]."-".$dateSplit[1]."-01");
    }

    public static function sum_the_time($time1, $time2) {
      $times = array($time1, $time2);
      $seconds = 0;
 
      foreach ($times as $time)
      {
        list($hour,$minute,$second) = explode(':', $time);
        $seconds += $hour*3600;
        $seconds += $minute*60;
        $seconds += $second;
      }
      $hours = floor($seconds/3600);
      $seconds -= $hours*3600;
      $minutes  = floor($seconds/60);
      $seconds -= $minutes*60;
      if($seconds < 9)
      {
      $seconds = "0".$seconds;
      }
      if($minutes < 9)
      {
      $minutes = "0".$minutes;
      }
        if($hours < 9)
      {
      $hours = "0".$hours;
      }
      return "{$hours}:{$minutes}:{$seconds}";
    }
}

?>