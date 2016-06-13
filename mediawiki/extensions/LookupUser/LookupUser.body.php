<?php
/**
 * Provides the special page to look up user info
 *
 * @file
 */
class LookupUserPage extends SpecialPage {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct( 'LookupUser'/*class*/, 'lookupuser'/*restriction*/ );
	}

	function getDescription() {
		return wfMessage( 'lookupuser' )->text();
	}

	/**
	 * Show the special page
	 *
	 * @param $subpage Mixed: parameter passed to the page or null
	 */
	public function execute( $subpage ) {
		global $wgRequest, $wgUser;

		$this->setHeaders();

		# If the user doesn't have the required 'lookupuser' permission, display an error
		if ( !$wgUser->isAllowed( 'lookupuser' ) ) {
			$this->displayRestrictionError();
			return;
		}

		$this->showInfo("Chunliang Lyu");
	}

	/**
	 * Retrieves and shows the gathered info to the user
	 * @param $target Mixed: user whose info we're looking up
	 */
	function showInfo( $target ) {
		global $wgOut, $wgLang, $wgScript;

		$count = 0;
		$users = array();
		$userTarget = '';

		// Look for @ in username
		//if( strpos( $target, '@' ) !== false ) {
			// Find username by email
			$dbr = wfGetDB( DB_SLAVE );

			$res = $dbr->select(
				'user',
				array( 'user_name' ),
				'',
				__METHOD__
			);

			$text = "{| class=\"wikitable sortable\"\n";
			// header
			$text .= "|-\n! User !! Email !! Edit count\n";
			foreach( $res as $row ) {
				$user = User::newFromName( $row->user_name );
				if ($user->isBlocked()) {
					continue;
				}

				// check bot
				$groups = $user->getGroups();
				$groupsText = '';
				$isBot = false;
				foreach ($groups as $group) { 
					if ($group === 'bot') { $isBot = true; }
					$groupsText .= $group; 
				}
				if ($isBot) continue;

			// check authentication
			$emailAuthenticated = '';
			$authTs = $user->getEmailAuthenticationTimestamp();
			if ( $authTs ) {
				$emailAuthenticated = '<i class="fa fa-check"></i>';
			}				
				$text .= "|-\n";
				$text .= "|[[User:" . $user->getName() . "|" . $user->getName() . "]] ||" . $user->getEmail(). " " . $emailAuthenticated . " || {{Special:Editcount/" . $user->getName() . "}}\n";
			}

			$text .= "|}\n";
			$wgOut->addWikiText($text);
return;
		//}

		$ourUser = ( !empty( $userTarget ) ) ? $userTarget : $target;
		$user = User::newFromName( $ourUser );
		if ( $user == null || $user->getId() == 0 ) {
			$wgOut->addWikiText( '<span class="error">' . wfMessage( 'lookupuser-nonexistent', $target )->plain() . '</span>' );
		} else {
			# Multiple matches?
			if ( $count > 1 ) {
				$options = array();
				if( !empty( $users ) && is_array( $users ) ) {
					foreach( $users as $id => $userName ) {
						$options[] = Xml::option( $userName, $userName, ( $userName == $userTarget ) );
					}
				}
				$selectForm = "\n" . Xml::openElement( 'select', array( 'id' => 'email_user', 'name' => 'email_user' ) );
				$selectForm .= "\n" . implode( "\n", $options ) . "\n";
				$selectForm .= Xml::closeElement( 'select' ) . "\n";

				$wgOut->addHTML(
					Xml::openElement( 'fieldset' ) . "\n" .
					Xml::openElement( 'form', array( 'method' => 'get', 'action' => $wgScript ) ) . "\n" .
					Html::hidden( 'title', $this->getPageTitle()->getPrefixedText() ) . "\n" .
					Html::hidden( 'target', $target ) . "\n" .
					Xml::openElement( 'table', array( 'border' => '0' ) ) . "\n" .
					Xml::openElement( 'tr' ) . "\n" .
					Xml::openElement( 'td', array( 'align' => 'right' ) ) .
					wfMessage( 'lookupuser-foundmoreusers' )->escaped() .
					Xml::closeElement( 'td' ) . "\n" .
					Xml::openElement( 'td', array( 'align' => 'left' ) ) . "\n" .
					$selectForm . Xml::closeElement( 'td' ) . "\n" .
					Xml::openElement( 'td', array( 'colspan' => '2', 'align' => 'center' ) ) .
					Xml::submitButton( wfMessage( 'go' )->escaped() ) .
					Xml::closeElement( 'td' ) . "\n" .
					Xml::closeElement( 'tr' ) . "\n" .
					Xml::closeElement( 'table' ) . "\n" .
					Xml::closeElement( 'form' ) . "\n" .
					Xml::closeElement( 'fieldset' )
				);
			}

			$authTs = $user->getEmailAuthenticationTimestamp();
			if ( $authTs ) {
				$authenticated = wfMessage( 'lookupuser-authenticated', $wgLang->timeanddate( $authTs ) )->plain();
			} else {
				$authenticated = wfMessage( 'lookupuser-not-authenticated' )->text();
			}
			$optionsString = '';
			foreach ( $user->getOptions() as $name => $value ) {
				$optionsString .= "$name = $value <br />";
			}
			$name = $user->getName();
			if( $user->getEmail() ) {
				$email = $user->getEmail();
			} else {
				$email = wfMessage( 'lookupuser-no-email' )->plain();
			}
			if( $user->getRegistration() ) {
				$registration = $wgLang->timeanddate( $user->getRegistration() );
			} else {
				$registration = wfMessage( 'lookupuser-no-registration' )->text();
			}
			$wgOut->addWikiText( '*' . wfMessage( 'username' )->text() . ' [[User:' . $name . '|' . $name . ']] (' .
				$wgLang->pipeList( array(
					'[[User talk:' . $name . '|' . wfMessage( 'talkpagelinktext' )->text() . ']]',
					'[[Special:Contributions/' . $name . '|' . wfMessage( 'contribslink' )->text() . ']])'
				) ) );
			$wgOut->addWikiText( '*' . wfMessage( 'lookupuser-id', $user->getId() )->plain() );
			$wgOut->addWikiText( '*' . wfMessage( 'lookupuser-email', $email, $name )->plain() );
			$wgOut->addWikiText( '*' . wfMessage( 'lookupuser-realname', $user->getRealName() )->plain() );
			$wgOut->addWikiText( '*' . wfMessage( 'lookupuser-registration', $registration )->plain() );
			$wgOut->addWikiText( '*' . wfMessage( 'lookupuser-touched', $wgLang->timeanddate( $user->mTouched ) )->plain() );
			$wgOut->addWikiText( '*' . wfMessage( 'lookupuser-info-authenticated', $authenticated )->plain() );
			$wgOut->addWikiText( '*' . wfMessage( 'lookupuser-useroptions' )->text() . '<br />' . $optionsString );
		}
	}

	protected function getGroupName() {
		return 'users';
	}
}
