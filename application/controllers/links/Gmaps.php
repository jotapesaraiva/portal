<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gmaps extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        include APPPATH . 'third_party/zabbix/ZabbixApiAbstract.class.php';
        include APPPATH . 'third_party/zabbix/ZabbixApi.class.php';
        include APPPATH . 'third_party/zabbix/date_function.php';

    }

    public function index() {
        // Load the library
        $this->load->library('googlemaps');
        $config['zoom'] = 'auto';
        $config['map_height'] = '850px';
        $config['center'] = '-4.893941, -52.913819';
        $config['refreshMarkers'] = '60000';
        // $config['scaleControlPosition'] = TRUE;
        // $config['streetViewControlPosition'] = TRUE;
        // $config['draggableCursor'] = 'auto';
        // $config['mapTypeControlStyle'] = 'DROPDOWN_MENU';
        // $config['streetViewZoomControl'] = FALSE;
        // $config['zoomControlStyle'] = 'SMALL';
        $config['https'] = TRUE;
        $config['cluster'] = TRUE;
        $config['clusterImagePath'] = '"'.base_url().'assets/custom/gmaps/img/m"';
        $config['map_type'] = "ROADMAP";
        // $config['apiKey'] = 'AIzaSyABymwhvTD8qgfQ3g6iZBWyC_muA2qNU_o';
        // AIzaSyABymwhvTD8qgfQ3g6iZBWyC_muA2qNU_o
        // AIzaSyBRMnNs2WeYcgmas45FAtlBmrhVNuQCFyQ
        // AIzaSyAPO4xrMtb_MleiAPd8LkVXedF2DHyBLq8
        // Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
        $this->googlemaps->initialize($config);
        // $this->googlemaps->initialize();
        $points = json_decode($this->zabbix());
        // var_dump($points);
        $count = 0;
        foreach ($points as $point) {
            $marker = array();
            $marker['icon'] = base_url().'assets/custom/gmaps/img/icons-dot.png';
            $marker['icon_size'] ='32,32';
            $marker['icon_origin'] = '0,0';
            $marker['icon_anchor'] = '15,32';
            $marker['onmouseover'] = '
            marker_'.$count.'.setIcon(
            new google.maps.MarkerImage("'.base_url().'assets/custom/gmaps/img/icons-dot.png",
                              new google.maps.Size(32, 32),
                              new google.maps.Point(160,0),
                              new google.maps.Point(15, 32)));';
            $marker['onmouseout'] = '
            marker_'.$count.'.setIcon(
            new google.maps.MarkerImage("../img/icons-dot.png",
                              new google.maps.Size(32, 32),
                              new google.maps.Point(0,0),
                              new google.maps.Point(15, 32)));';
            $marker['position'] = $point->latitude.','.$point->longitude;
            $marker['title'] = $point->name;
            $ponto = array(
                'name' => $point->name,
                'link' => $point->type,
                'ip' => $point->ip,
                'velo' => '1024',
                'duration' => $point->duration,
                'desig' => 'BLM/IP/00109',
            );
            $marker['infowindow_content'] =
            "<b><a href='http://x-oc-cacti.sefa.pa.gov.br:8080/nagios/cgi-bin/trends.cgi?host=' target='_blank' title='Consulta nagios' style='text-decoration: none; color:#000000; font-weight:bold'>".$ponto['name']."</a><\/b><p style='font-size:smaller'>".
                            "<b>Designacao: </b>".$ponto['desig'].
                            "<br><b>IP Sefa: </b><a href='http://portal-monitoramento.sefa.pa.gov.br/index/links_ping.php?ip=".$ponto['ip']."' target='_blank' title='Ping'>".$ponto['ip']."</a>".
                            "<br><b>IP Embratel: </b>". $ponto['ip'] .
                            "<br><b>Tipo link: </b>".$ponto['link'].
                            "<br><b>Velocidade: </b>".$ponto['velo']."k".
                            "<br><b>Dura&ccedil;&atilde;o: </b>".$ponto['duration'] ." </p>";//--REPETIDO
            // $marker[''] =;
            $this->googlemaps->add_marker($marker);
            $count++;
        }
            // Create the map. This will return the Javascript to be included in our pages <head></head> section and the HTML code to be
            // placed where we want the map to appear.
            $data['map'] = $this->googlemaps->create_map();
            // Load our view, passing the map data that has just been created
            $this->load->view('link/my_view', $data);
    }


    public function zabbix() {

          //Load config file
          $this->load->config('zabbix', TRUE);
          // Get breadcrumbs display options
          $api_url = $this->config->item('api_url', 'zabbix');
          $api_user = $this->config->item('api_user', 'zabbix');
          $api_pass = $this->config->item('api_pass', 'zabbix');
          $reload_time = $this->config->item('reload_time', 'zabbix');
          $host_group_filter = $this->config->item('host_group_filter', 'zabbix');
          $context = base_url() . 'assets';
          $result = "";
          $alert = array();
          $retorno = array();
          // connect to Zabbix Json API
          $api = new ZabbixApi($api_url, $api_user, base64_decode($api_pass));
          // Set Defaults
          //     $api->setDefaultParams(array('output' => 'extend',));

              $hosts = $api->hostGet(array(
                'output'=> array('hostid','name','status'),
                // 'output'=> 'extend',
                'sortfield' => 'name',
                // 'selectGroups'=> 'extend',
                'selectInterfaces' => array('ip'),
                'selectInventory' => array('location_lat','location_lon'),
                'groupids' => array(16)//16- novo zabbix(link Acesso) //19,18 - antigo zabbix(link terrestre,link satelite)
              ));

              foreach ($hosts as $host) {
                  $host_id[] = $host->hostid;
              }

              $triggers = $api->triggerGet(array(
                     'output' => array(
                         'priority',
                         'description'),
                     'selectHosts' => array('hostid'),
                         // 'groupids' => $groupIds,
                         'hostids' => $host_id,
                         'expandDescription' => 1,
                         'only_true' => 1,
                         'monitored' => 1,
                         'withLastEventUnacknowledged' => 1,
                      'sortfield' => array('lastchange', 'priority'),
                         'sortorder' => 'DESC',
                      'filter' => array(
                         'priority' => array('5'),
                         'value' => '1')
                 ));
              foreach($triggers as $trigger) {
                 foreach($trigger->hosts as $host) {
                     $hostTriggers[$host->hostid][] = $trigger;
                 }
              }

              foreach ($hosts as $host) {
                  $hostid = $host->hostid;
                  $hostname = $host->name;
                  $hoststatus = $host->status;
                  $hostip = $host->interfaces[0]->ip;
                  if($host->inventory != NULL){
                      $hostlat = $host->inventory->location_lat;
                      $hostlon = $host->inventory->location_lon;
                  } else{
                      $hostlat = "";
                      $hostlon = "";
                  }

                  if($hoststatus == 0){
                      if (array_key_exists($hostid, $hostTriggers)) {
                          $tempo_fora=time2string(time()-strtotime(date('Y-m-d H:i:s', $hostTriggers[$hostid][0]->lastchange)));
                          $count = "0";
                          foreach ($hostTriggers[$hostid] as $event) {
                              if ($count++ <= 2 ) {
                                  // $priority = $event->priority;
                                  // $description = $event->description;
                                  $duration = $tempo_fora;
                                  $priority ="down";

                              } else {
                                  break;
                              }
                          }
                      $result = array(
                        'id' => $hostid,
                        'name' => $hostname,
                        'ip' => $hostip,
                        'latitude' => $hostlat,
                        'longitude' => $hostlon,
                        'duration' => $duration,
                        'type' => $priority
                      );
                      array_push($retorno,$result);
                      } else {
                          $duration = "00:00:00";
                          $priority = "up";
                      }
                  }
              }
              // return 'var data = { "point":'.json_encode($retorno).'}';
              return json_encode($retorno);
    }


    public function teste() {
        $points = json_decode($this->zabbix());
        var_dump($points);
    }

}

/* End of file Gmaps.php */
/* Location: ./application/controllers/Gmaps.php */