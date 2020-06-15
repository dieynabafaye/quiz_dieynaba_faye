<?php
  function decouper($chaine){
      $resultat=array();
      if(!empty($chaine)){
        $reponse = substr($chaine,1);
        $resultat = explode('-',$reponse);
      }
      return $resultat;
  }

//   cocher les reponses vrais
function  cocher($tab,$indice){
    if(!empty($tab)){
        if(count($tab)>1){
            if(in_array($indice,$tab)){
                echo "checked";
            }
        }
    }
}

function cocher2($tab,$indice){
    if($tab==$indice){
        echo "checked";
    }  
}


function ajouer2($jouer,$tous){
    $tab =array();
    if(!empty($jouer)){
      if(count($tous)>1){
        for ($i=0; $i <count($tous) ; $i++) {
          if (!in_array($tous[$i]['numquestion'], $jouer)) {
            array_push($tab, $tous[$i]);
          }
        }
      }elseif (count($tous)==1) {
        if(!in_array($tous[0]['numquestion'], $jouer)){
          array_push($tab, $tous[0]);
        }
      }
    }else{
        $tab=$tous;
    }
  
    return $tab;
  }



  // fonction de recuoeration des donnees poster
function recupdonne($post){
    unset($_POST[$post]);
   return($_POST);
}


// parcourir un tableau et recuperer les bonnes reponses
function lesbonnes($tabl){
    $tab = array();
    if($tabl['type']=="choixMultiple"){
           $nbvrai =count($tabl['vrais']);
           if($nbvrai>1){
             for($i=0;$i<$nbvrai;$i++){
               $levrai =$tabl['vrais'][$i];
               array_push($tab,$levrai);
             }
           } elseif ($nbvrai==1) {
               $levrai =$tabl['vrais'][0];
               array_push($tab,$levrai);
           }else{
             $tab=array();
           }

           return $tab;
     }
     elseif ($tabl['type']=="choixSimple") {
           if(!empty($tabl['vrais'])){
               $levrai =$tabl['vrais'];
               array_push($tab,$levrai);
           }else{
             $tab=array();
           }


     }else{
       if(!empty($tabl['vrais'])){
               $levrai =$tabl['vrais'];
               array_push($tab,$levrai);
           }else{
             $tab=array();
           }

     }
     return $tab;
    }

 //
    function lesbonreponses($tablll){
     $tab = array();
    if($tablll['type']=="choixMultiple"){
           $p=substr($tablll['vrais'], 1);
           $semi = explode('-',$p);
           $nbvrai =count($semi);
           if($nbvrai>1){
             for($i=0;$i<$nbvrai;$i++){
               $levrai =$semi[$i];
               array_push($tab,$levrai);
             }
           } elseif ($nbvrai==1) {
               $levrai =$semi[0];
               array_push($tab,$levrai);
           }else{
             $tab=array();
           }


     }
     elseif ($tablll['type']=="choixSimple") {
       # code

           if(!empty($tablll['vrais'])){
               $levrai =$tablll['vrais'];
               array_push($tab,$levrai);
           }else{
             $tab=array();
           }


     }else{
       if(!empty($tablll['vrais'])){
               $levrai =$tablll['vrais'];
               array_push($tab,$levrai);
           }else{
             $tab=array();
           }

     }
     return $tab;
    }

// fonction pour comparer deux tabllleaux
function identical_values( $arrayA , $arrayB){
   sort($arrayA);
   sort($arrayB);

   return $arrayA==$arrayB;
}

function replacevrais($tab1,$tab2,$indice){
 if($tab1[$indice]['numquestion']==$tab2['numquestion']){
   $test=1;
 }

 return $test;
}
function reponsecocher($tab){
 $tab2=array();
 if($tab['type']=="choixMultiple"){
     if(count($tab['vrais'])>1){
       for ($i=0; $i <count($tab['vrais']) ; $i++) {
         array_push($tab2,($tab['vrais'][$i]));
       }
     }elseif (count($tab['vrais'])==1) {
       array_push($tab2, $tab['vrais']);
     }
 }elseif($tab['type']=="choixSimple"){
     $tab2 =$tab['vrais'];
 }else{
   $tab2 =$tab['vrais'];
 }
 return $tab2;
}

function check($valeur,$tableau){
 if(in_array($valeur, $tableau)){
   echo "checked";
 }
}

function cocher5($valeur,$tableau){
 if (empty($tableau)) {
  return false;
 }else{
 if(in_array($valeur, $tableau)){
   return true;
 }
}
}

function cocher4($valeur,$tableau){
 if($valeur==$tableau){
   return true;
 }

}


function check2($valeur,$tableau){
 if($valeur==$tableau){
   echo "checked";
 }
}
function cocher3($valeur,$tableau,$valeur1){//$valeur = ce donner par le joueur  //$tableau la reponse cocher  //$valeur1 la bonne reponse correcte
 $p=0;
if($valeur==$tableau  && $valeur== $valeur1 && $tableau ==$valeur1){
 $p=1;
}
return $p;
}


function replacetrouver($id,$tab){
 if (count($tab)>1) {
   for ($i=0; $i <count($tab) ; $i++) {
       if($tab[$i]==$id){
         $tab[$i]='';
       }
   }
 }elseif (count($tab)==1) {
    if ($tab==$id) {
          $tab='';
    }
 }
 return $tab;
}

function ajouer($trouver,$tab2){
 $tab = array();
 if(!empty($trouver)){
     if(!empty($tab2)){
       if(count($trouver)>1){
         if(count($tab2)>1){
           for ($i=0; $i <count($trouver) ; $i++) {
             for ($j=0; $j <count($tab2) ; $j++) {
               $question = $trouver[$i];
               $jouer= $tab2[$j]['numquestion'];
               if($question!= $jouer){
                 array_push($tab, $tab2[$j]);
               }
             }
           }
         }elseif (count($tab2)==1) {
            for ($i=0; $i <count($trouver) ; $i++) {
              $question = $trouver[$i];
              if($question != $tab2['numquestion']){
                 array_push($tab, $tab2[0]);
               }
             }
         }
       }elseif (count($trouver)==1) {
         if(count($tab2)>1){
             for ($j=0; $j <count($tab2) ; $j++) {
               $question = $trouver[0];
               $jouer= $tab2[$j]['numquestion'];
               if($question != $jouer){
                 array_push($tab, $tab2[$j]);
               }
             }

         }elseif (count($tab2)==1) {
           $question = $trouver[0];
               $jouer= $tab2['numquestion'];
               if($question != $jouer){
                 array_push($tab, $tab2);
               }
         }
       }
     }else{
       $tab='';
     }
 }else{
   if(!empty($tab2)){
     $tab=$tab2;
   }
 }
return $tab;
}
?>