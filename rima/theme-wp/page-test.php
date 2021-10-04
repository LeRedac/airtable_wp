<?php
/*
Template Name: TEST2
*/


/**
 * ==============================================
 * PAGE Les PASS
 *===============================================
 * 
 * @version     1.0.0
 *
 *
 *------------------------------------------------
 */

get_header();  


/*
 * Adhésion Association Webcup – Pour les entreprises ou institutions = 9606
 * Adhésion Association Webcup – Pour les ASSOCIATIONS = 9575
 * Adhésion individuelle Association Webcup = 7321
 * Carte Open Webcup Campus – Résident SHMLR = 64460
 * Carte Open Webcup Campus = 6320
*/



$users = get_users( array( 'fields' => array( 'ID' ) ) );
$nb_boucle = 10;

//$decalage = 0;
//$decalage = 10;
//$decalage = 20;
//$decalage = 30;
//$decalage = 40;
//$decalage = 50;
//$decalage = 60;
//$decalage = 70;
//$decalage = 80; 
//$decalage = 90;
//$decalage = 100;
//$decalage = 110;
//$decalage = 120;
//$decalage = 130;
//$decalage = 140;
//$decalage = 150;
//$decalage = 160;
//$decalage = 170;
//$decalage = 180;
//$decalage = 190;

//$decalage = 200;
//$decalage = 210;
//$decalage = 220;
//$decalage = 230;
//$decalage = 240;
//$decalage = 250;
//$decalage = 260;
//$decalage = 270;
//$decalage = 280;
//$decalage = 290;

//$decalage = 300;
//$decalage = 310;
//$decalage = 320;
//$decalage = 330;
//$decalage = 340;
//$decalage = 350;
//$decalage = 360;
//$decalage = 370; // ID 391 ne marche pas FONTAINE Priscilia
//$decalage = 380;
//$decalage = 390;
//$decalage = 400;

//$decalage = 410;
//$decalage = 420;
//$decalage = 430;
//$decalage = 440;
//$decalage = 450;
$decalage = 460;
//$decalage = 470;

// 469 AU TOTAL


