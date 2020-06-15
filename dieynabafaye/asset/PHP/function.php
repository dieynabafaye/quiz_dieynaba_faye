<?php
// session_start();
    class Database{
       private $dsn = "mysql:host=localhost;dbname=myquiz";
       private $user = "root";
       private $pwd = "";
       public $conn;
       public function __construct(){
           try {
               $this->conn= new PDO($this->dsn,$this->user, $this->pwd);
           } catch (PDOException $e) {
               echo $e->getMessage();
           }
       }
       /*fonction connection*/
       public function connexion($login,$password){
           try {
               $erreur = "";
            $sql="SELECT * FROM user WHERE login =:login AND password=:password AND privilege != 0";
            $stmt =$this->conn->prepare($sql);
            $stmt->execute(['login'=>$login,'password'=>$password]);
            $count = $stmt->rowCount();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
             if($count >0){
                $_SESSION['prenom'] = $result['prenom'];
                $_SESSION['nom'] = $result['nom'];
                $_SESSION['avatar'] = $result['avatar'];
                $_SESSION['role'] = $result['role'];
                $_SESSION['numuser'] = $result['numuser'];
                $_SESSION['connecter'] = 'connecter';

                if ($result['role']=='joueur') {
                    $_SESSION['monscore'] = 0;
                    $_SESSION['trouver']=array();
                    $_SESSION['data']=array();
                    $_SESSION['bon']=array();
                     $_SESSION['nombre']  = 0;
                    $_SESSION['dejatrouver'] = $this->dejatrouver($result['numuser']);
                    $erreur = 'joueur';
                }
                else{
                    $erreur = 'admin';
                }
             }else{
                 $erreur = "faux";
             }
           }  catch (PDOException $e) {
           // echo $e->getMessage();
        }
        return $erreur;
       }
       /* afficher les joueurs avec leurs score*/
       public function affichejoueur(){
           $sql ="SELECT user.numuser,user.prenom,user.nom,score.score FROM user INNER JOIN score where user.numuser = score.numuser";
           $stmt =$this->conn->prepare($sql);
           $stmt->execute();
           $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
           return $result;

       }
       /*fonction inscription*/
       public function inscription($prenom,$nom,$login,$password,$role,$avatar){
        $error="faux";
        $req="SELECT * FROM user WHERE login =:login ";
        $stmt =$this->conn->prepare($req);
        $stmt->execute(['login'=>$login]);
        $count = $stmt->rowCount();
         if($count >0){
        $error="vrai";
         }else{
             if($role =='joueur'){
                $sql = "INSERT INTO user (prenom,nom,login,password,role,avatar) VALUES(:prenom,:nom,:login,:password,:role,:avatar)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(['prenom'=>$prenom,'nom'=>$nom,'login'=>$login,'password'=>$password,'role'=>$role,'avatar'=>$avatar]);
                $count = $stmt->rowCount();
                    if($count >0){
                        $sql="SELECT numuser FROM user WHERE login=:login";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute(['login'=>$login]);
                        foreach ($stmt as $row){
                            $monid =$row['numuser'];
                        }
                        $score=0;
                        $sql="INSERT INTO score (score,numuser)VALUES(:score,:id)";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute(['score'=>$score,'id'=>$monid]);
                    }
             }else{
            $sql = "INSERT INTO user (prenom,nom,login,password,role,avatar) VALUES(:prenom,:nom,:login,:password,:role,:avatar)";
           $stmt = $this->conn->prepare($sql);
           $stmt->execute(['prenom'=>$prenom,'nom'=>$nom,'login'=>$login,'password'=>$password,'role'=>$role,'avatar'=>$avatar]);
         }
        }
         return $error;
        }
        // details user
        public function detailuser($id){
           
            $sql="SELECT * FROM user WHERE numuser=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }

        // update user
       
            public function updateuser($id,$prenom, $nom, $role, $login, $password, $avatar){
                $sql= "UPDATE user SET prenom=:prenom,nom=:nom,login=:login,password=:password,role=:role,avatar=:avatar WHERE numuser=:id";
                $stmt = $this->conn->prepare($sql);
               $stmt->execute(['prenom'=>$prenom,'nom'=>$nom,'login'=>$login,'password'=>$password,'role'=>$role,'avatar'=>$avatar,'id'=>$id]);
               $count = $stmt->rowCount();
                if($count >0){
                $error="faux";
                }else{
                    $error="vrai";
                }
                return $error;
              }
        
    
    // add questions
    public function addquestions($question,$nbpoint,$type,$reponse,$vrais){
       
        $sql ="INSERT INTO question(nomquestion,nbpoint,type,reponse,vrais)VALUES(:question,:nbpoint,:type,:reponse,:vrais) ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['question'=>$question,'nbpoint'=>$nbpoint,'type'=>$type,'reponse'=>$reponse,'vrais'=>$vrais]);
        return true;  
    }
    //update questions
    public function updatequestion($id,$question,$nbpoint,$type,$reponse,$vrais){
        $sql="SELECT * FROM dejajouer WHERE numquestion=:num";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['num'=>$id]);
        $count = $stmt->rowCount();
         if($count >0){
        $error="vrai";
         }else{
        $sql="UPDATE question SET nomquestion=:newquestion,nbpoint=:newnbpoint,type=:newtype,reponse=:newreponse,vrais=:newvrais WHERE numquestion=:numquestion";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['numquestion'=>$id,'newquestion'=>$question,'newnbpoint'=>$nbpoint,'newtype'=>$type,'newreponse'=>$reponse,'newvrais'=>$vrais]);
        $error ="faux";
        }
        return $error;
    }
    // view questions
    public function viewquestion($id){
        $sql="SELECT * FROM question WHERE numquestion =:id ";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // delete questions
    public function deletequestion($id){
        
        $sql="SELECT * FROM dejajouer WHERE numquestion=:num";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['num'=>$id]);
        $count = $stmt->rowCount();
         if($count >0){
        $error="vrai";
         }else{
        $sql= "DELETE FROM question WHERE numquestion=:num";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['num'=>$id]);
        $error ="faux";
         }
        return $error;
    }
    //lister question
    public function listerquestion(){
        $data=[];
        $sql= "SELECT *FROM question";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $data[]=$row;
        }
        return $data;
    }

    // deja trouver
    public function dejatrouver($idquestion){
        $error="";
        $sql="SELECT * FROM dejajouer WHERE numquestion=:num";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['num'=>$idquestion]);
        $count = $stmt->rowCount();
         if($count >0){
        $error="deja jouer";
         }
         return $error;
        
    }
    // delete joueur
    public function deletejoueur($id){
        $error ="vrai";
        $sql="DELETE  FROM user WHERE numuser=:num";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['num'=>$id]);
        $count = $stmt->rowCount();
        if($count >0){
         $error="faux";
        }
        return $error;
    }
    
     // selection les 5 meilleurs score
     public function meilleurscore(){
        $data = array();
          $sql = "SELECT user.prenom, user.nom ,score.score FROM user INNER JOIN score ON score.numuser = user.numuser ORDER BY score.score DESC LIMIT 5 ";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          $count = $stmt->rowCount();
          foreach ($stmt as  $row) {
            $data[] = $row;
          }
          return $data;
      }
        // selection mon meilleur score
        public function monmeilleurscore($id)
        {
          $data = array();
          $sql = "SELECT user.prenom, user.nom ,score.score FROM user INNER JOIN score ON score.numuser = user.numuser where user.numuser=:id ORDER BY score.score DESC LIMIT 1";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute(['id'=>$id]);
          foreach ($stmt as  $row) {
            $data[] = $row;
          }
          return $data;
        }
        // partie insertion des scores
    public function insertscore($id,$score){
        $sql= "SELECT * FROM score where numuser = :id LIMIT 1";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute(['id' => $id]);
          $count = $stmt->rowCount();
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
         if($count>0){
            if ($result['score'] < $score) {
              $sql = " UPDATE score SET score =:score WHERE numuser=:id";
              $stmt = $this->conn->prepare($sql);
              $stmt->execute(['id' => $id, 'score' => $score]);
            }
         }else{
            $sql = "INSERT INTO score (numuser,score) VALUES(:id,:score)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id, 'score' => $score]);
            
         }
  
      }

      public function rdejatrouver($id){
        $tab = array();
        $sql="SELECT numquestion FROM dejajouer WHERE numuser=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=> $id]);
        foreach($stmt as $row) {
          $tab[]=$row['numquestion'];
          }
          return $tab;
      }


        public function lookquestion ($iduser,$idquestion){
            $t=0;
            $sql="SELECT * FROM dejajouer WHERE numuser=:id AND numquestion=:idques";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$iduser,'idques'=>$idquestion]);
            $count = $stmt->rowCount();
            if($count >0){
              $t = 1;
            }
            return $t;
           }

        public function addplayquestion($tab, $numuser)
      {
        $sql = "INSERT INTO dejajouer( numuser,numquestion) VALUES (:id,:numquestion)";
        $stmt = $this->conn->prepare($sql);
        if (!empty($tab)) {
          if (count($tab) > 1) {
            for ($i = 0; $i < count($tab); $i++) {
              $numquestion = $tab[$i];
              $look = $this->lookquestion($numuser,$numquestion);
              if($look !=1){
              $stmt->execute(['id' => $numuser, 'numquestion' => $numquestion]);
            }
            }
          } elseif (count($tab) == 1) {
            $numquestion = $tab[0];
            $look=$this->lookquestion($numuser,$numquestion);
              if($look !=1){
              $stmt->execute(['id' => $numuser, 'numquestion' => $numquestion]);
            }
          }
        }
        return true;
      }
 
    }

?>