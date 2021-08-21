<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 27.03.2020
 * Time: 17:57
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

use Yii;
use yii\console\Controller;

class CronController extends Controller
{
    public function actionIndex()
    {
        //Пример приемма данных через Curl
        $servername = "localhost";
        $username = "test.loc";
        $password = "02dkfl01bckfd88";
        $dbname = "test.loc";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.vsmart.net/partner/api/Account/GenerateToken",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n    \"UserName\": \"activation_ru@vinsmart.net\",\r\n    \"Password\": \"[K<?dg(7[U(D8V'JX)bA/j*{qm<xgxGe\"\r\n}\r\n",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

//curl_close($curl);
        $decode = json_decode($response);
        $token = $decode->data->token;
//$curl = curl_init();
        $date = Date('Y-m-d');
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.vsmart.net/idms/api/Activation/Get",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n  \"StartDate\" : \"$date 00:00:00\",\r\n  \"EndDate\" : \"$date 23:59:59\",\r\n  \"PageIndex\" : 0,\r\n  \"PageSize\" : 120\r\n}\r\n",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $token,
                "Content-Type: application/json"
            ),
        ));

        $response2 = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response2);

        $data = $result->data->activations;

        foreach ($data as $item) {
            $deviceSerial = $item->deviceSerial;
            $deviceName = $item->deviceName;
            $imei = $item->imei;
            $refIMEI = $item->refIMEI;
            $startDate = explode('T', $item->startDate);
            $endDate = explode('T', $item->endDate);

            $sql = "SELECT * FROM `b_iblock_element_prop_s19` WHERE `PROPERTY_70`='" . $deviceSerial . "'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
//        $row = $result->fetch_row();
            } else {
                $sql2 = "INSERT INTO `b_iblock_element` (`ID`, `TIMESTAMP_X`, `MODIFIED_BY`, `DATE_CREATE`, `CREATED_BY`, `IBLOCK_ID`, `IBLOCK_SECTION_ID`, `ACTIVE`, `ACTIVE_FROM`, `ACTIVE_TO`, `SORT`, `NAME`, `PREVIEW_PICTURE`, `PREVIEW_TEXT`, `PREVIEW_TEXT_TYPE`, `DETAIL_PICTURE`, `DETAIL_TEXT`, `DETAIL_TEXT_TYPE`, `SEARCHABLE_CONTENT`, `WF_STATUS_ID`, `WF_PARENT_ELEMENT_ID`, `WF_NEW`, `WF_LOCKED_BY`, `WF_DATE_LOCK`, `WF_COMMENTS`, `IN_SECTIONS`, `XML_ID`, `CODE`, `TAGS`, `TMP_ID`, `WF_LAST_HISTORY_ID`, `SHOW_COUNTER`, `SHOW_COUNTER_START`) VALUES (NULL, '2020-03-27 10:29:30', '1', '2020-03-27 10:29:30', '1', '19', NULL, 'Y', NULL, NULL, '500', " . $imei . ", NULL, NULL, 'text', NULL, NULL, 'text', " . $imei . ", '1', NULL, NULL, NULL, NULL, NULL, 'N', '8337', NULL, NULL, NULL, NULL, NULL, NULL)";
                $result2 = $conn->query($sql2);
                if ($result2 === true) {
                    $id = $conn->insert_id;
                    $sql3 = "INSERT INTO `b_iblock_element_prop_s19` (`IBLOCK_ELEMENT_ID`, `PROPERTY_70`, `PROPERTY_71`, `PROPERTY_72`, `PROPERTY_73`, `PROPERTY_74`) VALUES (" . $id . ", '" . $deviceSerial . "', NULL, '" . $startDate[0] . "','" . $endDate[0] . "', NULL)";
                    $result3 = $conn->query($sql3);
                    if ($result3 === false) {
                        echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
                    }
                } else {
                    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
                }
            }
        }
        $conn->close();
    }
}
