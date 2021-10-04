<?php
function meta_participant($qty,$item){
        
        $participant = array();
        $participant_1 = array();
        $participant_2 = array();
        $participant_3 = array();
        $participant_4 = array();
        $participant_5 = array();
        $participant_6 = array();
        
        if ($qty == 1){
            $participant_1["non"] = $item->get_meta('_participant_0')['value'];
            $participant_1["prenom"] = $item->get_meta('_participant_1')['value'];
            $participant_1["age"] = $item->get_meta('_participant_2')['value'];
      
            unset($participant_2["non"]);
            unset($participant_2["prenom"]);
            unset($participant_2["age"]);
            
            unset($participant_3["non"]);
            unset($participant_3["prenom"]);
            unset($participant_3["age"]);
            
            unset($participant_4["non"]);
            unset($participant_4["prenom"]);
            unset($participant_4["age"]);
            
            unset($participant_5["non"]);
            unset($participant_5["prenom"]);
            unset($participant_5["age"]);
            
            $participant[0] = $participant_1;
        }
        elseif ($qty == 2){
                
             $participant_1["non"] = $item->get_meta('_participant_0')['value'];
             $participant_1["prenom"] = $item->get_meta('_participant_2')['value'];
             $participant_1["age"] = $item->get_meta('_participant_4')['value'];
             
             $participant_2["non"] = $item->get_meta('_participant_1')['value'];
             $participant_2["prenom"] = $item->get_meta('_participant_3')['value'];
             $participant_2["age"] = $item->get_meta('_participant_5')['value'];
            
            unset($participant_3["non"]);
            unset($participant_3["prenom"]);
            unset($participant_3["age"]);
            
            unset($participant_4["non"]);
            unset($participant_4["prenom"]);
            unset($participant_4["age"]);
            
            unset($participant_5["non"]);
            unset($participant_5["prenom"]);
            unset($participant_5["age"]);
            
            unset($participant_6["non"]);
            unset($participant_6["prenom"]);
            unset($participant_6["age"]);

            $participant[0] = $participant_1;
            $participant[1] = $participant_2;
            
        }
        elseif ($qty == 3){
            
            $participant_1["non"] = $item->get_meta('_participant_0')['value'];
            $participant_2["non"] = $item->get_meta('_participant_1')['value'];
            $participant_3["non"] = $item->get_meta('_participant_2')['value'];
            
            $participant_1["prenom"] = $item->get_meta('_participant_3')['value'];
            $participant_2["prenom"] = $item->get_meta('_participant_4')['value'];
            $participant_3["prenom"] = $item->get_meta('_participant_5')['value'];
            
            $participant_1["age"] = $item->get_meta('_participant_6')['value'];
            $participant_2["age"] = $item->get_meta('_participant_7')['value'];
            $participant_3["age"] = $item->get_meta('_participant_8')['value'];
            
            unset($participant_4["non"]);
            unset($participant_4["prenom"]);
            unset($participant_4["age"]);
            
            unset($participant_5["non"]);
            unset($participant_5["prenom"]);
            unset($participant_5["age"]);
            
            unset($participant_6["non"]);
            unset($participant_6["prenom"]);
            unset($participant_6["age"]);
            
            $participant[0] = $participant_1;
            $participant[1] = $participant_2;
            $participant[2] = $participant_3;
            
            
        } 
        elseif ($qty == 4){
            
            $participant_1["non"] = $item->get_meta('_participant_0')['value'];
            $participant_2["non"] = $item->get_meta('_participant_1')['value'];
            $participant_3["non"] = $item->get_meta('_participant_2')['value'];
            $participant_4["non"] = $item->get_meta('_participant_3')['value'];
            
            $participant_1["prenom"] = $item->get_meta('_participant_4')['value'];
            $participant_2["prenom"] = $item->get_meta('_participant_5')['value'];
            $participant_3["prenom"] = $item->get_meta('_participant_6')['value'];
            $participant_4["prenom"] = $item->get_meta('_participant_7')['value'];
            
            $participant_1["age"] = $item->get_meta('_participant_8')['value'];
            $participant_2["age"] = $item->get_meta('_participant_9')['value'];
            $participant_3["age"] = $item->get_meta('_participant_10')['value'];
            $participant_4["age"] = $item->get_meta('_participant_11')['value'];
             
            unset($participant_5["non"]);
            unset($participant_5["prenom"]);
            unset($participant_5["age"]);
            
            unset($participant_6["non"]);
            unset($participant_6["prenom"]);
            unset($participant_6["age"]);
            
            $participant[0] = $participant_1;
            $participant[1] = $participant_2;
            $participant[2] = $participant_3;
            $participant[3] = $participant_4;
            
        }
        elseif ($qty == 5){
            
            $participant_1["non"] = $item->get_meta('_participant_0')['value'];
            $participant_2["non"] = $item->get_meta('_participant_1')['value'];
            $participant_3["non"] = $item->get_meta('_participant_2')['value'];
            $participant_4["non"] = $item->get_meta('_participant_3')['value'];
            $participant_5["non"] = $item->get_meta('_participant_4')['value'];
            
            $participant_1["prenom"] = $item->get_meta('_participant_5')['value'];
            $participant_2["prenom"] = $item->get_meta('_participant_6')['value'];
            $participant_3["prenom"] = $item->get_meta('_participant_7')['value'];
            $participant_4["prenom"] = $item->get_meta('_participant_8')['value'];
            $participant_5["prenom"] = $item->get_meta('_participant_9')['value'];
            
            $participant_1["age"] = $item->get_meta('_participant_10')['value'];
            $participant_2["age"] = $item->get_meta('_participant_11')['value'];
            $participant_3["age"] = $item->get_meta('_participant_12')['value'];
            $participant_4["age"] = $item->get_meta('_participant_13')['value'];
            $participant_5["age"] = $item->get_meta('_participant_14')['value'];
             
            unset($participant_6["non"]);
            unset($participant_6["prenom"]);
            unset($participant_6["age"]);
            
             $participant[0] = $participant_1;
             $participant[1] = $participant_2;
             $participant[2] = $participant_3;
             $participant[3] = $participant_4;
             $participant[4] = $participant_5;
            
        }
        elseif ($qty == 6){
            
            $participant_1["non"] = $item->get_meta('_participant_0')['value'];
            $participant_2["non"] = $item->get_meta('_participant_1')['value'];
            $participant_3["non"] = $item->get_meta('_participant_2')['value'];
            $participant_4["non"] = $item->get_meta('_participant_3')['value'];
            $participant_5["non"] = $item->get_meta('_participant_4')['value'];
            $participant_6["non"] = $item->get_meta('_participant_5')['value'];
            
            $participant_1["prenom"] = $item->get_meta('_participant_6')['value'];
            $participant_2["prenom"] = $item->get_meta('_participant_7')['value'];
            $participant_3["prenom"] = $item->get_meta('_participant_8')['value'];
            $participant_4["prenom"] = $item->get_meta('_participant_9')['value'];
            $participant_5["prenom"] = $item->get_meta('_participant_10')['value'];
            $participant_6["prenom"] = $item->get_meta('_participant_11')['value'];
            
            $participant_1["age"] = $item->get_meta('_participant_12')['value'];
            $participant_2["age"] = $item->get_meta('_participant_13')['value'];
            $participant_3["age"] = $item->get_meta('_participant_14')['value'];
            $participant_4["age"] = $item->get_meta('_participant_15')['value'];
            $participant_5["age"] = $item->get_meta('_participant_16')['value'];
            $participant_6["age"] = $item->get_meta('_participant_17')['value'];
             
            
             $participant[0] = $participant_1;
             $participant[1] = $participant_2;
             $participant[2] = $participant_3;
             $participant[3] = $participant_4;
             $participant[4] = $participant_5;
             $participant[5] = $participant_6;
            
        }
        
        return $participant;
    }

