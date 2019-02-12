<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use  App\Http\Requests\tankSearch;

class Tank extends Controller
{
    public function index()
    {
        return view('index');
    }


  public function tankHQ13()
  {
      $checkValue = 0;

      $checkValues = 0;

      $dates=[];

      $sensorRead=[];

      try
        {
  //    date_default_timezone_set('Asia/Baghdad');

      $current_date = Carbon::now();

    //  dd($current_date);
      $url = "https://77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix:a36050ba4ed77ea7a36ff0df64f18a38058b478e0fed9642111cba935dfb0758@77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix.cloudant.com/iotp_3i2tk4_iotzain_2018-04/_design/HQ13/_view/sensor-water-viewHQ13?include_docs=true&update=true&stable=false&startkey=%22".$current_date->year."-".$current_date->format('m')."-".$current_date->format('d')."T00:00:00Z%22&endkey=%22".$current_date->year."-".$current_date->format('m')."-".$current_date->format('d')."T23:59:59Z%22";

    //  dd($url);
      $ch = curl_init();

// Disable SSL verification
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
      curl_setopt($ch, CURLOPT_URL,$url);
// Execute
      $result=curl_exec($ch);
// Closing
      curl_close($ch);

// Will dump a beauty json :3

          //    dd($result);

          if(isset(json_decode($result, true)['rows']) && !empty(json_decode($result, true)['rows']) )

          {
              $rows = json_decode($result, true)['rows'];

              $checkValues = 1;
      foreach ($rows as $rowss)
      {


      $row = $rowss;
      $doc = $row['doc'];


          preg_match('/T(.*?):/', $doc['timestamp'] , $match);
          $temp["date"] = $match[1];
          $data = $doc['data'];
          $temp["lastRead"] = (int)((($data['Waterlvl'])/104) *100);
          $temp["lastRead"] = $temp["lastRead"]+7;

      $lastValues[]=$temp;
      }

      $last=array_unique(array_column($lastValues, 'date'));
      $lastValues=array_intersect_key($lastValues, $last);

      sort($lastValues);




      foreach ($lastValues as $lastValuess)
      {
          $dates[]= $lastValuess["date"];
          $sensorRead[]= $lastValuess["lastRead"];
      }


     }


      $url = "https://77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix:a36050ba4ed77ea7a36ff0df64f18a38058b478e0fed9642111cba935dfb0758@77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix.cloudant.com/iotp_3i2tk4_iotzain_2018-04/_design/HQ13/_view/sensor-water-viewHQ13?include_docs=true&limit=1&descending=true";

      $ch = curl_init();


// Disable SSL verification
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
      curl_setopt($ch, CURLOPT_URL,$url);
// Execute
      $result=curl_exec($ch);
// Closing
      curl_close($ch);

// Will dump a beauty json :3

   //  dd($result);





          if(isset(json_decode($result, true)['rows']) && !empty(json_decode($result, true)['rows']) )

          {
              $rows = json_decode($result, true)['rows'];

      $checkValue = 1;
      $row = $rows[0];
      $doc = $row['doc'];
      $data = $doc['data'];
      $lastUpdate = $doc['timestamp'];
      $lastValue = $data['Waterlvl'];

      }



      return view('waterTankHQ13',[
          'lastValue'=>((($lastValue)/104) *100)+7,
          'dates'=>$dates,
          'sensorReads'=>$sensorRead,
          'checkValues'=>$checkValues,
          'checkValue'=>$checkValue,
          'search'=>0,
          'lastUpdate'=>Carbon::parse($lastUpdate)->format("d-m-Y H:i")


      ]);
      }
      catch (\Exception $e)
      {
          dd($e->getMessage());
          return back()
              ->with('error', 'Client not Add Please Try Again!!');
      }
  }


    public function getDataTankHQ13()
    {
        $url = "https://77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix:a36050ba4ed77ea7a36ff0df64f18a38058b478e0fed9642111cba935dfb0758@77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix.cloudant.com/iotp_3i2tk4_iotzain_2018-04/_design/HQ13/_view/sensor-water-viewHQ13?include_docs=true&limit=1&descending=true";

        $ch = curl_init();


// Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
// Execute
        $result=curl_exec($ch);
// Closing
        curl_close($ch);

// Will dump a beauty json :3


        $rows = json_decode($result, true)['rows'];

        // dd($rows);
        $row = $rows[0];
        $doc = $row['doc'];
        $data = $doc['data'];
        $lastUpdate = $doc['timestamp'];
        $lastValue = $data['Waterlvl'];

       return response()->json([((($lastValue)/104) *100)+7,Carbon::parse($lastUpdate)->format("d-m-Y H:i")]);
     // return response()->json( rand ( 0 , 100 ) );

    }

