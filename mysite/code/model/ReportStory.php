<?php

class ReportStory extends BlogPost {

	private static $db = array(
		'AuthorEmails' => 'Text'
	);

	private static $many_many = array(
		'Sections' => 'ReportSection'
	);

	private static $singular_name = 'Story';

	private static $plural_name = 'Stories';

	private static $summary_fields = array('Title', 'ContributingSections');

	public function getCMSFields() {
		$f = parent::getCMSFields();
		$f->removeByName('PublishDate');
		// $f->removeByName('Authors');


		$authorEmailField = TextareaField::create('AuthorEmails', 'Author email addresses (comma separated)')->setRows(3);
		$member = Member::currentUser();

		$sectionField = ListboxField::create('Sections', 'Departments / Section(s)', ReportSection::get()->map()->toArray())->setMultiple(true);
		if (!Permission::checkMember($member, 'ADMIN')) {

			$sectionField->setDisabled(true);
		}
		$f->addFieldToTab("Root.Main", $sectionField, 'Content');
		$f->addFieldToTab("blog-admin-sidebar", $authorEmailField);



		return $f;
	}

	public function getContributingSections(){
		$sections = $this->Sections();
		$list = '';
		foreach($sections as $section){
			$list .= $section->Title.' ';
		}
		return $list;
	}

	public function populateDefaults() {
		//set attributes before calling parent::populateDefaults();

	    // $member = Member::currentUser();

	    // if($member){
		   //  $memberSections = $member->Sections();

		   //  foreach($memberSections as $section){
		   //  	$this->Sections()->add($section);
		   //  }

	    // }

	    parent::populateDefaults();
	}

	public function RelatedStories(){

	}

public function onBeforeWrite() {
    // check on first write action, aka "database row creation" (ID-property is not set)
    if(!$this->isInDb()) {

    }

    // check on every write action:
    $authorEmails = $this->AuthorEmails;

    $authorEmailsArray = explode(',', trim($authorEmails));
    //print_r($authorEmailsArray);
    foreach ($authorEmailsArray as $email){
    	if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  			// echo("$email is a valid email address");
  			if (Member::get()->filter(array('Email' => $email))->First()){
  				$author = Member::get()->filter(array('Email' => $email))->First();
  				$this->Authors()->add($author);
  			}
  			else{
  				$userLookup = $this->lookupUser($email);
				if($userLookup){
					$m = new Member();
					$m->FirstName = $userLookup['firstName'];
					$m->Surname = $userLookup['lastName'];
					$m->Email = $email;
					$m->GUID = $userLookup['guid'];
					$m->write();
					$this->Authors()->add($m);
				}
  			}
		}
		// else { echo("$email is not a valid email address"); }
    }
    // CAUTION: You are required to call the parent-function, otherwise
    // SilverStripe will not execute the request.
    parent::onBeforeWrite();
  }

  public function lookupUser($email){
			set_time_limit(30);

			$ldapserver = 'iowa.uiowa.edu';
			$ldapuser      =  AD_SERVICEID_USER;  
			$ldappass     = AD_SERVICEID_PASS;
			$ldaptree    = "DC=iowa, DC=uiowa, DC=edu";

			$ldapconn = ldap_connect($ldapserver) or die("Could not connect to LDAP server.");

			if($ldapconn) {
			    // binding to ldap server
			    ldap_set_option( $ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3 );
			    ldap_set_option( $ldapconn, LDAP_OPT_REFERRALS, 0 );
			    $ldapbind = ldap_bind($ldapconn, $ldapuser, $ldappass) or die ("Error trying to bind: ".ldap_error($ldapconn));
			    // verify binding
			    if ($ldapbind) {

			    	//do stuff
						$result = ldap_search($ldapconn,$ldaptree, "mail=".$email, array("mail","sn", "givenName", "objectGUID", "memberOf")) or die ("Error in search query: ".ldap_error($ldapconn));
						
			        	$data = ldap_get_entries($ldapconn, $result);
			        	//print_r($data[0]);
			        	if($data["count"] == 1){
			        		$memberGuid = $this->GUIDtoStr($data[0]["objectguid"][0]);
			        		$resultArray['guid'] = $memberGuid;
			        		$resultArray['firstName'] = $data[0]["givenname"][0];
			        		$resultArray['lastName'] = $data[0]["sn"][0];
			        		// echo "<p>Found a GUID (".$memberGuid.") matching the email <strong>".$member->Email."</strong>, adding it to the local member's GUID field.</p>";
			        		//print_r($resultArray);
			        		return $resultArray;
			        		// echo "<p><strong>Done.</strong></p>";
			        	}


			    } else {
			        echo "LDAP bind failed...";
			    }
			}
			// all done? clean up
			ldap_close($ldapconn);
		}

		public function GUIDtoStr($binary_guid) {
		  $unpacked = unpack('Va/v2b/n2c/Nd', $binary_guid);
		  return sprintf('%08X-%04X-%04X-%04X-%04X%08X', $unpacked['a'], $unpacked['b1'], $unpacked['b2'], $unpacked['c1'], $unpacked['c2'], $unpacked['d']);
		}

}