$adhesion = false;
foreach(array_slice($users, $decalage, $nb_boucle) as $user){ 

   echo '<pre>';
print_r($user->ID);
echo '</pre>'; 

$user_id = $user->ID;

$abonnement_adhesions = 7321;
$abonnement_open_campus = 6320;
$abonnement_open_campus_shlmr = 64460;


$abonne = get_abonne_datas($user_id);    
$abonne_commande =get_abonne_commandes($user_id);

    
      
if ($abonne['order_count'] == false){
     
    if (check_user_exist($user_id)){ // L'utilisateur est dèja dans Airtable
    
    echo '<pre>';
    print_r("L'utilisateur est dèja dans Airtable");
    echo '</pre>';

}
else { // L'utilisateur n'est pas enregistré dans Airtable
    
  echo '<pre>';
    print_r("iNSERTION OK");
    echo '</pre>';

    
    $params = array(
        "records"=> [array(
        "fields" => array(
            "ID" => $user_id,
            "Prénom & Nom" => $abonne['prenom'].' '.$abonne['nom'],
            "Prénom" => $abonne['prenom'],
            "Nom" => $abonne['nom'],
            "Role(s)" => $abonne['roles'],
            "Adresse mail" => $abonne['user_email'],
            /*"Notes" => '',*/
            "Date d'inscription" => $abonne['registered'],
            "Téléphone" => $abonne['billing_phone'],
            "Adresse" => $abonne['billing_address_1'],
            "Code Postal" => $abonne['billing_postcode'],
            "Ville" => $abonne['billing_city'], 
        ),
         )],
            "typecast" => true     
    );
    
    
    $work_space = constant("Clients et adhérents");
    $table = constant("tous_les_clients");
    
    post_airtable($params,$work_space,$table);
    $adhesion = false;
    
   
}     
  
  }
    else {
        
      $plan_adhesions = get_abonner_plan($user_id,$abonnement_adhesions);
$plan_open_campus = get_abonner_plan($user_id,$abonnement_open_campus);
$plan_open_campus_shlmr = get_abonner_plan($user_id,$abonnement_open_campus_shlmr);

$first_commande_date = get_first_commande_date($user_id);
$last_commande_date = get_last_commande_date($user_id);
$user_total_vente = get_user_total_vente($user_id);  
        
    
if (check_user_exist($user_id)){ // L'utilisateur est dèja dans Airtable
    
    echo '<pre>';
    print_r("L'utilisateur est dèja dans Airtable");
    echo '</pre>';

}
else { // L'utilisateur n'est pas enregistré dans Airtable
    
  echo '<pre>';
    print_r("iNSERTION OK");
    echo '</pre>';

    
    if ($plan_adhesions){
         $adhesion = true;
    }
    if ($plan_open_campus){
         $open_campus = true;
    }
    if ($plan_open_campus_shlmr){
         $open_campus_shlmr = true;
    }
    
    $params = array(
        "records"=> [array(
        "fields" => array(
            "ID" => $user_id,
            "Prénom & Nom" => $abonne['prenom'].' '.$abonne['nom'],
            "Prénom" => $abonne['prenom'],
            "Nom" => $abonne['nom'],
            "Role(s)" => $abonne['roles'],
            "Adresse mail" => $abonne['user_email'],
            /*"Notes" => '',*/
            "Date d'inscription" => $abonne['registered'],
            "Première commande" => $first_commande_date,
            "Dernière commande" => $last_commande_date,
            "Montant total des commandes" =>format_number_api($user_total_vente),
            "Téléphone" => $abonne['billing_phone'],
            "Adresse" => $abonne['billing_address_1'],
            "Code Postal" => $abonne['billing_postcode'],
            "Ville" => $abonne['billing_city'],
            "Nb commande passé" => format_number_api($abonne['order_count']),
            "Adhérent" => $adhesion,
            "Carte Open Campus" => $open_campus,
            "Carte Open Campus SHLMR" => $open_campus_shlmr   
        ),
         )],
            "typecast" => true     
    );
    
  
    
    $work_space = constant("Clients et adhérents");
    $table = constant("tous_les_clients");
    
    post_airtable($params,$work_space,$table);
    $adhesion = false;
    
    
    $count = count($abonne_commande);
    foreach ($abonne_commande as $abonne_comm){
        $commandes =  $abonne_comm['commande'];
        $params_2 = array(
            "records"=> [array(
                "fields" => array(
                    "ID_commande" => $commandes['id_commande'],
                    "Date de la commande" => $commandes['date_creation'],
                    "ID_client" => ["$user_id"],
                    "Montant total" => format_number_api($commandes['montant_total']),
                    "Statut de la commande" => $abonne_comm['post_status'],
                    "Méthode de réglement" => $commandes['libelle_reglement'],
                    "Montant" =>format_number_api($commandes['montant_total']),
                    "Quantité" => format_number_api($count)
                ),
            )],
            "typecast" => true
        );
        
        $work_space = constant("Clients et adhérents");
        $table = constant("Commandes");
        
         post_airtable($params_2,$work_space,$table);
        
        
  foreach ($commandes['produits'] as $produit){ 
      
      
      if ($produit['type'] == 'simple'){$produit_type = 'Produit simple';}
      if ($produit['type'] == 'grouped'){$produit_type = 'Produits groupés';}
      if ($produit['type'] == 'external'){$produit_type = 'Produit externe/affiliation';}
      if ($produit['type'] == 'variable'){$produit_type = 'Produit variable';}
      if ($produit['type'] == 'booking'){$produit_type = 'Produit réservable';}
      
      $produit_da = array(
            "records"=> [array(
                "fields" => array(
                    "Produit_ID" => $produit['product_id'],
                    "Type" => $produit_type,
                    "Quantité" => format_number_api($produit['qty']),
                    "Intitulé" => $produit['name'],
                    "Montant" =>format_number_api($produit['total']),
                    "Activité" => $produit['type_activite'],
                    "Commande_ID" => ["".format_number_api($commandes['id_commande']).""],
                ),
            )],
            "typecast" => true
        );
        
        $work_space = constant("Clients et adhérents");
        $table = constant("Produits commandés");
        
         post_airtable($produit_da,$work_space,$table);
          

      }
        
        
        
 
        
    }
}    
        
    }  




// #########################################################################

/*slack_notify('Alerte! Hum', [
    'attachments' => [
        [
            'fallback' => 'Test avatar [Urgent]: <http://url_to_task|Test out Slack message attachments>',
            'pretext' => 'Test avatar 2 [Urgent]: <http://url_to_task|Test out Slack message attachments>',
            'color' => '#D00000',
            'fields' => [
                [
                    'title' => 'Notes',
                    'value' => 'Ceci est une notification rouge.',
                    'short' => false
                ]
            ]
        ]
    ]
]);*/
//////////////////////////////////////////////////////



 }
   
?> 


<?php  get_footer(); ?>