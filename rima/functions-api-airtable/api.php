<?php 
/*
 * Api Airtable fonctions
 * Version 1.1
 * 
*/

/*
 * Clé API Airtable
*/
function airtable_key(){
    return 'xxxxxxxxxxxxxxxx'; // Clé API AIRTABLE
}
/////////////////////////////////////////////////

define('api_url', 'https://api.airtable.com/v0');
/*constant("Commandes")*/

// BASE Clients et adhérents
define('Clients et adhérents', 'appXXXXXXXXXXXXXXX');
// Usage : echo constant("Clients et adhérents");

// TABLE Tout les clients
    define('tous_les_clients', 'tbXXXXXXXXXXXXXXXX');
    // Usage : echo constant("tous_les_clients");

    // TABLE Commandes
    define('Commandes', 'tblX3dJFKFAjFSFqq');
    // Usage : echo constant("Commandes");

    // TABLE Produits commandés
    define('Produits commandés', 'tblRmUyysgGsDqhgd');
    // Usage : echo constant("Produits commandés");

/*
 * Fonction  GET 
 * 
 * 3 paramètres
 *     - $work_space nom de la table
 *     - $table Le nom de la table
 *     - valeur recherché
*/

function get_airtable($work_space,$table,$url){
          
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => ''.constant("api_url").'/'.$work_space.'/'.$table.''.$url.'',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'Authorization: Bearer '.airtable_key().'',
          'Cookie: brw=brwqcCIFycIM5up5M'
        ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    $parsed_json = json_decode($response);
    
    return $parsed_json->records[0]->fields;
}

///////////////////////////////////////////////////////

/*
 * Fonction POST 
 * Ajouter un enregistrement
 * 4 paramètres : 
 *     - un array des datas du formulaire
 *     - le nom de l'espace de travail Airtable
 *     - Le nom de la table
 *     - La clé API Airtable
*/

function post_airtable($params,$work_space,$table){
    
    $params = json_encode($params);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => ''.constant("api_url").'/'.$work_space.'/'.$table.'',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$params,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.airtable_key().'',
            'Content-Type: application/json',
            'Cookie: brw=brwqcCIFycIM5up5M'
        ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    
   return $response; // Pour test    
}
///////////////////////////////////////////////////////
function check_produit_exist($id){
    
    $work_space = constant("Clients et adhérents");
    $table = constant("Produits commandés");
    $url = '?filterByFormula={Produit_ID}="'.$id.'"'; 
    
    $check_produit = get_object_vars(get_airtable($work_space,$table,$url)) ? TRUE : FALSE;
    
    if($check_produit) {
        return true;
    }
    else
    {
        return false;
    }
}


function check_user_exist($id){
    
    $work_space = constant("Clients et adhérents");
    $table = constant("tous_les_clients");
    $url = '?filterByFormula={ID}="'.$id.'"'; 
    
    $check_user = get_object_vars(get_airtable($work_space,$table,$url)) ? TRUE : FALSE;
    
    if($check_user) {
        return true;
    }
    else
    {
        return false;
    }
}

/**
 * Send a notify to Slack
 * @param  string $msg   The message
 * @param  array  $param Slack API option ( https://api.slack.com/docs/messages/builder )
 * @return boolean
 */
