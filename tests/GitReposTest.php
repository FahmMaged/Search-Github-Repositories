<?php
require __DIR__ . "/../GitReposController.php";

class GitReposTest extends \PHPUnit\Framework\TestCase {

    public function testGetRepos()
    {
        $_POST = array("per_page"=>5, "date"=> 2020-05-06, "lang"=> 'php');
        $gitReposObject = new GitReposController();
        $result = $gitReposObject->getRepos();
        $result = json_decode($result, true);
        if(is_array($result)){
            $this->assertCount($_POST['per_page'],$result);
            if(isset($_POST['lang'])){
                foreach($result as $res){
                    $this->assertEquals(strtoupper($_POST['lang']),strtoupper($res['language']));
                }
            }
            
        }
        
    }
}