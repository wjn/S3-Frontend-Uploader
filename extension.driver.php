<?php

	require_once(TOOLKIT . '/class.entrymanager.php');
if(class_exists('S3') == false){
	}
	
	Class extension_s3_frontend_uploader extends Extension {

		public function about() {
			return array(
				'name'			=> 'Amazon S3 Frontend Uploader',
				'version'		=> '0.0.1',
				'release-date'	=> '2011-06-01',
				'author'		=> array(
					array(
						'name'			=> 'Will Nielsen',
						'website'		=> 'http://nielsendigital.com',
						'email'			=> 'will@nielsendigital.com'
					),
					array(
						'name'			=> 'Scott Tesoriere',
						'website'		=> 'http://tesoriere.com',
						'email'			=> 'scott@tesoriere.com'
					),
					array(
						'name'			=> 'Andrew Shooner and Brian Zerangue',
						'website'		=> 'http://andrewshooner.com',
						'email'			=> 'ashooner@gmail.com'
					),
				),
				'description'	=> 'Upload files to Amazon S3. Based on Brian Zerangue\'s version, based on Michael E\'s upload field.'
			);
		}

		public function getSubscribedDelegates(){
					return array(
						array(
							'page' => '/system/preferences/',
							'delegate' => 'CustomActions',
							'callback' => 'savePreferences'
						),
						array(
							'page' => '/system/preferences/',
							'delegate' => 'AddCustomPreferenceFieldsets',
							'callback' => 'appendPreferences'
						),
					);
		}


		public function appendPreferences($context){
					$group = new XMLElement('fieldset');
					$group->setAttribute('class', 'settings');
					$group->appendChild(new XMLElement('legend', 'Amazon S3 Security Credentials'));

					$div = new XMLElement('div', NULL, array('class' => 'group'));

					$label = Widget::Label('Access Key ID');
					$label->appendChild(Widget::Input('settings[s3_frontend_uploader][access-key-id]', General::Sanitize($this->getAmazonS3AccessKeyId())));
					$div->appendChild($label);

					$label = Widget::Label('Secret Access Key');
					$label->appendChild(Widget::Input('settings[s3_frontend_uploader][secret-access-key]', General::Sanitize($this->getAmazonS3SecretAccessKey()), 'password'));
					$div->appendChild($label);

					$group->appendChild($div);

					$group->appendChild(new XMLElement('p', 'Get a Access Key ID and Secret Access Key from the <a href="http://aws.amazon.com">Amazon Web Services site</a>.', array('class' => 'help')));


					$label = Widget::Label('Default cache expiry time (in seconds)');
					$label->appendChild(Widget::Input('settings[s3_frontend_uploader][cache-control]', General::Sanitize($this->getCacheControl())));

					$group->appendChild($label);


					$context['wrapper']->appendChild($group);

				}

	}