function slack_notify($msg='', $param=[]){
	try {
		$endpoint = 'https://hooks.slack.com/services/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';
		$data = array_merge([
			'channel'  => '#demande-individuelle',
			'icon'     => 'https://team.webcup.fr/wp-content/uploads/sites/16/2021/10/ProfilePicture-2.png',
			'username' => 'alan',
			'text'     => $msg
		], $param);
		if(preg_match("#^\:#", $data['icon'])){
			$data['icon_emoji'] = $data['icon'];
		}
		else{
			$data['icon_url'] = $data['icon'];
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "payload=".json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		return true;
		curl_close($ch);
	} catch (Exception $e) { return false; }
}

//////////////////////////////////////////////////////////////////////////////////////////
function get_abonne_datas($user_id){
    
    $user_datas = array();
    
    // Get WP user datas
    $user_info = get_userdata($user_id);
    $nom = $user_info->last_name;
    $nom = strtoupper($nom);
    $nom = str_replace(
        array('é', 'è', 'ê', 'ë', 'à', 'â', 'î', 'ï', 'ô', 'ù', 'û'),
        array('É', 'È', 'Ê', 'Ë', 'À', 'Â', 'Î', 'Ï', 'Ô', 'Ù', 'Û'),
    $nom
    );
    $user_datas['nom'] = $nom;
    
    $prenom = $user_info->first_name;
    $prenom = ucfirst(strtolower($prenom));
    $user_datas['prenom'] = ucfirst(strtolower($prenom));
    
    $user_email = $user_info->user_email; 
    $user_datas['user_email'] = $user_email;
    
    $user_datas['registered']  = $user_info->user_registered;
    $user_datas['roles'] = isset($user_info->roles) && !empty($user_info->roles) ? implode(' | ', $user_info->roles) : "N/A";
    
    $metas_user = get_user_meta($user_id);
    if (array_key_exists("billing_first_name",$metas_user)){
        $user_datas['billing_address_1'] = $metas_user['billing_address_1'][0];
        $user_datas['billing_city'] =$metas_user['billing_city'][0];
        $user_datas['billing_postcode'] = $metas_user['billing_postcode'][0];
        $user_datas['billing_phone'] = $metas_user['billing_phone'][0];
        $user_datas['order_count'] = $metas_user['_order_count'][0];
    } 
    
  return $user_datas;
    
}

///////////////////////////////////////////////////////////////////////////////
    function get_all_orders($user_id) {
        
        
        $customer_orders = get_posts(apply_filters('woocommerce_my_account_my_orders_query', array(
            'numberposts' => -1,
            'meta_key' => '_customer_user',
            'meta_value' => $user_id,
            'post_type' => wc_get_order_types(),
            'post_status' => array_keys(wc_get_order_statuses())
                )));
        return $customer_orders;
    }
//////////////////////////////////////////////////////////////////////////////////////
    function check_user_plan($user_id,$plan){
        
        $user_adherent = wc_memberships_get_user_membership($user_id,$plan);
        $plan_datas = array();
        if(!empty($user_adherent)) {
            $plan_datas['plan_name'] = $user_adherent->plan->name;
            $plan_datas['start_date'] = get_post_meta( $user_adherent->id, '_start_date', true ); 
            $plan_datas['end_date'] = get_post_meta( $user_adherent->id, '_end_date', true );
            return $plan_datas;
        }
        else {
            return false;
        }
    }

//////////////////////////////////////////////////////////////////////////////////////
function get_abonne_commandes($user_id){
    
    foreach (get_all_orders($user_id) as $customer_order) {
        $orderq = wc_get_order($customer_order);
        $Order_Array[] = [
            "ID" => $orderq->get_id(),
            "montant" => $orderq->get_total(),
            "Date" => $orderq->get_date_created()->date_i18n('Y-m-d'),
            "post_status" => $orderq->post_status,
            "commande" => commandes_datas($orderq->get_id()),
        ];
    }
    
    return $Order_Array;
    
}
/////////////////////////////////////////////////////////////////////////
function get_abonner_plan($user_id,$abonnement){
    
    if (function_exists('wc_memberships')) {
        $user_datas = array();
        if (check_user_plan($user_id,$abonnement)){
            $user_plan = check_user_plan($user_id,$abonnement);
            $user_datas['plan_name'] = $user_plan['plan_name'];
            $user_datas['start_date'] = $user_plan['start_date'];
            $user_datas['end_date'] = $user_plan['end_date'];
            
            return $user_datas;
        } 
        else { 
            return $false;
        }
        
    }
    else {
        return $false;
    }
}
//////////////////////////////////////////////////////////////////////////
function get_commande_statuses(){
    
    $result = array();
    if(function_exists( 'wc_get_order_statuses' )){
        $result['version'] = 2.2;
        //[slug] => name
        $result['statuses'] = wc_get_order_statuses();
    }
    else
    {
        $args = array(
            'hide_empty'   => false, 
            'fields'            => 'id=>name', 
        );
        $result['version'] = 2.1;
        //[id] => name
        $result['statuses'] =  get_terms('shop_order_status', $args);
    }
    return $result;
}

////////////////////////////////////////////////////////////////////////
function get_first_commande_date($user_id){
    if(!$user_id)
        return false;
    
    $version_and_statuses = get_commande_statuses();
    
    $tax_query = array();
    $statuses = 'publish';
    $orders=array();
    if($version_and_statuses['version'] > 2.1){
        $statuses = array_keys($version_and_statuses['statuses']);
    }
    else {
        $tax_query = array( array(
            'taxonomy' => 'shop_order_status',
            'field'           => 'slug',
            'terms'         => $version_and_statuses['statuses']
        ) );
    }
    
    $args = array(
        'numberposts'     => 1,
        'meta_key'        => '_customer_user',
        'meta_value'      => $user_id,
        'post_type'       => 'shop_order',
        'orderby'          => 'date',
        'order'            => 'asc',
        'post_status' => $statuses,
        'tax_query' => $tax_query
    );
    
    $orders=get_posts($args); 	
    if($orders && isset($orders[0]))
        return $orders[0]->post_date;
    return esc_html__('No orders', 'woocommerce-orders-ei' );
}

////////////////////////////////////////////////
function get_last_commande_date($user_id){
    
    if(!$user_id)
        return false;
    
    $version_and_statuses = get_commande_statuses();
    $tax_query = array();
    $statuses = 'publish';
    $orders=array();//order ids
    if($version_and_statuses['version'] > 2.1){
        $statuses = array_keys($version_and_statuses['statuses']);
    }
    else
    {
        $tax_query = array( array(
            'taxonomy' => 'shop_order_status',
            'field'           => 'slug',
            'terms'         => $version_and_statuses['statuses']
        ) );
    }
    
    $args = array(
        'numberposts'     => 1,
        'meta_key'        => '_customer_user',
        'meta_value'      => $user_id,
        'post_type'       => 'shop_order',
        'post_status' => $statuses,
        'orderby'          => 'date',
        'tax_query' => $tax_query
    );
    
    $orders=get_posts($args); 
    if($orders && isset($orders[0]))
        return $orders[0]->post_date;
    return esc_html__('No orders', 'woocommerce-orders-ei' );
}
//////////////////////////////////////////////////////////////////////////////
function get_user_total_vente($user_id){
    
    global $wpdb;
    $customer_condition = "";
    $meta_key = "_billing_email";
    $customer_condition = " AND ordermeta_customer.meta_value = '".$user_id."' ";
    $meta_key = "_customer_user";
    
    $query_string = "  SELECT DISTINCT GROUP_CONCAT(posts.ID), SUM(meta.meta_value) AS total_sales, ordermeta_customer.meta_value as customer_email FROM {$wpdb->posts} AS posts								
                   INNER JOIN {$wpdb->postmeta} AS meta ON posts.ID = meta.post_id ".//$query_addons['join'].
                    " INNER JOIN {$wpdb->postmeta} AS ordermeta_customer ON ordermeta_customer.post_id = posts.ID 
                      WHERE 	meta.meta_key 		= '_order_total'
                      AND 	posts.post_type 	= 'shop_order' ".$customer_condition.
                   "  AND     ordermeta_customer.meta_key = '{$meta_key}'".
                  "	GROUP BY ordermeta_customer.meta_value	";
    $wpdb->query('SET group_concat_max_len=5000'); 
    $result = $wpdb->get_col($query_string,1);
    $result = is_array($result) && count($result) > 0 ? max($result) : 0;
    return $result;	
}
//////////////////////////////////////////////////////////////////////////
function format_number_api($number){
    
    $english_format_number = number_format($number, 2, '.', '');
    
    // Being sure the string is actually a number
    if (is_numeric($english_format_number))
        $number = $english_format_number + 0;
    else // Let the number be 0 if the string is not a number
        $number = 0;
    return $number;
}
/*
 * Fonction CURL POST 
 * Ajouter un enregistrement
 * 4 paramètres :
 *     - $work_space nom de la table
 *     - $datas un array des datas
 *     - $table Le nom de la table
 *     - Request : POST GET etc
*/




/*function airtable($work_space,$datas,$table,$request){
    
    $datas = json_encode($datas);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => ''.constant("api_url").'/'.$work_space.'/'.$table.'',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $request, 
        CURLOPT_POSTFIELDS =>$datas,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.api_key().'',
            'Content-Type: application/json',
            'Cookie: brw=brwqcCIFycIM5up5M'
        ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    */
   /* return $response; // Pour test*/    
/*}*/

///////////////////////////////////////////////////////////////////////////
// TEST
    // Insertion des données dans Airtable
/*    $datas = array(
        "fields" => array(
            'Nom & prénom' => $nom_prenom,
            'Poste' => $poste, // Liste déroulante
            'Photo' => array(
                 ['url' => $url_photo],    
            ),
            'Email Webcup' => $email_webcup,
            'Adresse' => $adresse,
            'Code postal' => $code_postal,
            'Ville' => $ville,
            'Adresse mail' => $email,
            'Téléphone personel' => $telephone,
            'Site affecté' => [$site],
            'Date de naissance' => $date_naissance,
            'Test'  => $date_naiss
        ),
    );
    
    $request = 'POST';
    $table = constant("salaries"); // Tableau
    
    // Fonction CURL POST (api-airtable.php)
    airtable($datas,$table,$request); */