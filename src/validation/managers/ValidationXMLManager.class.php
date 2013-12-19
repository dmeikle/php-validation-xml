<?


class ValidationXMLManager{

	private $xml="";
	
	private $path="";
	
	public function __construct($xmlAsString){
		if(isset($xmlAsString))			
		$this->xml = new SimpleXMLElement($xmlAsString);	
	} 
	public function loadXML($path){
		$this->xml=  simplexml_load_file($path);
		$this->path=$path;
	}
	
	//pages->page>>uri attribute
	//echo "page name: ". $pages->page[0]->attributes()->name."\r\n"; //this is the page name
	public function getRulesByPage($pageName){
		foreach($this->xml->children() as $node){
			if($node->attributes()->name==$pageName){
			//	//return the page rules as a string array with 2 columns - field, rules
				return $this->getRules($node);
			}			
		}
		return null;
	}

	//page->fields->fieldName
	private function getRules($node){
		$ruleSet=array();
		foreach($node->rules->children() as $rule){
			$name=trim($rule->attributes()->name);			
			$ruleSet[ "$name" ] = trim((string)$rule);//$rule["firstname"]="Required, String";
			//array_push($ruleSet,$name , trim((string)$rule));
		}
		
		return $ruleSet;
	}
	public function getAllPages(){
		$list=array();
		
		foreach($this->xml->children() as $node){
			$list[]=$node->attributes()->name;
		}
		return $list;
	}
	public function removePage($pageName,$save=true){
		//had to do this HUGE work around since we dont have the dom library installed to handle removing child nodes...
		$newXML=new SimpleXMLElement("<pages></pages>");
		
		$pages = $this->xml->xpath("/pages/page ");
		foreach($pages as $page){			
			if($page->attributes()->name!=$pageName){
				
			 	$element=$newXML->addChild("page");
				$element->addAttribute("name",$page->attributes()->name);
				$rules=$element->addChild("rules");
				foreach($page->rules->children() as $node){
					$rules->addChild("rule", trim((string) $node));
				}
				
			}			
		}
		if($save)
			file_put_contents($this->path, $newXML->asXML());
		else {
			$this->xml=$newXml;
		}	
		 
	}
	public function addPage($pageName,$rules){
		//not a very elegant approach but since we don't have dom lib installed, have to
		//build this manually...
		
		//first, remove this node if it's already existing to avoid dupes
		$this->removePage($pageName,false);
		$element=$this->xml->addChild("page");
		$element->addAttribute("name",$pageName);
		$rules=$element->addChild("rules");
		for($i=0;$i<count(rules);$i++)
			$rules->addChild("rule", $rule[$i]);
		file_put_contents($this->path, $this->xml->asXML());
	}
}

?>