<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here

        include APPPATH . 'third_party/zabbix/ZabbixApiAbstract.class.php';
        include APPPATH . 'third_party/zabbix/ZabbixApi.class.php';
        include APPPATH . 'third_party/zabbix/date_function.php';

    }

    public function index() {

      //Load config file
      $this->load->config('zabbix', TRUE);
      // Get breadcrumbs display options
      $api_url = $this->config->item('api_url', 'zabbix');
      $api_user = $this->config->item('api_user', 'zabbix');
      $api_pass = $this->config->item('api_pass', 'zabbix');
      $reload_time = $this->config->item('reload_time', 'zabbix');
      $host_group_filter = $this->config->item('host_group_filter', 'zabbix');
      $context = base_url() . 'assets';

        // connect to Zabbix Json API
        $api = new ZabbixApi($api_url, $api_user, base64_decode($api_pass));
        // $api = new ZabbixApi($api_url, $api_user, $api_pass);

        // Set Defaults
        $api->setDefaultParams(array(
                'output' => 'extend',
            ));

        # parse passed items
        // if (isset($_GET['gid'])) {
        //     $groupids = explode(',', $_GET['gid']);
        // } else {
        //     $groupids = array('1');
        // }
        $groupids = array(19,18);

        // if (isset($_GET['name'])) {
        //     $dashboard = $_GET['name'];
        // } else {
        //     $dashboard = " ";
        // }
        $dashboard = "Link";

        echo '    <!DOCTYPE html>';
        echo '    <html>';
        echo '    <head>';
        echo '           <meta charset="UTF-8">';
        echo '          <title>ZbxDash - '. $dashboard .'</title>';
        echo '           <!-- Lets reset the default style properties -->';
        echo '           <link rel="stylesheet" type="text/css" href="'. $context .'/style/reset.css" />';
        echo '            <link rel="stylesheet" type="text/css" href="'. $context .'/style/theme-alt.css" />';
        echo '            <!-- added the jQuery library for reloading the page and future features -->';
        echo '            <script src="'. $context .'/lib/js/jquery-2.1.1.min.js"></script>';
        echo '            <!-- added the masonry js so all blocks are better alligned -->';
        echo '            <script src="'. $context .'/lib/js/masonry.pkgd.min.js"></script>';
        echo '            <!-- Removed this temporary because I disliked the look -->';
        echo '            <!-- <body class="js-masonry"  data-masonry-options="{ "columnWidth": 250, "itemSelector": ".groupbox" }"> -->';
        echo '    </head>';
        echo '    <!-- Second piece of js to gracefully reload the page (value in ms) -->';
        echo '    <script>
                function ReloadPage() {
                   location.reload();
                };
                $(document).ready(function() {
                    setTimeout("ReloadPage()", '. $reload_time .');
                });
            </script>';
        echo '    <body id="bg-one">';

        echo '    <!-- START GET RENDER DATE - Which will show date and time of generating this file -->';
        echo '    <div id="timestamp">';
        echo '        <div id="date">'. date("d F Y", time()) .'</div>';
        echo '        <div id="time">'. date("H:i", time()) .'</div>';
        echo '    </div>';
        echo '    <!-- END GET RENDER DATE -->';
        echo '    <!-- We could use the Zabbix HostGroup name here, but would not work in a nice way when using a dozen of hostgroups, yet! So we hardcoded it here. -->';
        echo '    <div id="sheetname">'. $dashboard .'</div>';

            $groups = $api->hostgroupGet(array(
                   'output' => array('name'),
                   'selectHosts' => array(
                           'flags',
                           'hostid',
                           'name',
                           'maintenance_status'),
                   'real_hosts ' => 1,
                   'groupids' => $groupids,
            #       'with_monitored_triggers' => 1,
                   'sortfield' => 'name'
                ));

            foreach($groups as $group) {
               $groupIds[] = $group->groupid;
            }

            $triggers = $api->triggerGet(array(
                   'output' => array(
                       'priority',
                       'description'),
                   'selectHosts' => array('hostid'),
                       'groupids' => $groupIds,
                       'expandDescription' => 1,
                       'only_true' => 1,
                       'monitored' => 1,
                       'withLastEventUnacknowledged' => 1,
                       // 'sortfield' => 'priority',
                       'sortfield' => array('lastchange', 'priority'),
                       'sortorder' => 'DESC',
                       'filter' => array('priority' => array('4','5'),'value' => '1' , '')
               ));

            foreach($triggers as $trigger) {
               foreach($trigger->hosts as $host) {
                   $hostTriggers[$host->hostid][] = $trigger;
               }
            }
            // verifica se o array não foi criado. caso não tenha seta a variavel vazio.
            if(!isset($hostTriggers)){
                $hostTriggers = "";
            }
            // var_dump($hostTriggers);
            // get all hosts from each groupid
                foreach($groups as $group) {
                    $groupname = $group->name;
                    $hosts = $group->hosts;
                    //ordena o array do menor para o maior ou em ordem alfabetica.
                    usort($hosts, function ($a, $b) {
                        if ($a->name == $b) return 0;
                        return ($a->name < $b->name ? -1 : 1);
                    });
                    echo "<div class=\"groupbox\">"; // Again, we dont want to use the groupfunction yet
                    echo "<div class=\"group-title\">" . strtoupper(preg_replace('/\//',' / ',$groupname)) . "</div>";
                    echo "<div class=\"groupbox js-masonry\" data-masonry-options='{ \"itemSelector\": \".hostbox\" }'\">";

                    if ($hosts) {

                        // print all host IDs
                        foreach($hosts as $host) {
                            // Check if host is not disabled, we don't want them! -- exibi só os ativos
                            if ($host->flags == "0") {

                                $hostid = $host->hostid;
                                $hostname = $host->name;
                                $maintenance = $host->maintenance_status;

                                $hosts_interface = $api->hostinterfaceGet(array(
                                  'output'=> 'extend',
                                  'filter' => array('hostid' => $hostid)
                                ));
                                $ip = $hosts_interface[0]->ip;

                                if($hostTriggers != NULL){

                                  if ( array_key_exists($hostid, $hostTriggers)) {
                                    // Highest Priority error
                                    $hostboxprio = $hostTriggers[$hostid][0]->priority;
                                    $age=time_elapsed_string(date('Y-m-d H:i:s', $hostTriggers[$hostid][0]->lastchange), true);
                                    // $age=date('Y-m-d H:i:s', $hostTriggers[$hostid][0]->lastchange);
                                    //First filter the hosts that are in maintenance and assign the maintenance class if is true
                                    if ($maintenance != "0") {
                                        echo "<div class=\"hostbox maintenance\">";
                                    } else {
                                        // If hosts are not in maintenance, check for trigger(s) and assign the appropriate class to the box
                                        echo "<div class=\"hostbox nok" . $hostboxprio . "\">";
                                    }
                                    echo "<div class=\"title\">" . $hostname ." <br>". $ip ." </div><div class=\"hostid\">" . $hostid ."</div>";
                                    echo "<div> ". $age ."</div>";
                                    $count = "0";
                                    foreach ($hostTriggers[$hostid] as $event) {
                                        if ($count++ <= 2 ) {
                                            $priority = $event->priority;
                                            $description = $event->description;

                                            // Remove hostname or host.name in description
                                            $search = array('{HOSTNAME}', '{HOST.NAME}');
                                            $description = str_replace($search, "", $description);
                                            // View
                                            echo "<div class=\"description nok" . $priority ."\" title=\"" . $description . "\">" . $description . "</div>";
                                        } else {
                                            break;
                                        }
                                    }
                                    echo "</div>";
                                }
                            } /*else {
                                    // If there are no trigger(s) for the host found, assign the "ok" class to the box
                                    echo "<div class=\"hostbox ok\">";
                                    echo "<div class=\"title\">" . $hostname . "</div>";
                                    echo "</div>";
                                }*/
                            }
                        }
                        echo "</div></div>";
                    }
                }
                #$api->userLogout(); # commented out due to a bug in php and Zabbix
        echo '    </body>';
        echo '    </html>';
  }
}

/* End of file dash.php */
/* Location: ./application/controllers/dash.php */