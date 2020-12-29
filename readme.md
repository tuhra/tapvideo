## Project Name
	- Taptube

## Project Description
	- Value Added Service with MPT 
	Chinese movie can see by charging 99 kyats/1day but you must subscribe to accept this service with only MPT phone number. 
	You can download and see this movie in offline within one day at only Application.
	We upload videos in Vimeo server and call vimeo API to show in our end.

### Project Functional
* app/Http/Controllers/App/AppController.php
	- All of functions for app API.

* app/Http/Controllers/Backend/VideoController.php
	- To create video thumbnail at taptube admin panel.

* app/Http/Controllers/Backend/DownloadLinkController.php
	- To add download link from vimeo at taptube admin panel.

* app/Http/Controllers/Frontend/HomeController.php
	- To check single HE.
	- Subscribe and OTP function 

* app/Http/Controllers/Frontend/MPTCallbackController.php
	- MPT response callback and notify url to get subscribe status.
	- Callback records from MPT save in database.

* app/Http/Controllers/Frontend/MyanmarPhoneNumberController.php
	- To check MPT phone number.

* app/Http/Controllers/Frontend/SubscriberController.php
	- Unsubscribe function

* app/Http/Controllers/Frontend/VimeoController.php
	- Call vimeo API to show videos that upload in vimeo.
	- Favourite and serch function include.

* app/Http/Helpers/common_helper.php
	- Call MPT API(GetOtp, ResendOtp, VerifyOtp) in this file.

* app/Http/Helpers/MptHelper.php
	- Call getHE MPT API in this file.

## To Do task
	- Report

## Server IP Address
	- 167.99.31.99

## Project Database
	- production db name (taptube)

## Project Domain
	- production domain (http://taptubemm.com/)

## Project Repo

* Branch
	- master (https://bitbucket.org/securelinkygn/taptube/src/master/)

## Project Contact Person
	- To contact for MA API of MPT from skype => Ko Aung Khaing Hein
	- To contact client from WhatsApp => Ma Zue and Ko Zay Ya