function commandes_datas($order_id){
    
    $order = new WC_Order( $order_id ); 
    // Commande
    $date_creation = $order->get_date_created(); // Recupere la date
    $date_creation = $date_creation->date("Y-m-d"); // Formater la date
    $statut_commande = $order->status; // Statut de la commande
    $type_reglement = $order->payment_method; // Type de reglement
    $libelle_reglement = $order->payment_method_title; // Libellé du type de réglement

    // Client
    $client_id = $order->customer_id; // ID Client
    $client_mail = $order->get_billing_email(); // email client
    $client_nom = $order->get_billing_first_name(); // email client
    $client_prenom = $order->get_billing_last_name(); // email client
    $client_adresse = $order->get_billing_address_1(); // email client
    $client_ville = $order->get_billing_city(); // email client
    $client_codepostal = $order->get_billing_postcode(); // email client

    // Produit
    $items = $order->get_items();

    if ($items){
    
        $values = array();
        $values["id_commande"] = $order->get_id();
        $values["date_creation"] = $date_creation;
        $values["statut_commande"] = $statut_commande;
        $values["type_reglement"] = $type_reglement;	
        $values["libelle_reglement"] = $libelle_reglement;
        $values["client_id"] = $client_id;
        $values["client_mail"] = $client_mail;
        $values["client_prenom"] = $client_prenom;
        $values["client_nom"] = $client_nom;
        $values["client_adresse"] = $client_adresse;
        $values["client_ville"] = $client_ville;  
        $values["client_codepostal"] = $client_codepostal; 
    
        $order_data = $order->get_data(); // The Order data
        $values["montant_total"] = $order_data['total'];
       
    

        $u = 0;
        $pi = 0;
        $item_values = array();
        $participants = array();

       
           
           foreach ($items as $item_id => $item ) {

            
              $terms = get_the_terms($item['product_id'], 'product_type');
            $item_values["type"] = $terms[0]->name; 
            
            if ( $item->get_meta('lieu') ) {
                $item_values["lieu"] = $item->get_meta('lieu'); 
            }
            if ( $item->get_meta('date') ) {
                $item_values["date"] = $item->get_meta('date'); 
            }
            
            $item_values["product_id"] = $item['product_id']; 
            $item_values["qty"] = $item['qty']; 
            $item_values["name"] = $item['name']; 
            $item_values["subtotal"] = $item['subtotal']; 
            $item_values["total"] = $item['total'];
            
            $type_activite = get_the_terms( $item['product_id'], 'product_cat' );
            $item_values["type_activite"] = join(', ', wp_list_pluck($type_activite, 'name'));
    
            $qty =  $item['qty'];
            $item_values["participant"] = meta_participant($qty,$item); 
            $values["produits"][$u] = $item_values; 
            $u++;
            $pi++;
        } 
       }
         
    
    return $values;
}