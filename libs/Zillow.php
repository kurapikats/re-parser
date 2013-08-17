<?php

class Zillow
{
    protected $zws_id = 'X1-ZWz1dlnsqnlmob_211k7';
    protected $state = 'New York';

    public function getRegionChildren($state)
    {
        $region_children_api_url = 'http://www.zillow.com/webservice/GetRegionChildren.htm';

        $url = $region_children_api_url . "?zws-id=" . $this->zws_id . "&state=" . urlencode($state);
    }

    private function __getData($url)
    {

        $xml_data = $this->curlGet($url);
        $data = new SimpleXMLElement($xml_data);

        //echo "<pre>";
        //print_r($data);
        //exit;

        /*if (is_object($data->response->list) && $data->response->list->count > 0)
        {
            return $data;
        }
        else
        {
            //$data->message->text;
            //$data->message->code;
            return false;
        }*/
        return $data;
    }

    public function getSearchResults($address, $citystatezip)
    {
        $api_url = 'http://www.zillow.com/webservice/GetSearchResults.htm';

        $processed_address = explode($citystatezip, $address);

        $z_address =  trim($processed_address[0]);
        if (isset($processed_address[1])) {
            $z_state = $citystatezip . " " . trim($processed_address[1]);
        } else {
            $z_state = $citystatezip;
        }

        $url = $api_url . "?zws-id=" . $this->zws_id . "&citystatezip=" .
            urlencode($z_state) . '&address=' . urlencode($z_address);

        $data = $this->__getData($url);

        return $data;
    }

    protected function curlGet($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT,
            'Mozilla/5.0 (Windows; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3');
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
