<?php
  class GitReposController {
    public function getRepos(){
      $per_page = 0;
      $date = '';
      if(isset($_POST['per_page'])){
        $per_page = $_POST['per_page'];
      }
      if(isset($_POST['date'])){
        $date = $_POST['date'];
      }
      
      $query    = "q=created:>".$date."&per_page=".$per_page."";
      if(!empty($_POST['lang'])){
        $lang = $_POST['lang'];
        $query = "q=language:".$lang."&created:>".$date."&per_page=".$per_page."";
      }
      
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Authorization: token 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'
      ));
      curl_setopt($ch, CURLOPT_URL, "https://api.github.com/search/repositories?".$query."&sort=stars&order=desc");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_USERAGENT, "php/curl");
      // Add the path to your curl-ca-bundle.crt
      curl_setopt($ch, CURLOPT_CAINFO, "D:\\xampp\apache\bin\curl-ca-bundle.crt");

      $output  = curl_exec($ch);
      $err     = curl_errno($ch);
      $errmsg  = curl_error($ch);
      $info = curl_getinfo($ch);
      curl_close($ch);
      $result = json_decode($output);
      
      if(isset($result->items))
      {
        echo json_encode($result->items);
        return json_encode($result->items);
      } else{
        echo json_encode("There is no repositories with this criteria ");
        return json_encode("There is no repositories with this criteria ");
      }
    }

  }

$gitRepoObject = new GitReposController();
return $gitRepoObject->getRepos();
  
?>