    public function tankSearchTankHQ13(tankSearch $request)
    {
        $checkValue = 0;

        $checkValues = 0;

        $dates=[];

        $sensorRead=[];

        try
        {
            date_default_timezone_set('Asia/Baghdad');


            $current_date = Carbon::parse($request->startDate);

            //  dd($current_date);
            $url = "https://77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix:a36050ba4ed77ea7a36ff0df64f18a38058b478e0fed9642111cba935dfb0758@77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix.cloudant.com/iotp_3i2tk4_iotzain_2018-04/_design/HQ13/_view/sensor-water-viewHQ13?include_docs=true&update=true&stable=false&startkey=%22".$current_date->year."-".$current_date->format('m')."-".$current_date->format('d')."T00:00:00Z%22&endkey=%22".$current_date->year."-".$current_date->format('m')."-".$current_date->format('d')."T23:59:59Z%22";

            //  dd($url);
            $ch = curl_init();


// Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
// Execute
            $result=curl_exec($ch);
// Closing
            curl_close($ch);

// Will dump a beauty json :3



            $rows = json_decode($result, true)['rows'];


            if(isset($rows) && ! empty($rows))

            {

                $checkValues = 1;
                foreach ($rows as $rowss)
                {


                    $row = $rowss;
                    $doc = $row['doc'];


                    preg_match('/T(.*?):/', $doc['timestamp'] , $match);
                    $temp["date"] = $match[1];
                    $data = $doc['data'];
                    $temp["lastRead"] = (int)((($data['Waterlvl'])/104) *100);
                    $temp["lastRead"] =$temp["lastRead"] +7;

                    $lastValues[]=$temp;
                }

                $last=array_unique(array_column($lastValues, 'date'));
                $lastValues=array_intersect_key($lastValues, $last);

                sort($lastValues);




                foreach ($lastValues as $lastValuess)
                {
                    $dates[]= $lastValuess["date"];
                    $sensorRead[]= $lastValuess["lastRead"];
                }


            }


            $url = "https://77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix:a36050ba4ed77ea7a36ff0df64f18a38058b478e0fed9642111cba935dfb0758@77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix.cloudant.com/iotp_3i2tk4_iotzain_2018-04/_design/HQ13/_view/sensor-water-viewHQ13?include_docs=true&limit=1&descending=true";

            $ch = curl_init();


// Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
// Execute
            $result=curl_exec($ch);
// Closing
            curl_close($ch);

// Will dump a beauty json :3

            //  dd($result);



            $rows = json_decode($result, true)['rows'];

            if(isset($rows) && ! empty($rows))

            {

                $checkValue = 1;
                $row = $rows[0];
                $doc = $row['doc'];
                $data = $doc['data'];
                $lastUpdate = $doc['timestamp'];
                $lastValue = $data['Waterlvl'];

            }



            return view('waterTankHQ13',[
                'lastValue'=>((($lastValue)/104) *100)+7,
                'dates'=>$dates,
                'sensorReads'=>$sensorRead,
                'checkValues'=>$checkValues,
                'checkValue'=>$checkValue,
                'search'=>1,
                'searchDate'=>$request->startDate,
                'lastUpdate'=>Carbon::parse($lastUpdate)->format("d-m-Y H:i")

            ]);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
            return back()
                ->with('error', 'Client not Add Please Try Again!!');
        }
    }


    public function tankHQ12()
    {
        $checkValue = 0;

        $checkValues = 0;

        $dates=[];

        $sensorRead=[];

        try
        {
           date_default_timezone_set('Asia/Baghdad');

            $current_date = Carbon::now();

            //  dd($current_date);
            $url = "https://77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix:a36050ba4ed77ea7a36ff0df64f18a38058b478e0fed9642111cba935dfb0758@77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix.cloudant.com/iotp_3i2tk4_iotzain_2018-04/_design/HQ12/_view/sensor-water-viewHQ12?include_docs=true&update=true&stable=false&startkey=%22".$current_date->year."-".$current_date->format('m')."-".$current_date->format('d')."T00:00:00Z%22&endkey=%22".$current_date->year."-".$current_date->format('m')."-".$current_date->format('d')."T23:59:59Z%22";

            //  dd($url);
            $ch = curl_init();


// Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
// Execute
            $result=curl_exec($ch);
// Closing
            curl_close($ch);

// Will dump a beauty json :3


         //   dd($result);



            if(isset(json_decode($result, true)['rows']) && !empty(json_decode($result, true)['rows']) )

            {
                $rows = json_decode($result, true)['rows'];
                $checkValues = 1;
                foreach ($rows as $rowss)
                {


                    $row = $rowss;
                    $doc = $row['doc'];


                    preg_match('/T(.*?):/', $doc['timestamp'] , $match);
                    $temp["date"] = $match[1];
                    $data = $doc['data'];
                    $temp["lastRead"] = (int)((($data['Waterlvl'])/85) *100);
                    $temp["lastRead"]=  $temp["lastRead"];

                    $lastValues[]=$temp;
                }

                $last=array_unique(array_column($lastValues, 'date'));
                $lastValues=array_intersect_key($lastValues, $last);

                sort($lastValues);




                foreach ($lastValues as $lastValuess)
                {
                    $dates[]= $lastValuess["date"];
                    $sensorRead[]= $lastValuess["lastRead"];
                }


            }


            $url = "https://77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix:a36050ba4ed77ea7a36ff0df64f18a38058b478e0fed9642111cba935dfb0758@77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix.cloudant.com/iotp_3i2tk4_iotzain_2018-04/_design/HQ12/_view/sensor-water-viewHQ12?include_docs=true&limit=1&descending=true";

            $ch = curl_init();


// Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
// Execute
            $result=curl_exec($ch);
// Closing
            curl_close($ch);

// Will dump a beauty json :3

            //  dd($result);





            if(isset(json_decode($result, true)['rows']) && !empty(json_decode($result, true)['rows']) )

            {
                $rows = json_decode($result, true)['rows'];

                $checkValue = 1;
                $row = $rows[0];
                $doc = $row['doc'];
                $lastUpdate = $doc['timestamp'];
                $data = $doc['data'];
                $lastValue = $data['Waterlvl'];

            }


          ;
            return view('waterTankHQ12',[
                'lastValue'=>((($lastValue)/85) *100),
                'dates'=>$dates,
                'sensorReads'=>$sensorRead,
                'checkValues'=>$checkValues,
                'checkValue'=>$checkValue,
                'search'=>0,
                'lastUpdate'=>Carbon::parse($lastUpdate)->format("d-m-Y H:i")


            ]);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
            return back()
                ->with('error', 'Client not Add Please Try Again!!');
        }
    }

    public function getDataTankHQ12()
    {
        $url = "https://77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix:a36050ba4ed77ea7a36ff0df64f18a38058b478e0fed9642111cba935dfb0758@77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix.cloudant.com/iotp_3i2tk4_iotzain_2018-04/_design/HQ12/_view/sensor-water-viewHQ12?include_docs=true&limit=1&descending=true";

        $ch = curl_init();


// Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
// Execute
        $result=curl_exec($ch);
// Closing
        curl_close($ch);

// Will dump a beauty json :3




        if(isset(json_decode($result, true)['rows']) && !empty(json_decode($result, true)['rows']) ) {
            $rows = json_decode($result, true)['rows'];
            $row = $rows[0];
            $doc = $row['doc'];
            $data = $doc['data'];
            $lastValue = $data['Waterlvl'];
            $lastUpdate = $doc['timestamp'];
        }
        return response()->json([((($lastValue)/85) *100), Carbon::parse($lastUpdate)->format("d-m-Y H:i")]);
        // return response()->json( rand ( 0 , 100 ) );

    }

    public function tankSearchTankHQ12(tankSearch $request)
    {
        $checkValue = 0;

        $checkValues = 0;

        $dates=[];

        $sensorRead=[];

        try
        {
            date_default_timezone_set('Asia/Baghdad');


            $current_date = Carbon::parse($request->startDate);

            //  dd($current_date);
            $url = "https://77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix:a36050ba4ed77ea7a36ff0df64f18a38058b478e0fed9642111cba935dfb0758@77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix.cloudant.com/iotp_3i2tk4_iotzain_2018-04/_design/HQ12/_view/sensor-water-viewHQ12?include_docs=true&update=true&stable=false&startkey=%22".$current_date->year."-".$current_date->format('m')."-".$current_date->format('d')."T00:00:00Z%22&endkey=%22".$current_date->year."-".$current_date->format('m')."-".$current_date->format('d')."T23:59:59Z%22";

            //  dd($url);
            $ch = curl_init();


// Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
// Execute
            $result=curl_exec($ch);
// Closing
            curl_close($ch);

// Will dump a beauty json :3



            $rows = json_decode($result, true)['rows'];


            if(isset($rows) && ! empty($rows))

            {

                $checkValues = 1;
                foreach ($rows as $rowss)
                {


                    $row = $rowss;
                    $doc = $row['doc'];


                    preg_match('/T(.*?):/', $doc['timestamp'] , $match);
                    $temp["date"] = $match[1];
                    $data = $doc['data'];
                    $lastUpdate = $doc['timestamp'];
                    $temp["lastRead"] = (int)((($data['Waterlvl'])/85) *100);
                    $temp["lastRead"]=$temp["lastRead"];

                    $lastValues[]=$temp;
                }

                $last=array_unique(array_column($lastValues, 'date'));
                $lastValues=array_intersect_key($lastValues, $last);

                sort($lastValues);




                foreach ($lastValues as $lastValuess)
                {
                    $dates[]= $lastValuess["date"];
                    $sensorRead[]= $lastValuess["lastRead"];
                }


            }


            $url = "https://77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix:a36050ba4ed77ea7a36ff0df64f18a38058b478e0fed9642111cba935dfb0758@77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix.cloudant.com/iotp_3i2tk4_iotzain_2018-04/_design/HQ12/_view/sensor-water-viewHQ12?include_docs=true&limit=1&descending=true";

            $ch = curl_init();


// Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
// Execute
            $result=curl_exec($ch);
// Closing
            curl_close($ch);

// Will dump a beauty json :3

            //  dd($result);





            if(isset(json_decode($result, true)['rows']) && !empty(json_decode($result, true)['rows']) )

            {
                $rows = json_decode($result, true)['rows'];
                $checkValue = 1;
                $row = $rows[0];
                $doc = $row['doc'];
                $data = $doc['data'];
                $lastUpdate = $doc['timestamp'];
                $lastValue = $data['Waterlvl'];

            }



            return view('waterTankHQ12',[
                'lastValue'=>((($lastValue)/85) *100),
                'dates'=>$dates,
                'sensorReads'=>$sensorRead,
                'checkValues'=>$checkValues,
                'checkValue'=>$checkValue,
                'search'=>1,
                'searchDate'=>$request->startDate,
                'lastUpdate'=>Carbon::parse($lastUpdate)->format("d-m-Y H:i")

            ]);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
            return back()
                ->with('error', 'Client not Add Please Try Again!!');
        }
    }

    public function tankSearchTankHQ123(tankSearch $request)
    {
        $checkValue = 0;

        $checkValues = 0;

        $dates=[];

        $sensorRead=[];

        try
        {
            date_default_timezone_set('Asia/Baghdad');


            $current_date = Carbon::parse($request->startDate);

            //  dd($current_date);
            $url = "https://77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix:a36050ba4ed77ea7a36ff0df64f18a38058b478e0fed9642111cba935dfb0758@77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix.cloudant.com/iotp_3i2tk4_iotzain_2018-04/_design/HQ12/_view/sensor-water-viewHQ12?include_docs=true&update=true&stable=false&startkey=%22".$current_date->year."-".$current_date->format('m')."-".$current_date->format('d')."T00:00:00Z%22&endkey=%22".$current_date->year."-".$current_date->format('m')."-".$current_date->format('d')."T23:59:59Z%22";

            //  dd($url);
            $ch = curl_init();


// Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
// Execute
            $result=curl_exec($ch);
// Closing
            curl_close($ch);

// Will dump a beauty json :3






            if(isset(json_decode($result, true)['rows']) && !empty(json_decode($result, true)['rows']) )

            {
                $rows = json_decode($result, true)['rows'];

                $checkValues = 1;
                foreach ($rows as $rowss)
                {


                    $row = $rowss;
                    $doc = $row['doc'];


                    preg_match('/T(.*?):/', $doc['timestamp'] , $match);
                    $temp["date"] = $match[1];
                    $data = $doc['data'];
                    $temp["lastRead"] = (int)((($data['Waterlvl'])/128) *100);


                    $lastValues[]=$temp;
                }

                $last=array_unique(array_column($lastValues, 'date'));
                $lastValues=array_intersect_key($lastValues, $last);

                sort($lastValues);




                foreach ($lastValues as $lastValuess)
                {
                    $dates[]= $lastValuess["date"];
                    $sensorRead[]= $lastValuess["lastRead"];
                }


            }


            $url = "https://77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix:a36050ba4ed77ea7a36ff0df64f18a38058b478e0fed9642111cba935dfb0758@77f50af5-0c84-4915-89cb-6983d3f85d91-bluemix.cloudant.com/iotp_3i2tk4_iotzain_2018-04/_design/HQ12/_view/sensor-water-viewHQ12?include_docs=true&limit=1&descending=true";

            $ch = curl_init();


// Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
// Execute
            $result=curl_exec($ch);
// Closing
            curl_close($ch);

// Will dump a beauty json :3

            //  dd($result);





            if(isset(json_decode($result, true)['rows']) && !empty(json_decode($result, true)['rows']) )

            {
                $rows = json_decode($result, true)['rows'];

                $checkValue = 1;
                $row = $rows[0];
                $doc = $row['doc'];
                $data = $doc['data'];

                $lastValue = $data['Waterlvl'];

            }



            return view('waterTankHQ12',[
                'lastValue'=>(($lastValue)/128) *100,
                'dates'=>$dates,
                'sensorReads'=>$sensorRead,
                'checkValues'=>$checkValues,
                'checkValue'=>$checkValue,
                'search'=>1,
                'searchDate'=>$request->startDate

            ]);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
            return back()
                ->with('error', 'Client not Add Please Try Again!!');
        }
    }

}
